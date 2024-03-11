<?php 
function getSessionUsername(){
    $username = $_SESSION['username'] ?? null;
    return $username;
}
function getSessionEmail(){
    $email = $_SESSION['email'] ?? null;
    return $email;
}
function getSessionIdUser(){
    $id = $_SESSION['idUser'] ?? null;
    return $id;
}
function getSessionRoleIdUser(){
    $roleId = $_SESSION['roleId'] ?? null;
    return $roleId;
}
function getSessionIdAccount(){
    $accountId = $_SESSION['idAccount'] ?? null;
    return $accountId;
}