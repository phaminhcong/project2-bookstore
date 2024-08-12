@extends('admin.layout.master')
@section('content')
<!-- resources/views/admin/index.blade.php -->

  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #revenueChart {
            max-width: 1000px;
            max-height: 800px;
        }
        canvas{
            margin-left: 100px;
        }
    </style>

<body>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Thống kê doanh thu trong 7 ngày</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Quản lý danh mục</li>
          <li class="breadcrumb-item active">Danh sách danh mục</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
    <canvas id="revenueChart"></canvas>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const revenues = @json($revenues);
            const labels = revenues.map(item => item.date);
            const data = revenues.map(item => item.total_revenue);
            const ctx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: data,
                        backgroundColor: [
                        'rgba(252, 3, 3, 0.2)',
                        'rgba(252, 111, 3, 0.2)',
                        'rgba(252, 227, 3, 0.2)',
                        'rgba(20, 252, 3, 0.2)',
                        'rgba(3, 202, 252, 0.2)',
                        'rgba(92, 6, 145, 0.2)',
                        'rgba(83, 2, 99, 0.2)'
                    ],
                    borderColor: [
                        'rgba(252, 3, 3, 1)',
                        'rgba(252, 111, 3, 1)',
                        'rgba(252, 227, 3, 1)',
                        'rgba(20, 252, 3, 1)',
                        'rgba(3, 202, 252, 1)',
                        'rgba(92, 6, 145, 1)',
                        'rgba(83, 2, 99, 1)'
                    ],
                    borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>

@endsection
