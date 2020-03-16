<?php session_start(); ?>
<?php include "config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Create Account</title>
</head>

<body>

    <?php

        if(empty($_POST)) { 
            
        } elseif(preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST["username"])) {
            if( $_POST["password"] === $_POST["confirm-password"]) {
                filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                    $sql = "INSERT INTO user (username, email, `password`)
                    VALUES ('$username', '$email', '$password')";

                    if ($conn->query($sql) === TRUE) {
                        $_SESSION["username"] = $_POST["username"];
                        header("Location: dashboard.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    $conn->close();

            } else {
                echo "<div class='alert alert-danger'>Please enter matching password</div>";
            }
            
        } else {
            echo "<div class='alert alert-danger'>Please enter valid information</div>";
        }
    
    ?>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Create Account</h1>
                <div class="alert"></div>
                <form class="w-50 mx-auto" action="create-account.php" method="post">
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input id="username" class="form-control" name="username" type="text" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input id="password" class="form-control" name="password" type="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input id="confirm-password" class="form-control" name="confirm-password" type="password" placeholder="Confirm Password">
                    </div>
                    <button id="submit" class="btn btn-dark form-control">Submit</button>
                </form>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="./js/create-account.js"></script>
</body>

</html>