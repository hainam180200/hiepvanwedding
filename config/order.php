<?php
    return [
        'type' => [
            '1' => 'Đặt hàng và xác nhận trực tuyến',
            '2' => 'Đặt hàng trước',
            '3' => 'Đặt hàng và thanh toán trực tuyến'
        ],
        'status' => [
            '0' => 'Đã hủy',
            '1' => 'Thành công',
            '2' => 'Đang chờ xác nhận',
            '3' => 'Đang xử lý',
        ],
        'installment' =>[
            'title' => 'Tên tổ chức tín dụng',
            'image' => 'Ảnh đại diện',
            'papers' => 'Giấy tờ cá nhân',
            'fee' => 'Phí dịch vụ',
            'ratio' => 'Lãi suất / tháng',
            'months_payment' => 'Số tháng vay',
            'prepaid_percentage' => 'Phần trăm trả trước',
        ],
        'prepaid_percentage' => [
            '0','10','20','30','40','50','60','70','80','90',
        ],
        'month' =>[
            '3','6','9','12',
        ],
        'detail' => [
            'module' => [
                'fullname' => [
                    'key' => 'fullname',
                    'title' => 'Họ tên:',
                ],
                'phone' => [
                    'key' => 'phone',
                    'title' => 'Điện thoại:',
                ],
                'provinces' => [
                    'key' => 'provinces',
                    'title' => 'Tỉnh - Thành phố:',
                ],
                'districts' => [
                    'key' => 'districts',
                    'title' => 'Quận - huyện:',
                ],
                'address' => [
                    'key' => 'address',
                    'title' => 'Địa chỉ:',
                ],
                'email' => [
                    'key' => 'email',
                    'title' => 'Email:',
                ],
            ],
        ],
    ];