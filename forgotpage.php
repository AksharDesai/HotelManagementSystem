<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            text-align: center;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .form-container img{
            width: 300px;
            height: 300px;
        }
    </style>
</head>

<body>
<?php require('inc/header.php'); ?>
    <div class="form-container bg-white shadow-lg">

    <img src="images\forgot.png" alt="">
        
        <form action="forgotpassword.php" method="POST">
            <div class="form-group">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" aria-describedby="email" name="email" required>
            </div>

            <div class="btn-container">
                <button type="button" class="btn btn-success me-4" data-bs-dismiss="modal">Go Back</button>
                <button type="submit" class="btn btn-dark reset" name="send-reset-link">Send</button>
            </div>
        </form>
    </div>

</body>

</html>
