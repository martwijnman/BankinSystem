<?php
$action = $_POST['action'];
require_once "conn.php";

if($action == "login"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE :username = username";
    $stmt = $conn->prepare($query);
    $stmt->execute([":username" => $username,]);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $hash = password_hash($password, PASSWORD_DEFAULT);
    if(!password_verify($user['password'], $hash)){
        $msg = "Error: password";
        header("Location: login.blade.php?msg=$msg");
    }
    session_start();
    $_SESSION['username'] = $user['username'];
    $_SESSION['id'] = $user['id'];
    $id = $_SESSION['id'];
    header("Location:home.blade.php?id=$id");
}
if($action == "add"){
    $title = $_POST['title'];
    if(empty($title)){
        $msg[] = "don't forgot to put the title";
    }
    $type = $_POST['type'];
    if(empty($type)){
        $msg[] = "don't forgot to put a type";
    }
    $price = $_POST['price'];
    if(empty($price)){
        $msg[] = "don't forgot to add the price";
    }
    $user = $_POST['user'];
    if(empty($user)){
        $msg[] = "don't forgot to put an user number";
    }
    $sql = "INSERT INTO transaction (title, type, price, user) VALUES (:title, :type, :price, :user)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([":title" => $title, ":type" => $type, ":price" => $price, ":user" => $user,]);

}
if($action == "delete"){
    $id = $_POST['id'];
    $sql = "DELETE FROM transaction WHERE :id = id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([":id" => $id]);

}