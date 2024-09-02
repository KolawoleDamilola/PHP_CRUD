<?php require_once 'process.php'; 
    $mysqli = new mysqli('localhost', 'datatype', 'password', 'crud1') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM datatype") or die($mysqli->error);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Form Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-image: url(login.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container-fluid {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .form-control {
            width: 100%;
        }

        .span {
            color: red;
        }

        

       
    </style>
</head>
<body>


<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif ?>

<div class="container">

    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phonenumber']; ?></td>
                    <td>
                        <a href="form4.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                        <a href="form4.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="container-fluid">
        <h2>SIGN UP!</h2>
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="mb-3 mt-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" value="<?php echo $name; ?>" placeholder="Enter name" name="name">
                <span class="span"><?php echo $nameerr; ?></span>
            </div>

            <div class="mb-3 mt-3">
                <label for="email">Email:</label>
                <input type="text" class="form-control" value="<?php echo $email; ?>" placeholder="Enter email" name="email">
                <span class="span"><?php echo $emailerr; ?></span>
            </div>

            <div class="mb-3 mt-3">
                <label for="phonenumber">Phone number:</label>
                <input type="text" class="form-control" value="<?php echo $phonenumber; ?>" placeholder="Enter Phone number" name="phonenumber">
                <span class="span"><?php echo $phonenumbererr; ?></span>
            </div>

            <?php if ($update == true): ?>
                <button type="submit" name="update" class="btn btn-info">Update</button>
            <?php else: ?>
                <button type="submit" name="damibtn" class="btn btn-primary">Submit</button>
            <?php endif; ?>
        </form>
    </div>
</div>
</body>
</html>
