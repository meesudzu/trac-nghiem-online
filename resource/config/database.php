<?php

/**
 * DATABASE
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/

class Database
{
    private $db = '';
    private $sql = '';
    //kết nối cơ sở dữ liệu
    public function __construct()
    {
        $connect = include ('connect.php');
        try {
            $db = 'mysql:host='.$connect->host.'; dbname='.$connect->dbname.'';
            $this->db = new PDO($db, $connect->user, $connect->password);
            $this->db->query('set names "utf8"');
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }
    public function set_query($sql)
    {
        $this->sql = $sql;
    }
    // hàm thực hiện câu lệnh SQL và trả về 1 mảng đối tượng có các thuộc tính là key
    public function load_rows()
    {
        try {
            $query = $this->db->prepare($this->sql);
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $query->fetchAll();
    }
    // hàm thực hiện câu lệnh SQL và trả về 1 đối tượng có các thuộc tính là key
    public function load_row()
    {
        try {
            $query = $this->db->prepare($this->sql);
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $query->fetch();
    }
    //thực thi insert hoặc update và return true false
    public function execute_return_status()
    {
        try {
            $query = $this->db->prepare($this->sql);
            $query->setFetchMode(PDO::FETCH_OBJ);
            $status = $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $status;
    }
}
