<?php
session_start();
require 'db/conn.php';

if(isset($_GET['message'])) {
    $message = $_GET['message'];
}

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



//Actual handler

if(isset($_POST['userRole'])) {
    $userRole = $_POST['userRole'];
}

if($userRole > 1) {
    header("Location: http://localhost/Open_door/home.php");    
    exit();
}


if(isset($_POST['submitQuestion'])) {
    
    $questionNumber = $_POST['questionNumber'];
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);
    $answer = str_replace(' ', '',$answer);
    $answer = strip_tags($answer);
    $answer = strtolower($answer);
    $answer = md5($answer);
    $question = mysqli_real_escape_string($conn, $_POST['question']);    
    $question = strip_tags($question);  
    $imagePath = '';  

    if(!empty($_FILES['fileToUpload']['name'])) {
        $imagePath = '/Open_door/assets/src/images/'.$_FILES['fileToUpload']['name'];

    
        $fullPath = $_SERVER["DOCUMENT_ROOT"].$imagePath;
        
        
        if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],  $fullPath)) {
            
            echo "success";
        }
        else{
            echo "failed";
            
        }
    }
    
    
    $query = 
        " INSERT INTO `questions`" .
        " VALUES('', '$questionNumber', '$question', '$answer', '$imagePath', '$subject')";
    
    $result = mysqli_query($conn, $query);

    if($result) {
        header("Location: http://localhost/Open_door/upload_subject.php");    
        exit();               
    }
    else
    {
        die('Insert error');   
    } 
     
}
else
{
    header("Location: http://localhost/Open_door/quiz.php");    
    exit(); 
}

?>



<?php
//session_start();

                   // include_once 'db/conn.php';

           // if(isset($_POST['userRole']))  {
             //   $userRole = $_POST['userRole'];
           // }

            //If user role is greater than 1 cannot access URL (if statement acts as a authentication point)
           // if($userRole > 1)  {
             //   header("Location: http://localhost/Open_door/home.php");
             //   exit();
           // }

            
          //  if(isset($_POST['submitQuestion']))  {

           //     $questionNumber = $_POST['questionNumber'];
           //     $subject = mysqli_real_escape_string($conn, $_POST['subject']); //Prevent sql injection & ex: apostrophe char
           //     $answer = mysqli_real_escape_string($conn, $_POST['answer']);
            //    $answer = str_replace(' ', '',$answer);
           //     $answer = strip_tags($answer);
           //     $answer = strtolower($answer);
            //    $answer = md5($answer);
            //    $question = mysqli_real_escape_string($conn, $_POST['question']);
            //    $question = strip_tags($question);
             //   $imagePath = '';

              //  if(!empty($_FILES['fileToUpload']['name']))  {
                //    $imagePath = '/Open_door/assets/src/images/'.$_FILES['fileToUpload']['name'];

                //    $fullPath = $_SERVER['DOCUMENT_ROOT'].$imagePath;

               //     if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $fullPath))  {

                //        echo "success";
                 //   }
                //    else {
                //        echo "failed";
                //    }
            //    }

            //    $query = "INSERT INTO training_quiz.questions VALUES('', '$questionNumber', '$question', '$answer', '$imagePath', '$subject')";

             //   $result = mysqli_query($conn, $query);

             //   if($result)  {
             //       header("Location: http://localhost/Open_door/upload_subject.php");
             //       exit();
              //  }
              //  else
              //  {
               //     die('Insert error');
            //    }
         //   }
       //    else
          //  {
          //      header("Location:http://localhost/Open_door/quiz.php");
           //     exit();
         //   }



      //   if(isset($_POST['userRole'])) {
       //     $userRole = $_POST['userRole'];
     //   }
     //   
     //   if($userRole > 1) {
     //       header("Location: http://localhost/Open_door/home.php");    
      //      exit();
    //    }
        

        //"USER ROLE > 3 (ADD QUESTION. UPDATE BACKGROUND COLOR. AND DELETE CHECK RESULTS) low level mnmt
        
      //  if(isset($_POST['submitQuestion'])) {
            
     //       $questionNumber = $_POST['questionNumber'];
     //       $subject = mysqli_real_escape_string($conn, $_POST['subject']);
     //       $answer = mysqli_real_escape_string($conn, $_POST['answer']);
     //       $answer = str_replace(' ', '',$answer);
      //      $answer = strip_tags($answer);
      //      $answer = strtolower($answer);
      //      $answer = md5($answer);
      //      $question = mysqli_real_escape_string($conn, $_POST['question']);    
      //      $question = strip_tags($question);  
      //      $imagePath = '';  
        
       //     if(!empty($_FILES['fileToUpload']['name'])) {
       //         $imagePath = '/Open_door/assets/src/images/'.$_FILES['fileToUpload']['name'];
        
            
        //        $fullPath = $_SERVER["DOCUMENT_ROOT"].$imagePath;
                
                
         //       if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],  $fullPath)) {
                    
         //           echo "success";
          //      }
          //      else{
           //         echo "failed";
                    
          //      }
      //      }


      //"USER ROLE > 4 (ADD QUESTION. UPDATE BACKGROUND COLOR DELETE. CHECK RESULTS. MAKE NOTES. )  mid level mnmt
        
      //  if(isset($_POST['submitQuestion'])) {
            
     //       $questionNumber = $_POST['questionNumber'];
     //       $subject = mysqli_real_escape_string($conn, $_POST['subject']);
     //       $answer = mysqli_real_escape_string($conn, $_POST['answer']);
     //       $answer = str_replace(' ', '',$answer);
      //      $answer = strip_tags($answer);
      //      $answer = strtolower($answer);
      //      $answer = md5($answer);
      //      $question = mysqli_real_escape_string($conn, $_POST['question']);    
      //      $question = strip_tags($question);  
      //      $imagePath = '';  
        
       //     if(!empty($_FILES['fileToUpload']['name'])) {
       //         $imagePath = '/Open_door/assets/src/images/'.$_FILES['fileToUpload']['name'];
        
            
        //        $fullPath = $_SERVER["DOCUMENT_ROOT"].$imagePath;
                
                
         //       if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],  $fullPath)) {
                    
         //           echo "success";
          //      }
          //      else{
           //         echo "failed";
                    
          //      }
      //      }



      //"USER ROLE > 5 (ADD QUESTION. UPDATE BACKGROUND COLOR. RESET CHECK RESULTS. MAKE NOTES. PURCHASE STORE.  ) top level mnmt
        
      //  if(isset($_POST['submitQuestion'])) {
            
     //       $questionNumber = $_POST['questionNumber'];
     //       $subject = mysqli_real_escape_string($conn, $_POST['subject']);
     //       $answer = mysqli_real_escape_string($conn, $_POST['answer']);
     //       $answer = str_replace(' ', '',$answer);
      //      $answer = strip_tags($answer);
      //      $answer = strtolower($answer);
      //      $answer = md5($answer);
      //      $question = mysqli_real_escape_string($conn, $_POST['question']);    
      //      $question = strip_tags($question);  
      //      $imagePath = '';  
        
       //     if(!empty($_FILES['fileToUpload']['name'])) {
       //         $imagePath = '/Open_door/assets/src/images/'.$_FILES['fileToUpload']['name'];
        
            
        //        $fullPath = $_SERVER["DOCUMENT_ROOT"].$imagePath;
                
                
         //       if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],  $fullPath)) {
                    
         //           echo "success";
          //      }
          //      else{
           //         echo "failed";
                    
          //      }
      //      }





?>