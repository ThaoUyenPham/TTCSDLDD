<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Web Đẹp</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
            text-align: center;
        }
        .container {
            max-width: 600px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2em;
            line-height: 1.5;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1em;
            text-decoration: none;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            transition: background 0.3s;
        }
        a:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Đã có lỗi xảy ra 503</h1>
        <p>Vui lòng liên hệ với người phát triển để khắc phục lỗi</p>
        <a href="{{route('home')}}">Quay lại trang chủ</a>
    </div>
</body>
</html>
