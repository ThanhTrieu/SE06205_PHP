<?php
require "database/database.php";

function insertDepartment($name, $leader, $status, $beginDate){
    // viet cau lenh sql insert vao bang department
    $sqlInsert = "INSERT INTO `departments`(`name`,`slug`,`leader`,`beginning_date`,`status`,`created_at`) VALUES(:nameDepartment, :slug, :leader, :beginDate, :statusDepartment, :createdAt)";
}