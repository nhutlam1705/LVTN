<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thanh toán VNPay</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2>Xác nhận thanh toán với VNPay</h2>
        <p>Bạn đã chọn thanh toán bằng VNPay. Tổng số tiền của bạn là: {{ number_format($totalAmount, 0, ',', '.') }} đ</p>
    
        <form action="{{ route('payment.vnpay.process') }}" method="POST">
            @csrf
            <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
            <button type="submit" class="btn btn-primary" name="redirect">
                Xác nhận thanh toán</button>
        </form>
    </div>
    
    
    
</body>
</html>
