<?php

/**
 * HỆ THỐNG TRẮC NGHIỆM ONLINE
 * DATABASE ACTION
 * @author: Nong Van Du (Dzu)
 * Mail: dzu6996@gmail.com
 * @link https://github.com/meesudzu/trac-nghiem-online
 **/

class Database
{
    private $db = null;
    private $sql = '';
    private $stmt = null;

    public function __construct()
    {
        $connect = include 'connect.php';
        try {
            $connect_string = 'mysql:host='.$connect->host.'; dbname='.$connect->dbname.'';
            $this->db = new PDO($connect_string, $connect->user, $connect->password);
            $this->db->query('set names "utf8"');
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            die();
        }
    }

    public function set_query($sql = '', array $param = null)
    {
        $this->sql = $sql;
        $this->param = $param;
    }
    // Return an object array
    public function load_rows()
    {
        try {
            $this->stmt = $this->db->prepare($this->sql);
            $this->stmt->setFetchMode(PDO::FETCH_OBJ);
            $this->stmt->execute($this->param);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $this->stmt->fetchAll();
    }
    // Return an object
    public function load_row()
    {
        try {
            $this->stmt = $this->db->prepare($this->sql);
            $this->stmt->setFetchMode(PDO::FETCH_OBJ);
            $this->stmt->execute($this->param);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $this->stmt->fetch();
    }
    //Return boolean
    public function execute_return_status()
    {
        try {
            $this->stmt = $this->db->prepare($this->sql);
            $this->stmt->setFetchMode(PDO::FETCH_OBJ);
            $status = $this->stmt->execute($this->param);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $status;
    }
}
