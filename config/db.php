<?php

class db
{
    // Thuộc tính kết nối PDO
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "restful_api_php";
    private $conn;

    // Phương thức kết nối PDO
    public function connect()   
    {
        $this->conn = null;
        try 
        {
            // Chuỗi DSN (Data Source Name) không có khoảng trắng thừa
            $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->db, $this->username, $this->password);
            $this->conn->exec("SET NAMES 'utf8'");
            // Thiết lập chế độ báo lỗi cho PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Kết nối thành công";

            // Trả về kết nối
            return $this->conn;

        } catch(PDOException $e) {

            echo "Kết nối thất bại: " . $e->getMessage();
            //return null; // Trả về null nếu kết nối thất bại
        }
        return $this->conn;
    }
}

?>
