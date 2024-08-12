<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // SHOW PRODUCT
    public function all()
    {
        $product = Product::with('category','author')
            ->where('isDeleted', 0) -> paginate(4);
        $data['product'] = $product;
        return view('admin.products.list_product', compact('product'), $data);
    }
    public function allTest()
    {
        $product = Product::with('categories','author')
            ->where('isDeleted', 0) ->get();
        $data['product'] = $product;
        return $product;
    }
    public function allTest1()
    {
        $product1 = Product::with('categories','author')
            ->where('isDeleted', 0) ->get();
        $data['product'] = $product1;
        return $product1;
    }
    public function topSellingProductsShow()
    {
        $topProductsShow = Product::select('products.*', DB::raw('SUM(order_detail.quantity_product) as total_sold'))
        ->join('order_detail', 'products.id', '=', 'order_detail.prd_id')
        ->where('products.isDeleted', 0)
        ->groupBy('products.id','products.name','products.price', 'products.quantity','products.cat_id','products.author_id', 'products.prd_desc','products.image_product','products.publishing_year','products.prd_featured','products.isDeleted','products.sale')
        ->orderBy('total_sold', 'desc')
        ->take(10)
        ->get();
        return $topProductsShow;
    }
    public function productsOnSale()
    {
        // Lấy tất cả các sản phẩm có sale > 0
        $products = Product::with('categories','author')->where('sale', '>', 0)->where('isDeleted', 0)->get();

        // Truyền dữ liệu tới view
        return $products;
    }

    public function combined()
    {
        $data1 = $this->allTest(); // Gọi function1
        $data2 = $this->allTest1();
        $data3 = $this->topSellingProductsShow();
        $data4 = $this->productsOnSale();
        // Truyền dữ liệu tới view
        return view('customer.home-page', compact('data1','data2','data3','data4'));
    }

    public function showProductsByCategory($id)
    {
        $category = Category::with(['products' => function ($query) {
            $query->where('isDeleted', 0);
        }])->find($id);
        $productCount = $category->products->count();
        $productsDividedByFour = (int) ceil($productCount / 4);
        $products = $category->products;
        return view('customer.category.list_product_category', compact('category', 'products','productCount','productsDividedByFour'));
    }
    // END
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $reviews = Review::where('product_id', $id)
            ->join('customers', 'reviews.customer_id', '=', 'customers.id')
            ->select('reviews.*', 'customers.name as customer_name')
            ->get();

        return view('customer.product.product_detail', compact('product', 'reviews'));
    }
    // DELETE - PRODUCT
    public function softDeleteProduct($id)
    {
        DB::table("products")
            ->where("id", $id)
            ->update(['isDeleted' => 1]);
        return redirect()->route('product.all');
    }
    // END

    // ADD - PRODUCT
    public function create()
    {
        $categories = Category::where('isDeleted', 0)->get();
        $author = Author::all();
        return view('admin.products.add_product', compact('categories', 'author'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'cat_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:author,id',
            'prd_desc' => 'nullable|string',
            'image_product' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imageName = $request->file('image_product')->getClientOriginalName();
        $request->file('image_product')->move(public_path('dist/img'), $imageName);
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'prd_desc' => $request->prd_desc,
            'image_product' => $imageName,
        ]);
        $product->categories()->attach($request->cat_id);
        $product->authors()->attach($request->author_id);
        return redirect()->route('product.all');
    }
    // END

    // UPDATE - PRODUCT
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('isDeleted', 0)->get();
        $author = Author::where('isDelete', 0)->get();
        return view('admin.products.update_product', compact('product', 'categories', 'author'));
    }
    public function product_detail($id)
    {
        $product_detail = Product::findOrFail($id);
        $categories = Category::where('isDeleted', 0)->get();
        $author = Author::where('isDelete', 0)->get();
        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
            $customerId = $customer->id;
            $hasCommented = Review::where('product_id', $id)
                ->where('customer_id', $customerId)
                ->exists();;
        }else {
            $hasCommented = false;
        }
        $reviews = $product_detail->reviews()->orderBy('review_at', 'desc')->get();
        $averageRating = Review::where('product_id', $id)->avg('evaluate');
        $formattedAverageRating = number_format($averageRating, 1);
        return view('customer.product.product_detail', compact('product_detail', 'categories', 'author','reviews','hasCommented','formattedAverageRating' ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'author' => 'required|array',
            'author.*' => 'exists:author,id',
            'prd_desc' => 'nullable|string',
            'sale' => 'required',
            'image_product' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.regex' => 'Tên sản phẩm không được chỉ chứa mỗi số'
        ]);
        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'prd_desc' => $request->prd_desc,
            'sale' => $request->sale,
        ]);
        $product->categories()->sync($request->categories);
        $product->authors()->sync($request->author);
        if ($request->hasFile('image_product')) {
            $imageName = time() . '.' . $request->file('image_product')->getClientOriginalExtension();
            $request->file('image_product')->move(public_path('dist/img'), $imageName);
            $product->update(['image_product' => $imageName]);
        }
        $productPosition = Product::where('id', '<=', $product->id)
        ->where('isDeleted', 0)
        ->count();
        $perPage = 4; // Number of products per page
        $page = ceil($productPosition / $perPage);
        Session::flash('success', 'Sản phẩm đã được cập nhật thành công!');
        return redirect()->route('product.all', ['page' => $page])
        ;
    }
    // END
    // search
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $products = Product::where('name', 'like', "%$searchTerm%")
        ->where('isDeleted', 0)
        -> paginate(4);
        return view('admin.products.search_product', compact('products', 'searchTerm'));
    }
    public function getLowStockProducts() {
        $products = Product::where('quantity', '<', 10) -> where('isDeleted', 0) -> paginate(4);
        return view('admin.products.low_stock_product', compact('products'));
    }
    public function topSellingProducts()
    {
        $topProducts = OrderDetail::select('prd_id', DB::raw('SUM(quantity_product) as total_quantity'))
            ->groupBy('prd_id')
            ->orderBy('total_quantity', 'desc')
            ->take(5)
            ->with('product')
            ->get();
        return view('admin.products.top_selling_product', compact('topProducts'));
    }
    public function ProductQuickView($id)
    {
        $product_quick = Product::where('id',$id)->first();
        $categories = Category::where('isDeleted', 0)->get();
        $author = Author::where('isDelete', 0)->get();
        $reviews = $product_quick->reviews()->orderBy('review_at', 'desc')->get();
        $soldProducts = OrderDetail::where('prd_id', $id)->sum('quantity_product');
        $averageRating = Review::where('product_id', $id)->avg('evaluate');
        $formattedAverageRating = number_format($averageRating, 1);
        return view('customer.product.quick-view-modal',compact('product_quick','categories','reviews','author','formattedAverageRating','soldProducts'));
    }
    public function showTopRatedProducts()
{
    $topRatedProducts = Product::select('products.*', DB::raw('AVG(reviews.rating) as average_rating'))
        ->select('products.*', DB::raw('AVG(reviews.evaluate) as average_rating'))
        ->join('reviews', 'products.id', '=', 'reviews.product_id')
        ->groupBy('products.id','products.name','products.price', 'products.quantity','products.cat_id','products.author_id', 'products.prd_desc','products.image_product','products.publishing_year','products.prd_featured','products.isDeleted','products.sale')
        ->orderBy('average_rating', 'desc')
        ->take(5)
        ->get();
    return view('admin.products.top_rated_product', compact('topRatedProducts'));
}
    

}
