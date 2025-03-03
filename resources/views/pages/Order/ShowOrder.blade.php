@extends('pages.index')
@section('content')
<div class="container">
    <h1>Danh sách đơn hàng của {{ Auth::user()->name }}</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($orders->isEmpty())
        <p>Bạn chưa có đơn hàng nào.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ number_format($order->total_amount) }}đ</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <!-- Liên kết Xem chi tiết -->
                            <button class="btn btn-info" onclick="showOrderDetail({{ $order->id }})">Xem chi tiết</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Hiển thị chi tiết đơn hàng khi click vào Xem chi tiết -->
    <div id="orderDetail" class="mt-5" style="display: none;">
        <h3>Chi tiết đơn hàng</h3>
        <div id="orderDetailContent"></div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Ajax để tải chi tiết đơn hàng mà không cần chuyển trang
    function showOrderDetail(orderId) {
        $.ajax({
            url: '/user/order/' + orderId,
            type: 'GET',
            success: function(response) {
                // Hiển thị chi tiết đơn hàng
                $('#orderDetail').show();
                $('#orderDetailContent').html(response);
            },
            error: function() {
                alert('Không thể tải chi tiết đơn hàng.');
            }
        });
    }
</script>
@endsection