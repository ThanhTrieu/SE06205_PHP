<?php
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
        echo '<pre>';
        print_r($_POST);
    }
}
function Add(){
    $departments = getAllDataDepartments();// goi tu department model
    require 'view/courses/add_view.php';
}
function index(){
    // phai dang nhap moi duoc su dung chuc nang nay.
    if(!isLoginUser()){
        header("Location:index.php");
        exit();
    }
    require 'view/courses/index_view.php';
}