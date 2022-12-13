<?php
session_start();
require 'db/conn.php';


$message = '';

if(isset($_POST['loginButton'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    //Clean form input again
    $firstname = strip_tags($firstname);
    $firstname = str_replace(' ', '',$firstname);
    $firstname = strtolower($firstname);
        
    $lastname = strip_tags($lastname);
    $lastname = str_replace(' ', '',$lastname);
    $lastname = strtolower($lastname);

    $email = strip_tags($email);
    $email = str_replace(' ', '',$email);
    $email = strtolower($email);
    

    if($_POST['loginButton'] == 1) {
        
        if(strlen($firstname) < 2 || strlen($lastname) < 2) {
           $message.= 'Your name cannot be 1 letter'; 
           header("Location: http://localhost/Open_door/login.php?message='$message'");    
           exit();                       
        }
        if($password !== $confirmPassword) {
            $message.= 'Your Passwords do not match'; 
            header("Location: http://localhost/Open_door/login.php?message='$message'");    
            exit();           
        }
        if(strlen($password) > 26 || strlen($password) < 5) {
            $message.= 'Your Passwords must be between 5 and 30 characters long';
            header("Location: http://localhost/Open_door/login.php?message='$message'");    
            exit();            
        }
        
        $query = 
            " SELECT `email` " .
            " FROM `users` " .
            " WHERE `email` = '$email'";

        $result = mysqli_query($conn, $query);

        if(!$result) {
            echo(mysqli_error($conn));
        }
       
        
        if(mysqli_num_rows($result) > 0) {
            $message.= 'This email is already in use.'; 
            header("Location: http://localhost/Open_door/login.php?message='$message'");    
            exit();           
        }
        else
        {
            if(preg_match('/[^A-Za-z0-9&$+#]/', $password)) {
                $message.= "Your password can only contain English characters, numbers, #, $, &, +";  
                header("Location: http://localhost/Open_door/login.php?message='$message'");    
                exit();              
            }
            $password = md5($password);
            
            $username = strtolower($firstname."_".$lastname);

            $query = 
                " SELECT `username`" .
                " FROM `users`" .
                " WHERE `username` = '$username'";

            $usernameCheck = mysqli_query($conn, $query);

            $i = 0;
            //if username exists, add number to username
            while(mysqli_num_rows($usernameCheck) != 0) {
                $i++;
                $username = $username."_".$i;
                $query = 
                    " SELECT `username`" .
                    " FROM `users`" .
                    " WHERE `username` = '$username'";

                $usernameCheck = mysqli_query($conn, $query);  
            }

            //profile picture assignment
            $rand = rand(1,3); //Random number between 1 and 3
            if($rand == 1) {
                $profilepicture = "assets/src/images/icon.jpg";
            } else if ($rand == 2) {
                $profilepicture = "assets/src/images/screenshot-graphic.jpg";
            } else if ($rand == 3) {
                $profilepicture = "assets/src/images/icon.jpg";
            } 

            $date = date('Y-m-d H:i:s');

            $query = 
                " INSERT INTO `users`" .
                " VALUES('', '$firstname', '$lastname', '$email', '$password', '$username', '$profilepicture', '', '$date', '2')";

            if($insertUser = mysqli_query($conn, $query)) {
                $_SESSION['email'] = $email;
            
                header("Location: http://localhost/Open_door/home.php");    
                exit();            
            }
            else
            {
                $message.= 'Your sign up was not successful. Please try again later';
                header("Location: http://localhost/Open_door/login.php?message='$message'");    
                exit();
            }

        }
       
    }
    else
    {
        $query = 
            " SELECT `email`, `firstname`, `username`, `password`" .
            " FROM `users`" .
            " WHERE `email` = '$email'";

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) < 1) {
            $message.= 'This email is not registered.';  
            header("Location: http://localhost/Open_door/login.php?message='$message'");    
            exit();          
        }
        else
        {            
            $row = mysqli_fetch_array($result);
            $firstname = $row['firstname'];
            $email = $row['email'];
            $username = $row['username'];
            $hashedPassword = $row['password'];

            if(md5($password) === $hashedPassword) {
                $_SESSION['email'] = $email;
            
                header("Location: http://localhost/Open_door/home.php");    
                exit();
            }
            else
            {
                $message.= 'The email/password combination is incorrect.'; 
                header("Location: http://localhost/Open_door/login.php?message='$message'");    
                exit();  
            }
                          
        }
    }     
    
}
else
{
    header("Location: http://localhost/Open_door/login.php");    
    exit(); 
}

?>





<?php

       // include_once 'db/conn.php';




     //  if(isset($_POST['loginButton']))  {

      //      $firstname = $_POST['firstname'];
       //     $lastname = $_POST['lastname'];
       //     $email = $_POST['email'];
       //     $password = $_POST['password'];
       //     $confirmPassword = $_POST['confirmPassword'];
        //    $date_join = date('Y-m-d H:i:s');
           
            

            //Clean form input again (php functions)
        //    $firstname = strip_tags($firstname);
       //     $firstname = str_replace(' ', '',$firstname);
        //    $firstname = strtolower($firstname);

        //    $lastname = strip_tags($lastname);
        //    $lastname = str_replace(' ', '',$lastname);
        //    $lastname = strtolower($lastname);

         //   $email = strip_tags($email);
         //   $email = str_replace(' ', '',$email);
         //   $email = strtolower($email);

        //    if($_POST['loginButton'] == 1)  {
          //      if(strlen($firstname) < 2 || strlen($lastname) < 3)  {
                    //This error message must be initalized in declaration section of file
            //        $message.= 'Your name is not enough characters';
           //         header("Location: http://localhost/Open_door/login.php?message='$message'");  //login.php?message=  <-- GET request
              //      exit();
              //  }

                //If password is not equal to password append message to that
            //    if($confirmPassword !== $password)  {
             //       $message.= 'Your passwords must match';
             //       header("Location: http://localhost/Open_door/login.php?message='$message'");  //login.php?message=  <-- GET request
             //       exit();
             //   }

                //Next we want to check is Password is not atleast [#?] length
              //  if(strlen($password) > 20 || strlen($password) < 6)  {
               //     $message.= 'Your password must be no more than 20 characters and/or greater than 6 characters in length';
                //    header("Location: http://localhost/Open_door/login.php?message='$message'");  //login.php?message=  <-- GET request
                //    exit();
             //   }

            //    $query = "SELECT email FROM training_quiz.users WHERE email = '$email'";

            //    $result = mysqli_query($conn, $query);

             //   if(!$result)  {
              //      echo(mysqli_error($conn));
             //   }

            //    if(mysqli_num_rows($result) > 0)  {
             //       $message.= 'This email is already in use';
              //      header("Location: http://localhost/Open_door/login.php?message='$message'");
               //     exit();
             //   }
             //   else
             //   {
               //     if(preg_match('/[^A-Za-z0-9&$+#%]/', $password))  {
                //        $message.= 'Email must contain a special character,
                 //       a uppercase and/or a lowercase letter in order to be stored';
                 //   header("Location: http://localhost/Open_door/login.php?message='$message'");
                //    exit();
                //    }

                //    $password = md5($password);

                 //   $username = strtolower($firstname."_".$lastname);

                 //   $query = "SELECT username FROM training_quiz.users WHERE username = '$username'";

                 //   $usernameCheck = mysqli_query($conn, $query);

                //    $i = 0;
                    //If username exists, add number to username (if number 1 is already appended, then append 2)
                //    while(mysqli_num_rows($usernameCheck) != 0)  {
                //        $i++;
                  //      $username = $username."_".$i;
                   //     $query = "SELECT username FROM training_quiz.users WHERE username = '$username'";

                   //         $usernameCheck = mysqli_query($conn, $query);
                  //  }

                 //   $rand = rand(1, 3);

                 //   if($rand == 1 )  {
                //        $profilepicture = "/assets/src/images/icon.jpg";
                //    } else if ($rand == 2)  {
                //        $profilepicture = "/assets/src/images/screenshot-graphic.jpg";
                //    } else if ($rand == 3)  {
                 //       $profilepicture = "/assets/src/images/icon.jpg";
                 //   }
                 //   $date = date('Y-m-d H:i:s');

                 //   $query = "INSERT INTO training_quiz.users 
                  //       VALUES('', '$firstname', '$lastname', '$email', '$password', '$username', '$profilepicture', '', '$date_join', '1')";

                  //  if($insertUser = mysqli_query($conn, $query))  {
                   //     $_SESSION['email'] = $email;

                   //     header("Location: http://localhost/Open_door/home.php");
                   //     exit();
///
                 //   }
                 //   else
                  //  {
                   //     $message.= 'Your signup was not successful. Please try again later';
                    //    header("Location: http://localhost/Open_door/login.php?message='$message'");
                     //   exit();
                //    }
           //     }

          //  }
         //   else
         //   {
          //      $query =
           //         "SELECT 'email', 'firstname', 'username', 'password' FROM training_quiz.users WHERE email = '$email'";

           //     $result = mysqli_query($conn, $query);

            //    if(mysqli_num_rows($result) < 1)  {
              //      $message.= 'This email has yet to be registered';
              //      header("Location: http://localhost/Open_door/login.php?message='$message'");
               //     exit();
              //  }
              //  else
              //  {
               //     $row = mysqli_fetch_array($result);
                //    $firstname = $row['firstname'];
                //    $email = $row['email'];
                 //   $username = $row['username'];
                 //   $hashedPassword = $row['password'];

                 //   if(md5($password) === $hashedPassword)  {
                  //      $_SESSION['email'] = $email;

                   //     header("Location: http://localhost/Open_door/home.php");
                   //     exit();
                 //   }

            //    }
        //    }

      //  }
     //   else
      //  {
       //     header("Location: http://localhost/Open_door/login.php");
        //    exit();
      //  }

?>