<?php
require "database/database.php";

function getAllDataDepartments(){
    $sql = "SELECT * FROM `departments` WHERE `deleted_at` IS NULL";
    $db = connectionDb();
    $stmt = $db->prepare($sql);
    $data = [];
    if($stmt){
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;
}

function insertDepartment($name, $slug, $leader, $status, $logo, $beginDate){
    // viet cau lenh sql insert vao bang department
    $sqlInsert = "INSERT INTO `departments`(`name`,`slug`,`leader`,`date_beginning`,`status`, `logo`,`created_at`) VALUES(:nameDepartment, :slug, :leader, :beginDate, :statusDepartment, :logo, :createdAt)";
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
        $stmt->bindParam(':logo', $logo, PDO::PARAM_STR);
        $stmt->bindParam(':createdAt', $currentDate, PDO::PARAM_STR);
        if($stmt->execute()){
            $checkInsert = true;
        }
    }
    disconnectDb($db); // ngat ket noi toi database
    // tra ve true insert thanh cong va nguoc lai
    return $checkInsert;
}