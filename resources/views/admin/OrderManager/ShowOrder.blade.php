@extends('admin.index')

@section('content')

<style>
    .vertical-gradient-char {
      font-size: 18px;
      font-weight: bold;
      background: linear-gradient(to bottom, rgb(0, 0, 255), rgb(255, 0, 0), rgb(1, 1, 1));
      -webkit-background-clip: text;
      color: transparent;
    }

    .icon-button {
    cursor: pointer;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    }

    .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 10000;
    justify-content: center;
    align-items: center;
    }

    .modal-content {
    background-color: white;
    padding: 10px;
    border-radius: 10px;
    text-align: left;
    max-width: 700px;
    width: 90%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    
    }
    .order-content{
    animation: fadeIn 0.3s ease-in-out;
    max-height: 80vh; 
    overflow-y: auto; 
    overflow-x: hidden;
    height: auto;
    }

    .close1 {
    position: absolute;
    text-align: center;
    align-items: center;
    top: 10px; 
    right: 15px;
    font-size: 1.3rem;
    font-weight: bold;
    cursor: pointer;
    color: white;
    border-radius: 10%;
    background-color: red;
    width: 30px;
    height: 30px;
    }
    .close1:hover{
        background-color: rgb(125, 5, 5);
        color: red;
    }

    @keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
    }

</style>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách đơn hàng</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Mã HĐ</th>
                    <th>Khách hàng</th>
                    <th>Điện thoại</th>
                    <th>Tổng</th>
                    <th>Phương thức</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }} 
                                <sup> <u class="vertical-gradient-char">{{ $order->check }}</u> </sup>
                                <form action="{{ route('orders.updatecheck', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="rounded-pill fas fa-check-circle" style="float: right;"></button>
                                </form>
                            </td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->phone }}</td>  
                            <td>{{ number_format($order->total_amount, 0, ',', '.') }}<u> đ</u></td>
                            <td>{{ $order->payment_method }}</td>
                            <td>
                                {{ $order->created_at }}
                                <br>
                                <b style="color: {{ $order->status === 'Chưa thanh toán' ? 'red' : ($order->status === 'Đã thanh toán' ? 'green' : 'black') }}">
                                    {{ $order->status }}
                                </b>
                            </td>
                            
                            <td>
                                <form action="{{ route('orders.update', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning fas fa-check-circle"></button>
                                </form>
                                {{-- <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info fas fa-eye"></a> --}}
                                <button id="viewIcon" class="btn btn-info fas fa-eye icon-button" data-id="{{ $order->id }}"></button>
                            </td>
                        </tr>
                        
                       
                        <div id="modal{{ $order->id }}" class="modal">
                            <div class="modal-content">
                                <div id="closeModal{{ $order->id }}" class="close1">&times;</div>
                                <h3><b>Thông Tin Đơn Hàng</b></h3>
                                <p id="modalData{{ $order->id }}"></p>
                                <div class="order-content">
                                    <div class="border-top my-2"></div>
                                    <div class="row">
                                        <div class="col-4">Tên sản phẩm</div>
                                        <div class="col-3">Hình ảnh</div>
                                        <div class="col-2"> Số lượng</div>
                                        <div class="col-3">Đơn giá</div>
                                    </div>
                                    <div class="border-top my-2"></div>
                                    @foreach ($order->orderItems as $item)
                                        <div class="row">
                                            <div class="col-4">{{ $item->product ? $item->product->name_product : 'Sản phẩm không có' }}</div>
                                            <div class="col-3"><img src="{{ asset('images/' . $item->product->image_product) }}" width="50" height="50"></div>
                                            <div class="col-2">{{ $item->quantity }}</div >
                                            <div class="col-3">{{ number_format($item->price, 0, ',', '.') }}<u> đ</u></div>
                                        </div>
                                    @endforeach
                                    <div class="border-top my-2"></div>
                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <h5 class="mb-3"><b>Thông tin khách hàng</b></h5>
                                            <div class="row"><div class="col-6">Tên khách hàng:</div><div class="col-6">{{ $order->name }}</div></div>
                                            <br>
                                            <div class="row"><div class="col-6">SĐT:</div><div class="col-6">{{ $order->phone }}</div></div>
                                            <br>
                                            <div class="row"><div class="col-6">Địa chỉ:</div><div class="col-6">{{ $order->address }}</div></div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-3"><b>Thanh toán</b></h5>
                                            <div class="row"><div class="col-4">Tổng tiền:</div><div class="col-8">{{ number_format($order->total_amount, 0, ',', '.') }}<u> đ</u></div></div>
                                            <br>
                                            <div class="row"><div class="col-4">Thời gian:</div><div class="col-8">{{ $order->created_at }}</div></div>
                                            <br>
                                            <div class="row"><div class="col-4">Trạng thái:</div>
                                                <div class="col-8">
                                                    <b style="color: {{ $order->status === 'Chưa thanh toán' ? 'red' : ($order->status === 'Đã thanh toán' ? 'green' : 'black') }}">
                                                        {{ $order->status }}
                                                    </b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
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

<script>
    // Select all icon buttons and modals
    document.querySelectorAll('.icon-button').forEach(button => {
        button.addEventListener('click', () => {
            const orderId = button.getAttribute('data-id'); // Lấy ID của đơn hàng
            const modal = document.getElementById('modal' + orderId); // Chọn modal dựa trên ID đơn hàng
            const closeModal = document.getElementById('closeModal' + orderId); // Chọn nút đóng modal
            const modalData = document.getElementById('modalData' + orderId); // Chọn phần tử chứa dữ liệu modal

            // Hiển thị thông tin trong modal
            const data = `Thông tin chi tiết cho mã đơn hàng : ${orderId}`; // Thay thế bằng dữ liệu thực tế từ server
            modalData.textContent = data;

            // Hiển thị modal
            modal.style.display = 'flex';

            // Close modal khi nhấn nút đóng
            closeModal.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            // Close modal khi nhấn ngoài modal
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    });



</script>
@endsection
