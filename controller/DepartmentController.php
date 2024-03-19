<?php
//import model
require 'model/DepartmentModel.php';

// m = ten cua ham nam trong file controller trong thu muc controller 
$m = trim($_GET['m'] ?? 'index'); // ham mac dinh trong controller ten la index
$m = strtolower($m); // viet thuong tat ca ten ham

switch($m){
    case 'index':
        index();
        break;
    case 'add':
        Add();
        break;
    case 'handle-add':
        handleAdd();
        break;
    default:
        index();
        break;
}
function handleAdd(){
    if(isset($_POST['btnSave'])){
        $name = trim($_POST['name'] ?? null);
        $name = strip_tags($name);

        $leader = trim($_POST['leader'] ?? null);
        $leader = strip_tags($leader);

        $status = trim($_POST['status'] ?? null);
        $status = $status === '0' || $status === '1' ? $status : 0;

        $beginningDate = trim($_POST['beginning_date'] ?? null);
        $beginningDate = date('Y-m-d', strtotime($beginningDate));

        // kiem tra thong tin
        $_SESSION['error_add_department'] = [];
        if(empty($name)){
            $_SESSION['error_add_department']['name'] = 'Enter name of department, please';
        } else {
            $_SESSION['error_add_department']['name'] = null;
        }
        if(empty($leader)){
            $_SESSION['error_add_department']['leader'] = 'Enter name of leader, please';
        } else {
            $_SESSION['error_add_department']['leader'] = null;
        }

        // xu ly upload logo
        $logo = null;
        $_SESSION['error_add_department']['logo'] = null;
        if(!empty($_FILES['logo'])){
            $logo = uploadFile(
                $_FILES['logo'],
                'public/uploads/images/',
                ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'],
                5*1024*1024
            );
            if(empty($logo)){
                $_SESSION['error_add_department']['logo'] = 'File only accept extension is .png, .jpg, .jpeg, .gif and file <= 5Mb';
            } else {
                $_SESSION['error_add_department']['logo'] = null;
            }
        }

        $flagCheckingError = false;
        foreach($_SESSION['error_add_department'] as $error){
            if(!empty($error)){
                $flagCheckingError = true;
                break;
            }
        }

        // tien hanh check lai 
        if(!$flagCheckingError){
            // tien hanh insert vao database
            $slug = slug_string($name);
            $insert = insertDepartment($name, $slug, $leader, $status, $beginningDate);
            if($insert){
                header("Location:index.php?c=department&state=success");
            } else {
                header("Location:index.php?c=department&m=add&state=error");
            }
        } else {
            // thong bao loi cho nguoi dung biet
            header("Location:index.php?c=department&m=add&state=fail");
        }
    }
}
function Add(){

    require 'view/department/add_view.php';
}
function index(){
    // phai dang nhap moi duoc su dung chuc nang nay.
    if(!isLoginUser()){
        header("Location:index.php");
        exit();
    }
    require 'view/department/index_view.php';
}