<?php
if (is_array($tintuc)){
    extract($tintuc);
}
$hinh_anh_path = "../upload/".$hinh_anh;
if(is_file($hinh_anh_path)){
    $hinh = "<img src='$hinh_anh_path' height = '80' width='80'>";
}else {
    $hinh = "Không có hình";
}
?>
<div class="row2">
    <div class="row2 font_title">
        <h1>Sua tin tuc</h1>
    </div>
    <div>
        <ul>
            <?php if(isset($_SESSION['error'])){
                foreach ($_SESSION['error'] as $er){
                    ?>
            <li style="..."><?php echo $er; ?></li>
            <?php
        }

            }?>
        </ul>
    </div>
    <div class="row2 form_content">
        <form action="index.php?act=updatetintuc" method = "post" enctype="multipart/form-data">
            <div class="row2 mb10 form_content_container">
                <label>Danh muc</label>
                <select name="iddm">
                    <?php foreach ($listdmtintuc as $dm){
                        extract($dm);
                        $e = $id_danhmuc == $id_danhmuc ? "selected":"";
                        echo "<option value = $id_danhmuc>$ten_danhmuc</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row2 mb10">
                <label>Tieu de</label> <br>
                <input type="text" name="tieu_de" value="<?php echo $tieu_de?>">
            </div>
            <div class="row2 mb10">
                <label>Noi dung</label> <br>
                <input type="text" name="noi_dung" value="<?php echo $noi_dung?>">
            </div>
            <div class="row2 mb10">
                <label>Hinh anh</label> <br>
                <input type="file" name="hinh_anh">
                <?php echo $hinh ?>
            </div>
            <div class="row2 mb10">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input class="mr20" type="submit" name="capnhat_tt" value="Cập nhật">
                <input class="mr20" type="reset" value="Nhap lai">
                <a href="index.php?act=listtintuc"><input class="mr20" type="button" value="Danh sach"></a>
            </div>
            <?php 
            if(isset($thongbao) && $thongbao!=""){
                echo $thongbao;
            }
            ?>
            
    </form>

    </div>
</div>