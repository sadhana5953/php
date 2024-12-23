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
