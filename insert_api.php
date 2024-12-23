<?php
header("Access-Control-Allow-Method:POST");
header("Content-Type:application/json");
include("config.php");

$c1=new Config();
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        $name=$_POST["name"];
        $age=$_POST["age"];
        $course=$_POST["course"];
        $address=$_POST["address"];

        $res=$c1->insert($name,$age,$course,$address);

        if($res){
            $arr['msg']="Data insert Successfully!";
        }else
        {
            $arr["err"]= "Data not inserted!";
        }

    }else
    {
        $arr['error']= "Only POST type is allow!";
    }

    echo json_encode($arr);
?>