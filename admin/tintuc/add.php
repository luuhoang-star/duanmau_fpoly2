<div class="row2">
    <div class="row2 font_title">
        <h1>Them moi tin tuc</h1>
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
        <form action="index.php?act=addtintuc" method = "post" enctype="multipart/form-data">
            <div class="row2 mb10 form_content_container">
                <label>Danh muc</label>
                <select name="iddm">
                    <?php foreach ($listdmtintuc as $dm){
                        extract($dm);
                        echo "<option value = $id_danhmuc>$ten_danhmuc</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row2 mb10">
                <label>Tieu de</label> <br>
                <input type="text" name="tieu_de">
            </div>
            <div class="row2 mb10">
                <label>Noi dung</label> <br>
                <input type="text" name="noi_dung">
            </div>
            <div class="row2 mb10">
                <label>Hinh anh</label> <br>
                <input type="file" name="hinh_anh">
            </div>
            <div class="row2 mb10">
                <input class="mr20" type="submit" name="themmoi" value="Them moi">
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