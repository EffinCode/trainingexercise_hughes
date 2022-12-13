<?php
session_start();
require 'db/conn.php';

if(isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];    

    $query = 
            " SELECT `username`, `user_role`" .
            " FROM `users`" .
            " WHERE `email` = '$userEmail'";

    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result)) {
        $userLoggedIn = $row['username'];
        $userRole = $row['user_role'];
    }
}
else {
    header("Location: http://localhost/Open_door/login.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/src/css/style.css">
    
    <script src="assets/src/js/script.js"></script>
    <title>The 'Inconsistent' Application</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand" href="#">The Quiz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="http://localhost/Open_door/home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/Open_door/check_result.php">Check Results</a>
            </li> 
            <?php 
                if($userRole < 2) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/Open_door/upload_subject.php">Add Questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/Open_door/delete_subject.php">Delete Questions</a>
                    </li><li class="nav-item">
                        <a class="nav-link" href="http://localhost/Open_door/edit_subject.php">Edit Questions</a>
                    </li> <?php  
                }
            ?>                  
        </ul>
        <span class="navbar-text">
            User Logged in: <?php echo $userLoggedIn; ?>
        </span>        
        <span class="navbar-text">
            <a class="nav-link" href="logout.php">Logout</a>
        </span>
    </div>
    </nav>






<?php

// require 'db/conn.php';


// if(isset($_SESSION['email']))  {
      // $useremail  =  $_SESSION['email'];
    
    
        //user role parameter binded here understands which restrictions must be observed by user account
      //  $query = "SELECT 'username', 'user_role' FROM training_quiz.users WHERE 'email' = '$userEmail'";
    
      //  $result = mysqli_query($conn, $query);
    
       // while($row = mysqli_fetch_array($result))  {
        //    $userLoggedIn = $row['username'];
         //   $userRole = $row['user_role'];
       // }
   // }
   


?>


<!--

<!DOCTYPE html>
<html lang="en">
  <head>
    Required meta tags 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

     Bootstrap CSS
    <link  href="https:/fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
     integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <script src="assets/src/js/script.js"></script>

    <title>Liquid Portal - <?php // echo $title ?> </title>
  </head>
  <body>



      
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #5F8D4E;">
                        <a class="navbar-brand" href="#">E-Space</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                        <a class="nav-link" href="http://localhost/Open_door/home.php">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="http://localhost/Open_door/check_result.php">Check Results</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="http://localhost/Open_door/upload_subject.php">Add Questions</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="http://localhost/Open_door/delete_subject">Delete Questions</a>
                                </li>
                         </ul>
                             
                                <span class="navbar-text">

                                        User Logged in: <?php // echo $userLoggedIn; ?>
                                </span>
                                <span class="navbar-text">
                                        <a href="logout.php" class="nav-link">Logout</a>
                                </span>
                        </div>
                 </nav>