<?php
require "database/database.php";

function insertDepartment($name, $slug, $leader, $status, $beginDate){
    // viet cau lenh sql insert vao bang department
    $sqlInsert = "INSERT INTO `departments`(`name`,`slug`,`leader`,`date_beginning`,`status`,`created_at`) VALUES(:nameDepartment, :slug, :leader, :beginDate, :statusDepartment, :createdAt)";
    $checkInsert = false;
    $db = connectionDb();
    $stmt = $db->prepare($sqlInsert);
    $currentDate = date('Y-m-d H:i:s');
    if($stmt){
        $stmt->bindParam(':nameDepartment', $name, PDO::PARAM_STR);
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->bindParam(':leader', $leader, PDO::PARAM_STR);
        $stmt->bindParam(':beginDate', $beginDate, PDO::PARAM_STR);
        $stmt->bindParam(':statusDepartment', $status, PDO::PARAM_INT);
        $stmt->bindParam(':createdAt', $currentDate, PDO::PARAM_STR);
        if($stmt->execute()){
            $checkInsert = true;
        }
    }
    disconnectDb($db); // ngat ket noi toi database
    // tra ve true insert thanh cong va nguoc lai
    return $checkInsert;
}