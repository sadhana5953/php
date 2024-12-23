<?php
header("Access-Control-Allow-Method:POST,DELETE");
header("Content-Type:application/json");
include("config.php");

$c1=new Config();

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $id=$_POST['id'];
    $img=$_FILES['image'];

   $name=$img['name'];
   $path=$img['tmp_name'];

//    $newFileName = uniqid('img') .$name;
//    $fileDestination = 'images/' . $newFileName;

   $uid=uniqid('img');

   $isFileUploded=move_uploaded_file($img['tmp_name'],"images/". $uid .$img["name"]);

   if($isFileUploded){
    $res=$c1->insertImage($id,$name,"images/". $uid .$img["name"]);

   if($res){
    $arr['err']='Image insert successfully!';
}else
{
    $arr['err']='Image not insert!';
}
   }else
   {
    $arr['err']= 'file not upload!';
   }
   

}else if($_SERVER["REQUEST_METHOD"]== "DELETE")
{
    $res=$c1->fetchImage();
    $data=mysqli_fetch_assoc($res);
    $c1->deleteImage($data['path']);
    $arr['error']='image delete!';
}
else
{
    $arr['error']='Only POST type is allow!';
}
echo json_encode($arr);

?>