<?php
header("Access-Control-Allow-Method:POST,GET,PUT,DELETE");
header("Content-Type:application/json");
include("config.php");
$c1=new Config();

if($_SERVER['REQUEST_METHOD']=="POST")
{
	$name=$_POST['name'];
	$age=$_POST['age'];
	$course=$_POST['course'];
	$address=$_POST['address'];
	
	$res=$c1->insert($name,$age,$course,$address);
	if($res)
	{
		$arr['msg']="Data insert successfully.";
	}else
	{
		$arr['error']="Data insertion failed!";
	}
}else if($_SERVER['REQUEST_METHOD']=="GET")
{
	$dataList=[];
	$res=$c1->fetch();
	while($data=mysqli_fetch_assoc($res))
	{
		array_push($dataList,$data);
	}
	$arr['data']= $dataList;
}else if($_SERVER['REQUEST_METHOD']=="PUT")
{
	$data=file_get_contents("php://input");
	parse_str($data,$result);
	
	$name=$result["name"];
	$age=$result["age"];
	$course=$result["course"];
	$address=$result["address"];
	$id=$result["id"];

	$res=$c1->update($name,$age,$course,$address,$id);

	if($res)
	{
		$arr["msg"]= "Data update successfully!";
	}else
	{
		$arr["error"]= "Data updation failed!";
	}
}else if($_SERVER['REQUEST_METHOD']=="DELETE")
{
	$data=file_get_contents("php://input");
	parse_str($data,$result);
	$id=$result["id"];

	$res=$c1->delete($id);
	if($res)
	{
		$arr["msg"]= "Data delete successfully!";
	}else
	{
		$arr["error"]= "Data deletion failed!";
	}
}
else{
	$arr['error']="Only POST type is allowed!";
}

echo json_encode($arr);
?>