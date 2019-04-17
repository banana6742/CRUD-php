<?php

    require_once('includes/config.php');

    //declare and initialize variables
    $name = $address = $class = $score = "";
    $name_err = $address_err = $class_err = $score_err = "";


    if(isset($_POST["id"]) && !empty($_POST["id"])){

        //get hidden input value
        $id = $_POST["id"];

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


        //check input error before inserting in database
        if(empty($name_err) && empty($address_err) && empty($class_err) && empty($score_err)){

            //prepare an update query
            $sql = "UPDATE Students SET name = ?, address = ?, class = ?, score = ? WHERE id=?;";

            if($stmt = mysqli_prepare($conn,$sql)){

                mysqli_stmt_bind_param($stmt, "sssii", $param_name, $param_address, $param_class, $param_score, $param_id);

                //set parameters
                $param_name = $name;
                $param_address = $address;
                $param_class = $class;
                $param_score = $score;
                $param_id = $id;

                //Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    //Records updated successfully then redirect to index.php
                        header("location: index.php");
                        exit();
                }
                else{
                    echo "Something went wrong. Please try again later";
                }

            }

            //close statement
            mysqli_stmt_close($stmt);
        }
        //close connection
        mysqli_close($conn);
        }
        else{
                if(isset($_GET["id"]) && !empty($_GET["id"])){
                    //Get id from the URL
                    $id = $_GET["id"];

                    //prepare an select query
                    $sql = "SELECT * FROM Students WHERE id = ?;";

                    if($stmt = mysqli_prepare($conn,$sql)){

                        mysqli_stmt_bind_param($stmt, "i", $param_id);

                        //set parameters
                        $param_id = $id;

                        //Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){

                            $result = mysqli_stmt_get_result($stmt);

                            if(mysqli_num_rows($result) == 1){
                                //Fetch result row as an associative array.
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                //Retrive individual field value
                                $name = $row["name"];
                                $address = $row["address"];
                                $class = $row["Class"];
                                $score = $row["Score"];
                            }
                            else{
                                //URL doesn't contain valid id. Redirect to error page
                                header("location: error.php");
                                exit();
                            }

                        }
                        else{
                            echo "Something went wrong. Please try again later";
                        }
                }
                //close statement
                mysqli_stmt_close($stmt);

                //close connection
                mysqli_close($conn);
        }else {
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
    <title>Update Record</title>
    <style> .wrapper{ width:500px; margin:0 auto;}</style>
</head>
<body>
<div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header text-center">
                        <h2>Update Record</h2>
                    </div>
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name;?>">
                            <span class="error"><?php echo $name_err ?></span>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?> </textarea>
                            <span class="error"><?php echo $address_err ?></span>
                        </div>
                        <div class="form-group">
                            <label for="salary">Class</label>
                            <input type="text" name="class" class="form-control" value="<?php echo $class;?>">
                            <span class="error"><?php echo $class_err ?></span>
                        </div>
                        <div class="form-group">
                            <label for="score">Score</label>
                            <input type="text" name="score" class="form-control" value="<?php echo $score;?>">
                            <span class="error"><?php echo $score_err ?></span>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $id;?>"/>
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