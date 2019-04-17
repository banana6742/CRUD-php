<?php

    require_once('includes/config.php');

    //Define varables and initialize with empty values
    $name = $address = $class = $score = "";
    $name_err = $address_err = $class_err = $score_err = "";

    //processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //validate name
        $input_name = trim($_POST["name"]);
        if(empty($input_name)){
            $name_err = "Please enter a name.";
        }
        else{
            $name = $input_name;
        }
    

    //validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";
    }else{
        $address = $input_address;
    }

    //validate class
    $input_class = trim($_POST["class"]);
    if(empty($input_class)){
        $class_err = "Please enter an class.";
    }else{
        $class = $input_class;
    }

    //validate score
    $input_score = trim($_POST["score"]);
    if(empty($input_score)){
        $score_err = "Please enter an score.";
    }else{
        $score = $input_score;
    }

    
    //check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($class_err) && empty($score_err)){

        $sql="INSERT INTO Students(name, address, Class, Score) VALUES (?,?,?,?)";

        if($stmt = mysqli_prepare($conn,$sql)){
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_class, $param_score);

            //set parameters
            $param_name = $name;
            $param_address = $address;
            $param_class = $class;
            $param_score = $score;

            //Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
                exit();
            }else{
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Create Record</title>
</head>
<style> .wrapper{ width:500px; margin:0 auto;}</style>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header text-center">
                        <h2>Create Record</h2>
                    </div>
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name;?>">
                            <span class="error"><?php echo $name_err ?></span>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control"><?php echo $address;?> </textarea>
                            <span class="error"><?php echo $address_err ?></span>
                        </div>
                        <div class="form-group">
                            <label for="class">Class</label>
                            <input type="text" name="class" class="form-control" value="<?php echo $class;?>">
                            <span class="error"><?php echo $class_err ?></span>
                        </div>
                        <div class="form-group">
                            <label for="score">Score</label>
                            <input type="text" name="score" class="form-control" value="<?php echo $score;?>">
                            <span class="error"><?php echo $score_err ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="index.php" class="btn btn-default">Cancel</a>
                        </div>              
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>