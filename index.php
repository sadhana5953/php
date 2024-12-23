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

if(isset($_POST["save"]))
{
  $id=$_POST["deleteId"];
  $name=$_POST["nameId"];
  $age=$_POST["ageId"];
  $course=$_POST["courseId"];
  $address=$_POST["addressId"];

  $c1->update($name,$age,$course,$address,$id);
  header("Location:index.php");
}

if(isset($_POST["delete"]))
{
  $id=$_POST["deleteId"];

  $c1->delete($id);
  header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
<!-- Button trigger modal -->

<!-- Modal -->
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
      <button type="button" class="btn btn-warning" onclick="showUpdateDialog(<?php echo htmlspecialchars(json_encode($data)) ?>)">Update</button>
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
   <div class="mb-3 row">
      <label for="name" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-20">
         <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your name">
      </div>
   </div>
   <div class="mb-3 row">
      <label for="age" class="col-sm-2 col-form-label">Age</label>
      <div class="col-sm-20">
         <input type="number" class="form-control" id="age" name="age" required placeholder="Enter your age">
      </div>
   </div>
   <div class="mb-3 row">
      <label for="course" class="col-sm-2 col-form-label">Course</label>
      <div class="col-sm-20">
         <input type="text" class="form-control" id="course" name="course" required placeholder="Enter your course">
      </div>
   </div>
   <div class="mb-3 row">
      <label for="address" class="col-sm-2 col-form-label">Address</label>
      <div class="col-sm-20">
         <input type="text" class="form-control" id="address" name="address" required placeholder="Enter your address">
      </div>
   </div>
   <div class="mb-3 row">
      <div class="col-sm-10 offset-sm-2">
         <button name="button" type="submit" class="btn btn-primary">Submit</button>
      </div>
   </div>
</form>

      </div>
    </div>
  </div>
</div>
</div>


    <!-- Update Modal -->

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="updateId" name="deleteId">
                        <div class="mb-3">
                            <label for="updateName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="updateName" name="nameId">
                        </div>
                        <div class="mb-3">
                            <label for="updateAge" class="form-label">Age</label>
                            <input type="number" class="form-control" id="updateAge" name="ageId">
                        </div>
                        <div class="mb-3">
                            <label for="updateCourse" class="form-label">Course</label>
                            <input type="text" class="form-control" id="updateCourse" name="courseId">
                        </div>
                        <div class="mb-3">
                            <label for="updateAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="updateAddress" name="addressId">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>

        function showUpdateDialog(data) {
            document.getElementById('updateId').value = data.id;
            document.getElementById('updateName').value = data.name;
            document.getElementById('updateAge').value = data.age;
            document.getElementById('updateCourse').value = data.course;
            document.getElementById('updateAddress').value = data.address;

            var updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
            updateModal.show();
        }
    </script>
</body>
</body>
</html>