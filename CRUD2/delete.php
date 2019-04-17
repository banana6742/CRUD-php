<?php

    //check of id parameter from index.php url
    if(isset($_POST["id"])&& !empty(trim($_POST["id"]))){

    require_once "includes/config.php";

    //prepare the select statement
    $sql = "DELETE FROM Students  WHERE id = ?;";
    if($stmt = mysqli_prepare($conn,$sql)){

        //bind the variables to the prepared statement as parameter
        mysqli_stmt_bind_param($stmt,"i",$param_id);

        //set parameter
        $param_id = trim($_POST["id"]);
    
        //Attempt to execute the prepared statment
        if(mysqli_stmt_execute($stmt)){
            header("location: index.php");
            exit;
        }
        else{
            echo "Oops! Something went wrong.Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}else{
    //check existance of id parameter
    if(empty($_GET["id"])){
        header("location: error.php");
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        .wrapper{
            width:  500px;
            margin:0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <div class="page-header">
                    <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>"method="post">    
                        <div class="alert alert-danger">
                        <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"/>
                        <p>Are you sure you want to delete this record?</p><br>
                            <p><input type="submit" value="yes" class="btn btn-danger">
                            <a href="index.php" class="btn btn-default">No</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>