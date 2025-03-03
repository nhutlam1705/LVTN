@extends('admin.index')
@section('content')
    @php
    $informationCount = \App\Models\Information::count();
    $userCount = \App\Models\User::count();
    $orderCount = \App\Models\Order::count();
    $productCount = \App\Models\Product::count();
    @endphp
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $orderCount }}</h3>
                <p>Đơn hàng</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('orders.show') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                {{-- <h3>{{ $productCount }}<sup style="font-size: 20px">%</sup></h3> --}}
                <h3>{{ $productCount }}</h3>
                <p>Sản phẩm</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('ProductManager.ShowProduct') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $userCount }}</h3>

                <p>Tài khoản</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('AccountManager.ShowAccount') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $informationCount }}</h3>
                <p>Tin tức & sự kiện</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('vouchers.index') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <div class="container">
      <h1>Biểu đồ thống kê doanh thu</h1>
  
      <div class="row mb-3">
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin.home') }}">
              <select name="month" onchange="this.form.submit()">
                  @foreach(range(1, 12) as $monthNumber)
                      <option value="{{ Carbon\Carbon::now()->year }}-{{ str_pad($monthNumber, 2, '0', STR_PAD_LEFT) }}" 
                              {{ request('month') == Carbon\Carbon::now()->year . '-' . str_pad($monthNumber, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                          Tháng {{ $monthNumber }}
                      </option>
                  @endforeach
              </select>
          </form>
        </div>
          {{-- <div class="col-md-4">
              <label for="monthSelector">Chọn tháng:</label>
              <select id="monthSelector" class="form-control">
                  @for ($i = 0; $i < 12; $i++)
                      <option value="{{ \Carbon\Carbon::now()->subMonths($i)->format('Y-m') }}">
                          {{ \Carbon\Carbon::now()->subMonths($i)->format('F Y') }}
                      </option>
                  @endfor
              </select>
          </div> --}}
      </div>
  
      <div class="row">
          <div class="col-md-9">
              <canvas id="revenueChart"></canvas>
          </div>
          <div class="col-md-3 mt-4">
            <div class="row">
              <div class="col-7 mb-2"><h5 id="total-revenue"><b>Tổng doanh thu:</b></h5></div><div class="col-5 mb-2">{{ number_format($totalRevenue, 0, '.', ',') }} đ</div>
              <div class="col-7 mb-2 text-danger"><h6 id="total-revenue"><b>Tổng chi phí:</b></h6></div><div class="col-5 mb-2 text-danger">{{ number_format($totalOriginal, 0, '.', ',') }} đ</div>
              <div class="col-7 mb-2 text-success"><h6 id="total-revenue"><b>Lợi nhuận:</b></h6></div><div class="col-5 mb-2 text-success">{{ number_format($totalRevenue-$totalOriginal, 0, '.', ',') }} đ</div>
            </div>
            <br>
          </div>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Danh sách phản hồi từ khách hàng</h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success ms-3" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Họ tên</th>
                          <th>Email</th>
                          <th>Nội dung</th>
                          <th>Phản hồi</th>
                          <th>Hành động</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>{{ $contact->is_replied ? 'Đã phản hồi' : 'Chưa phản hồi' }}</td>
                            <td>
                                @if (!$contact->is_replied)
                                    <form action="{{ route('contact.reply', $contact->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <textarea name="reply_message" class="form-control" placeholder="Nhập nội dung phản hồi"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Gửi phản hồi</button>
                                    </form>
                                @else
                                    <span class="text-success">Đã gửi</span>
                                @endif
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
      </section>

  </div>



  
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
      const dates = @json($dates);
      const revenues = @json($revenues);
  
      const ctx = document.getElementById('revenueChart').getContext('2d');
      const revenueChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: dates,
              datasets: [{
                  label: 'Doanh thu hàng ngày',
                  data: revenues,
                  borderColor: 'rgba(75, 192, 192, 1)',
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderWidth: 2
              }]
          },
          options: {
              responsive: true,
              scales: {
                  x: {
                      title: { display: true, text: 'Ngày' }
                  },
                  y: {
                      title: { display: true, text: 'Doanh thu (đ)' },
                      beginAtZero: true
                  }
              }
          }
      });
  
      // Xử lý khi chọn tháng
      document.getElementById('monthSelector').addEventListener('change', function() {
          const selectedMonth = this.value;
          fetch(`/admin/dashboard?month=${selectedMonth}`)
              .then(response => response.json())
              .then(data => {
                  revenueChart.data.labels = data.dates;
                  revenueChart.data.datasets[0].data = data.revenues;
                  revenueChart.update();
              });
      });
  </script>
  <script>
      function fetchRevenue() {
          var selectedMonth = document.getElementById('month-select').value;

          // Gửi AJAX request đến controller để lấy doanh thu theo tháng
          fetch('{{ route('admin.revenue') }}?month=' + selectedMonth)
              .then(response => response.json())
              .then(data => {
                  // Cập nhật doanh thu trên trang
                  document.getElementById('total-revenue').innerHTML = 'Tổng doanh thu: ' + formatCurrency(data.totalRevenue) + ' đ';
              })
              .catch(error => console.log('Error:', error));
      }

      // Hàm định dạng số tiền
      function formatCurrency(amount) {
          return amount.toLocaleString();
      }
  </script>
@endsection