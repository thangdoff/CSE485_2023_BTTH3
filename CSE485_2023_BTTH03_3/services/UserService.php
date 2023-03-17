<?php
require_once("configs/DBConnection.php");
include("models/User.php");
class UserService{
    public function getAllUsers(){
        // 4 bước thực hiện
       $dbConn = new DBConnection();
       $conn = $dbConn->getConnection();

        // B2. Truy vấn
        $sql = "SELECT * FROM users";
        $stmt = $conn->query($sql);

        // B3. Xử lý kết quả
        $users = [];
        while($row = $stmt->fetch()){
            $user = new User($row['id'], $row['username'], $row['password'], $row['role']);
            array_push($users,$user);
        }
        // Mảng (danh sách) các đối tượng Article Model

        return $users;
    }

    public function addUser($username,$password,$role){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "insert into users (username,password,role) values('$username','$password','$role');";
        
        $result = $conn->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }

    }
    public function checkLogin($username){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn ->query($sql);
        $users = [];
        while($row = $result->fetch()){
            $user = new User($row['id'], $row['username'], $row['password'], $row['role']);
            array_push($users,$user);
        }

    
        return $users;
    }

    public function findUserById($id){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = $conn ->query($sql);
        return $result;

    }
    public function getAllRole(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "SHOW COLUMNS FROM users WHERE Field='role'";
        $stmt = $conn ->query($sql);
        while($row = $stmt->fetch()){
            $enum_list = explode(",", str_replace("'", "", substr($row['Type'], 5, (strlen($row['Type'])-6))));
        }
        
        return $enum_list;
    }
    public function editUser($id, $username, $password, $role){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "UPDATE users SET username = '$username', password='$password', role='$role' Where id = '$id'";

        $result = $conn -> query($sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function deleteUser($id){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "delete from users where id = '$id'";
        $result = $conn ->query($sql);
        if($result){
            return true;
        }else{
            return false;
        }


    }
    public function countUser(){
        $dbConn = new DBConnection();
        $conn = $dbConn->getConnection();

        $sql = "SELECT COUNT(id) as count FROM users";
        $result = $conn ->query($sql);
        while ($row = $result->fetch()) {
            $count = strval($row['count']);
        }
        return $count;
    }
    
}