<?php 

    session_start();

    require_once "config/db.php";

    if (isset($_POST['update'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city_name = $_POST['city_name'];
        $email = $_POST['email'];

        $sql= "update employee set first_name='$first_name', last_name='$last_name', city_name='$city_name', email='$email'  where email='$email' ";
        
        $sqlparse =oci_parse($conn,$sql);
        $result=oci_execute($sqlparse) or die(oci_error());
        if ($result) {
            $_SESSION['success'] = "Data has been updated successfully";
            header("location: index.php");
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
            header("location: index.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .container {
            max-width: 550px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
    <?php
        if (isset($_GET['idf'])) {
            $idf = $_GET['idf'];

            $query= "SELECT * FROM EMPLOYEE WHERE first_name='$idf' ";
            $parsesql = oci_parse($conn, $query);
            oci_execute($parsesql);
            while($rows=oci_fetch_object($parsesql)){ 
               
    ?>
        <h1>Edit Data</h1>
        <hr>
        <form action="edit.php" method="post" enctype="multipart/form-data">
            
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">First Name:</label>
                    <input type="text" value="<?php echo $rows->FIRST_NAME; ?>" required class="form-control" name="first_name" >
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">Last Name:</label>
                    <input type="text" value="<?php echo $rows->LAST_NAME; ?>" required class="form-control" name="last_name">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="col-form-label">City:</label>
                    <input type="text" value="<?php echo $rows->CITY_NAME; ?>" required class="form-control" name="city_name">
                </div>
                <div class="mb-3">
                    <label for="img" class="col-form-label">Email:</label>
                    <input type="hidden" value="<?php echo $rows->EMAIL; ?>" required class="form-control" name="email">
                </div>
                <hr>
                <a href="index.php" class="btn btn-secondary">Go Back</a>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            
        </form>
    <?php } }?>
    </div>
</body>
</html>