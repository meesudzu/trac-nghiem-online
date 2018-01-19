<?php

/**
 * DATABASE
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class Database{
	private	$db = '';
	private $sql = '';
	// hàm kết nối cơ sở dữ liệu
	public function Database()
	{
		$host = 'localhost';
		$dbname = 'tracnghiem_online';
		$user = 'root';
		$pw = '';
		try{
			$db = 'mysql:host='.$host.'; dbname='.$dbname.'';
			$this->db = new PDO($db,$user,$pw);
			$this->db->query('set names "utf8"');
		}
		catch(PDOException $ex){
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
		try
		{
			$query = $this->db->prepare($this->sql);
			$query->setFetchMode(PDO::FETCH_OBJ);
			$query->execute();
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
		return $query->fetchAll();
	}
	// hàm thực hiện câu lệnh SQL và trả về 1 đối tượng có các thuộc tính là key
	public function load_row()
	{
		try
		{
			$query = $this->db->prepare($this->sql);
			$query->setFetchMode(PDO::FETCH_OBJ);
			$query->execute();
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
		return $query->fetch();
	}
	//thực thi insert hoặc update và không có return
	public function execute_none_return()
	{
		try
		{
			$query = $this->db->prepare($this->sql);
			$query->setFetchMode(PDO::FETCH_OBJ);
			$query->execute();
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}
?>
