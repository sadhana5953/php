<?php 

include("config.php");
$c1=new Config();
session_start();
   
$res=$c1->fetch();

$check=isset($_POST["button"]);

if($check)
{
  $name=$_POST["name"];
  $age=$_POST["age"];
  $course=$_POST["course"];
  $address=$_POST["address"];
  $res=$c1->insert($name,$age,$course,$address);
  header("Location:index.php");
  if($res)
  {
    echo "data insert successsfuly!";
  }else
  {
    echo "data insertion failed!";
  }
}
if(isset($_POST['update']))
{
   $id = $_SESSION["deleteId"];
   $name = $_SESSION["nameId"];
   $age = $_SESSION["ageId"];
   $course = $_SESSION["courseId"];
   $address = $_SESSION["addressId"];
   header("Location:update.php");
}
if(isset($_POST['Save']))
{
	$id=$_POST['deleteId'];
	$name=$_POST['nameId'];
	$age=$_POST['ageId'];
	$course=$_POST['courseId'];
	$address=$_POST['addressId'];
	
	$res=$c1->update($name,$age,$course,$address,$id);
	header("Location:index.php");
  if($res)
  {
    echo "data update successsfuly!";
  }else
  {
    echo "data updation failed!";
  }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alert Box with PHP and Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
    body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://media.istockphoto.com/id/1218588306/photo/student-hands-filling-out-form-document-at-home.jpg?s=612x612&w=0&k=20&c=1MJoJESmA7KQIMWEew72WyzgtqDBzG8EVjLxmoDf9MQ=');
   
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        height: 100vh;
     
        margin: 0;
   
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .container {
        background-color: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
       
        padding: 20px;
        border-radius: 20px;
        color: white;
    }
    </style>

</head>
<body>
   
<button class="btn btn-primary" onclick="showAlert('Hello, this is a dynamic message!')">Click Me</button>


<div class="container px-4 text-center">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3">
     <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">AGE</th>
      <th scope="col">COURSE</th>
      <th scope="col">ADDRESS</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
  <?php while($data=mysqli_fetch_assoc($res)){ ?>
      <tr>
      <th scope="row"><?php echo $data['id'] ?></th>
      <td><?php echo $data['name'] ?></td>
      <td><?php echo $data['age'] ?></td>
      <td><?php echo $data['course'] ?></td>
      <td><?php echo $data['address'] ?></td>
      <td>
      <form method="POST">
      <input value=<?php echo $data['id'] ?> type="hidden" name="deleteId">
      <input value=<?php echo $data['name'] ?> type="hidden" name="nameId">
      <input value=<?php echo $data['age'] ?> type="hidden" name="ageId">
      <input value=<?php echo $data['course'] ?> type="hidden" name="courseId">
      <input value=<?php echo $data['address'] ?> type="hidden" name="addressId">
      <button onclick="showAlert('Hello, this is a dynamic message!')" type="button" name="update" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Update
</button>
      <!-- <button type="submit" class="btn btn-warning" name="update">Update</button> -->

      <button type="submit" class="btn btn-danger" name="delete">Delete</button>
      </form>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>

     </div>
    </div>
    <div class="col">
      <div class="p-3">
      <div class="mx-auto p-2" style="width: 300px;">

      <h3>Student Registration Form</h3>
  <form method="POST">
      <div class="mb-3">
         <label  class="form-label">Full Name</label>
         <input type="text" class="form-control" id="name" name="name" required>
         <div id="name"></div>
      </div>
      <div class="mb-3">
         <label  class="form-label">Age</label>
         <input type="number" class="form-control" id="age" name="age" required>
         <div id="age"></div>
      </div>
      <div class="mb-3">
         <label  class="form-label">Course</label>
         <input type="text" class="form-control" id="course" name="course" required>
         <div id="course"></div>
      </div>
      <div class="mb-3">
         <label  class="form-label">Address</label>
         <input type="text" class="form-control" id="address" name="address" required>
         <div id="address"></div>
      </div>
      <button name="button" type="submit" class="btn btn-primary">Submit</button>
   </form>
      </div>
    </div>
  </div>
</div>

</div>

<!-- Alert Box -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="alertMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Script to Pass Value -->
<script>
    function showAlert(message) {
        document.getElementById('alertMessage').innerText = message;
        $('#alertModal').modal('show');
    }
</script>
</body>
</html>
