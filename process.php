<?php
$mysqli = new mysqli('localhost', 'datatype', 'password', 'crud1') or die(mysqli_error($mysqli));
// $result = $mysqli->query("SELECT * FROM datatype") or die($mysqli->error);
session_start();


$id = 0;
$update = false;
$name = '';
$email = '';
$phonenumber = '';
$errors = false;
$nameerr = $emailerr = $phonenumbererr = '';

if (isset($_POST['damibtn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];

    // Validation
    if (empty($name)) {
        $nameerr = "Please enter your name";
        $errors = true;
    }

    if (empty($email)) {
        $emailerr = "Email is required";
        $errors = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailerr = "Invalid email format";
        $errors = true;
    }

    if (empty($phonenumber)) {
        $phonenumbererr = "Phone number is required";
        $errors = true;
    }

    if (!$errors) {
        $mysqli->query("INSERT INTO datatype (name, email, phonenumber) VALUES ('$name', '$email', '$phonenumber')") or die($mysqli->error);

        $_SESSION['message'] = "Saved Successfully!";
        $_SESSION['msg_type'] = "success";
        header("location: form4.php");
        exit();
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM datatype WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Deleted Successfully!";
    $_SESSION['msg_type'] = "danger";
    header("location: form4.php");
    exit();
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    // $update = true;
    $result = $mysqli->query("SELECT * FROM datatype WHERE id=$id") or die($mysqli->error());

    if ($result->num_rows == 1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $email = $row['email'];
        $phonenumber = $row['phonenumber'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];

    // Validation (similar to above)
    if (empty($name)) {
        $nameerr = "Please enter your name";
        $errors = true;
    }

    if (empty($email)) {
        $emailerr = "Email is required";
        $errors = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailerr = "Invalid email format";
        $errors = true;
    }

    if (empty($phonenumber)) {
        $phonenumbererr = "Phone number is required";
        $errors = true;
    }

    if (!$errors) {
        $mysqli->query("UPDATE datatype SET name='$name', email='$email', phonenumber='$phonenumber' WHERE id=$id") or die($mysqli->error);

        $_SESSION['message'] = "Record has been updated!";
        $_SESSION['msg_type'] = "warning";
        header("location: form4.php");
        exit();
    }
}
?>
