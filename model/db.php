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
		try{
			$this->db = new PDO('mysql:host=localhost; dbname=tracnghiem_online','root','');
			$this->db->query('set names "utf8"');
		}
		catch(PDOException $ex){
			echo $ex->getMessage();
			die();  
		}
	}
	// hàm gán câu lệnh SQL vào biến $sql
	public function setQuery($sql)
	{
		$this->sql = $sql;
	}
	// hàm thực hiện câu lệnh SQL và trả về 1 mảng đối tượng có các thuộc tính là key
	public function loadRows()
	{
    	$query = $this->db->prepare($this->sql);
    	$query->setFetchMode(PDO::FETCH_OBJ);
    	$query->execute();
    	return $query->fetchAll();	 
	}
	// hàm thực hiện câu lệnh SQL và trả về 1 đối tượng có các thuộc tính là key
	public function loadRow()
	{
    	$query = $this->db->prepare($this->sql);
    	$query->setFetchMode(PDO::FETCH_OBJ);
    	$query->execute();
    	return $query->fetch();	 
	}
}
?>