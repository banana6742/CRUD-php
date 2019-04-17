<?php

include_once('includes/config.php');

//create the table 
$sql = "CREATE TABLE IF NOT EXISTS Students (
    id INT(2) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    address VARCHAR(50) NOT NULL,
    class VARCHAR(10) NOT NULL,
    score INT(10),
    reg_date TIMESTAMP
    )";

// if($conn->query($sql)=== TRUE)
//     echo "Table Students created successfully<br>";
// else
//     echo "Error creating table:".$conn->error;

//     //insert records into table
//     $sql  = "INSERT INTO Students(name, address, class, score) VALUES ('John','JohnDoe,India','Apple','89');";
//     $sql .= "INSERT INTO Students(name, address, class, score) VALUES ('Michel','Gates,Japan','Banana','20');";
//     $sql .= "INSERT INTO Students(name, address, class, score) VALUES ('Sridhar','Murali,France','Banana','50');";
//     $sql .= "INSERT INTO Students(name, address, class, score) VALUES ('Bill','Clinton,Indonesia','Apple','89');";
//     $sql .= "INSERT INTO Students(name, address, class, score) VALUES ('Sundar','Pichhai,Russia','watermelon','45');";

//     if($conn->multi_query($sql)=== TRUE)
//     echo "New record created successfully<br>";
//     else
//     echo "Error :". $sql . "<br>" .$conn->error;
   
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2 class="float-left text-center">Students Details</h2>
                    <a href="create.php" class="btn btn-success float-right mb-2">Add New Student</a>    
                </div>
                <?php
                    //select all records
                    $sql = "SELECT * FROM Students";
                    if($result = mysqli_query($conn,$sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#             </th>";
                                        echo "<th>Name          </th>";
                                        echo "<th>Address       </th>";
                                        echo "<th>Class       </th>";
                                        echo "<th>Score        </th>";
                                        echo "<th colspan=2>Action</th>";
                                    echo "<tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>".$row['id']      ."</td>";
                                        echo "<td>".$row['name']    ."</td>";
                                        echo "<td>".$row['address'] ."</td>";
                                        echo "<td>".$row['Class']   ."</td>";
                                        echo "<td>".$row['Score']   ."</td>";
                                            echo "<td><a href='read.php?id=".$row['id']."' title='View Record'>
                                            <i class='fas fa-eye'></i></a></td>";
                                            echo "<td><a href='update.php?id=".$row['id']."' title='Update Record'>
                                            <i class='fas fa-edit'></i></a></td>";
                                            echo "<td><a href='delete.php?id=".$row['id']."' title='Delete Record'>
                                            <i class='fas fa-trash'></i></a></td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";

                                mysqli_free_result($result);
                        }
                        else
                            echo "<p class='lead'><em>No records were found</em></p>";                    }            
                    
                    else
                            echo "ERROR: Could not able to execute $sql.".mysqli_error($conn);                           

                    mysqli_close($conn);
                ?>

                </div>
            </div>
        </div>
    
</body>
</html>