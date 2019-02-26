<?php

session_start();

// Create Database connection
$mysqli = new mysqli('localhost', 'root', 'Brenden448474', 'crud') or die(mysqli_error($mysqli));

// Set name and location to empty string because the edit button hasnt been click
$id = 0;
$update = false;
$name = '';
$location = '';

// Insert values into Database when user clicks the submit button
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name, location) VALUES('$name', '$location')") or
        die($mysqli->error);
    
    
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

// Delete values from database if user clicks delete button
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

// Edit values from database when user clicks edit button
if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

    if(mysqli_num_rows($result)==1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}