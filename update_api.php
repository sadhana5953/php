<?php
header  ("Access-Control-Allow-Method:PUT");
header ("Content-Type:application/json");

include("config.php");
$c1=new Config();

if($_SERVER["REQUEST_METHOD"]== "PUT"){
    $data=file_get_contents("php://input");
    parse_str($data, $result);
    $id= $result["id"];
    $name= $result["name"];
    $age= $result["age"];
    $course= $result["course"];
    $address= $result["address"];

    $res=$c1->update($id,$name,$age,$course,$address);
    if($res){
        $arr['err']='Data updated successfully!';
    }else
    {
        $arr['err']='Data not updated!';
    }
    
}else
{
    $arr['err']='Only PUT type is allow';
}

echo json_encode($arr);
?>