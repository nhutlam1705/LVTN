<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('images/logo.jpg') }}" alt="" style="width:200px; height:200px;">
        </div>
        <div class="row"></div>
    </div>
    <div class="container text-center mt-5">
        <h1 class="text-success">Thanh toán thành công!</h1>
        <p>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ xử lý đơn hàng của bạn ngay lập tức.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Về trang chủ</a>
        {{-- <h4>Thông tin đơn hàng của bạn</h4>
        <table>
            <thead>
                <tr>
                    <th>Mã Đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th>Hình thức thanh toán</th>
                    <th>Thành tiền</th>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                </tr>
            </tbody>
           
        </table> --}}
    </div>
</body>
</html>