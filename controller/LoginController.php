<?php
// m = ten cua ham nam trong file controller trong thu muc controller 
$m = trim($_GET['m'] ?? 'index'); // ham mac dinh trong controller ten la index
$m = strtolower($m); // viet thuong tat ca ten ham
switch($m){
    case 'index':
        index();
        break;
    case 'handle':
        handleLogin();
        break;
    default:
        index();
        break;
}
function handleLogin(){
    // kiem tra nguoi dung bam submit login chua ?
    if(isset($_POST['btnLogin'])){
        echo "<pre>";
        print_r($_POST);
    }
}
function index(){

    require "view/login/index_view.php";
}