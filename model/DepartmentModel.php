<?php
require "database/database.php";

function getDetailDepartmentById($id = 0){
    $sql = "SELECT * FROM `departments` WHERE `id` = :id AND `deleted_at` IS NULL";
    $db = connectionDb();
    $data = [];
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;
}

function deleteDepartmentById($id = 0){
    $sql = "UPDATE `departments` SET `deleted_at` = :deleted_at WHERE `id` = :id";
    $db = connectionDb();
    $checkDelete = false;
    $deleteTime = date("Y-m-d H:i:s");
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam(':deleted_at', $deleteTime, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $checkDelete = true;
        }
    }
    disconnectDb($db);
    return $checkDelete;
}

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