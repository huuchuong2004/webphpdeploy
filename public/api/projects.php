<?php
header('Content-Type: application/json');
$projects = [
    ["title" => "Website bán hàng", "desc" => "Xây dựng bằng PHP & MySQL, giao diện responsive."],
    ["title" => "Blog cá nhân", "desc" => "SPA với hiệu ứng đẹp, backend PHP."],
    ["title" => "Landing page sự kiện", "desc" => "Thiết kế hiện đại, hiệu ứng cuộn mượt."],
];
echo json_encode($projects);