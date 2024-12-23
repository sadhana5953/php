<?php
header("Access-Control-Allow-Method:GET");
header("Content-Type:application/json");

include("config.php");
$c1=new Config();

if($_SERVER["REQUEST_METHOD"]== "GET"){
    $dataList=[];
    $res=$c1->fetch() ;
    
    if($res)
    {
        while($data=mysqli_fetch_assoc($res))
        {
            array_push($dataList,$data);
        }
        $arr['data']=$dataList;
    }
    else{
        $arr['err']='Data not found';
    }
    
}else
{
    $arr['err']="Only GET type is allow!";
}

echo json_encode($arr);
?>