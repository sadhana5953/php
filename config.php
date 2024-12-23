<?php

class Config
{
    private $host="localhost";
    private $username= "root";
    private $password= "";
    private $database= "demo";
    private $connection;

    public function connect()
    {
        $this->connection=mysqli_connect($this->host,$this->username,$this->password,$this->database);
        // if($this->connection)
        // {
        //     echo "database is connected!";
        // }
        // else
        // {
        //     echo "database connection failed!";
        // }
    }

    public function __construct()
    {
        $this->connect();
    }

    public function insert($name,$age,$course,$add)
    {
        $sql= "INSERT INTO students(name,age,course,address) VALUES('$name',$age,'$course','$add')";
        $res=mysqli_query($this->connection,$sql);
        return $res;
    }
	
	public function fetch()
	{
		$sql="SELECT * FROM students";
		$res=mysqli_query($this->connection,$sql);

		return $res;
	}
	public function update($name,$age,$course,$address,$id)
	{
		$sql="UPDATE students SET name='$name',age=$age,course='$course',address='$address' WHERE id=$id";
		$res=mysqli_query($this->connection,$sql);
		return $res;
	}

    public function delete($id)
    {
        $sql= "DELETE FROM students WHERE id=$id";
        $res=mysqli_query($this->connection,$sql);
        return $res;
    }
}
?>