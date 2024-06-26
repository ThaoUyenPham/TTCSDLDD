<?php 
return [
    'origins' => ['*'], // Cho phép yêu cầu từ tất cả nguồn gốc (thay thế bằng các nguồn gốc cụ thể cho môi trường production)
    'methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
    'allowed_headers' => ['*'], // Cho phép tất cả các tiêu đề (thay thế bằng các tiêu đề cụ thể cho môi trường production)
    'exposed_headers' => [],
    'max_age' => 3600, // Lưu trữ cache các yêu cầu OPTIONS trong một giờ
    'supports_credentials' => false, // Thiết lập thành true nếu API của bạn cần gửi cookie hoặc thông tin xác thực khác
];