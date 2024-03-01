<?php 
    include "../model/pdo.php";
    include "../model/danhmuc.php";
    include "../model/sanpham.php";
    include "../model/thongke.php";

    include "../model/danhmuctintuc.php";
    include "../model/tintuc.php";

    include "header.php";
    if(isset($_GET['act'])){
        $act = $_GET['act'];
        switch ($act) {
            case 'listsp':
                if(isset($_POST['clickOK']) && ($_POST['clickOK'])){
                    $keyw=$_POST['keyw']; // lưu 1 sản phẩm ở sản phẩm
                    $iddm=$_POST['iddm']; // lưu 1 danh mục ở database danh mục
                }else {
                    $keyw="";
                    $iddm=0;
                }
                $listdanhmuc = loadall_danhmuc();  // tải tất cả danh mục
                $listsanpham = loadall_sanpham("$keyw",$iddm);  // tải thông tin sản phẩm dựa trên giá trị của $keyw và $iddm
                include "sanpham/list.php";
                break;
            case 'addsp':
                if(isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                    $iddm = $_POST['iddm'];
                    $tensp = $_POST['tensp'];
                    $giasp = $_POST['giasp'];
                    $mota = $_POST['mota'];
                    $hinh = $_FILES['hinh']['name'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir.basename($_FILES['hinh']['name']);
                    if(move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)) {
                        echo "Bạn đã upload ảnh thành công";
                    }else {
                        echo "Upload ảnh không thành công";
                    }
                    insert_sanpham($tensp,$giasp, $hinh, $mota , $iddm); // chèn tên sản phẩm.. vào csdl
                    $thanhcong = "Thêm thành công";
                }
                $listdanhmuc = loadall_danhmuc();
                include "sanpham/add.php";
                break;
           
            case 'suasp':  //sửa sản phẩm
                if(isset($_GET['idsp']) && ($_GET['idsp']>0)){
                    $sanpham=loadone_sanpham($_GET['idsp']);
                }
                $listdanhmuc=loadall_danhmuc();
                include "sanpham/update.php";
                break;
            case 'updatesp': // cập nhật sản phẩm
                if(isset($_POST['capnhat'])&&($_POST['capnhat'])){
                    $iddm=$_POST['iddm'];
                    $id=$_POST['id'];
                    $tensp=$_POST['tensp'];
                    $giasp=$_POST['giasp'];
                    $mota=$_POST['mota'];
                    $hinh=$_FILES['hinh']['name'];
                    $target_dir="../upload/";
                    $target_file = $target_dir.basename($_FILES['hinh']['name']);
                    if(move_uploaded_file($_FILES['hinh']['tmp_name'], $target_file)){
                        echo "Thành công";
                    }else {
                        echo "Lỗi";
                    }
                    update_sanpham($id,$iddm,$tensp,$giasp,$mota,$hinh);
                    $thongbao = "Cập nhật thành công";
                }
                $listdanhmuc=loadall_danhmuc();
                $listsanpham=loadall_sanpham("",0);
                include "sanpham/list.php";
                break;
            case 'hard_delete':
                 if(isset($_GET['idsp'])){
                     hard_delete($_GET['idsp']);
                 }
                 $listsanpham=loadall_sanpham("",0);
                 include "sanpham/list.php";
                break;
            case 'thongke':
                $dsthongke= load_thongke_sanpham_danhmuc();  //thongke sp theo danh muc
                include "thongke/list.php";
                break;
            case 'bieudo':
                $dsthongke = load_thongke_sanpham_danhmuc(); // biểu đồ sp theo danh mục  1
                include "thongke/bieudo.php";
                break;

            // controller tin tức //
            case 'listtintuc':
                $listtintuc = loadall_tintuc();
                include "tintuc/list.php";
                break;

            case 'addtintuc' :
                if(isset($_POST["themmoi"])&& $_POST['themmoi']) {
                    $error = [];
                    if (empty($_POST["tieu_de"])){
                        $error[] = "Vui long nhap tieu de";
                    }
                    if (empty($_POST["noi_dung"])){
                        $error[] = "Vui long nhap noi dung";
                    }
                    if (empty($_FILES["hinh_anh"]["name"])){
                        $error[] = "Vui long chon hinh anh";
                    }
                    if (count($error)>=1){
                        $_SESSION['error'] = $error;
                    }else {
                        $tieu_de = $_POST["tieu_de"];
                        $noi_dung = $_POST["noi_dung"];
                        $iddm = $_POST["iddm"];
                        $filename = $_FILES["hinh_anh"]["name"];
                        $target_dir = "../upload/";
                        $target_file = $target_dir.basename($filename);
                        if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file)){
                        }else {
                            echo "Loi up load file";
                        }
                        insert_tintuc($tieu_de,$noi_dung,$filename,$iddm);
                        $thongbao = "Them thanh cong";

                    }

                }   
                $listdmtintuc = loadall_dmtintuc();
                include "./tintuc/add.php";
                break;

                case 'suatintuc':
                    if(isset($_GET['id'])&& $_GET['id']>0){
                        $tintuc = loadone_tintuc($_GET['id']);
                    }
                    $listdmtintuc = loadall_dmtintuc();
                    include "./tintuc/update.php";
                    break;

                    case 'updatetintuc' :
                        if(isset($_POST["capnhat_tt"])&& $_POST["capnhat_tt"]) {
                            $error = [];
                            if (empty($_POST["tieu_de"])){
                                $error[] = "Vui long nhap tieu de";
                            }
                            if (empty($_POST["noi_dung"])){
                                $error[] = "Vui long nhap noi dung";
                            }
                            if (count($error)>=1){
                                $_SESSION['error'] = $error;
                                header("location:http://localhost/duanmau/admin/index.php?act=suatintuc&id=".$_POST['id']);
                            }else {
                                $id = $_POST["id"];
                                $tieu_de = $_POST["tieu_de"];
                                $noi_dung = $_POST["noi_dung"];
                                $iddm = $_POST["iddm"];
                                $filename = $_FILES["hinh_anh"]["name"];
                                $target_dir = "../upload/";
                                $target_file = $target_dir.basename($filename);
                                if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file)){
                                }else {
                                    echo "Loi up load file";
                                }
                                update_tintuc($id,$tieu_de,$noi_dung,$filename,$iddm);
                                header("Location: http://localhost/duanmau/admin/index.php?act=listtintuc");
        
                            }
        
                        }   
                        $listdmtintuc = loadall_dmtintuc();
                        include "./tintuc/add.php";
                        break;

                    case 'xoatintuc':
                        if(isset($_GET['id']) && $_GET['id']>0){
                            delete_tintuc($_GET['id']);
                        }
                        header("Location: http://localhost/duanmau/admin/index.php?act=listtintuc");
                        break;
        
        
        



        }
    }
    else {
        include "home.php";
    }
 



 include "footer.php"  ?>
    