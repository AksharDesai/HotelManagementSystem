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
    </style>
</head>

<body>
    <h1>Welcome Welcome buddy</h1>
    <form action="forgotpassword.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" aria-describedby="email" name="email" required>
        </div>

        <div class="d-flex align-items-center justify-content-between">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Go Back</button>
            <button type="submit" class="btn btn-dark reset" name="send-reset-link">Send</button>
        </div>
    </form>

</body>

</html>



