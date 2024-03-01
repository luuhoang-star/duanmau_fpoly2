<?php
// hàm dùng để lấy toàn bộ dữ liệu của bảng danh mục tin tức
function loadall_dmtintuc(){
    $sql = "SELECT * FROM danhmuctintuc";
    $list_dm = pdo_query($sql);
    return $list_dm;
}

?>