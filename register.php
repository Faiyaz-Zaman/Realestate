<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $Name=$_POST['Name'];
    $email=$_POST['email'];
    $password=$_POST['password'];

     $checkEmail="SELECT * From user where uemail='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO user(uname,uemail,upassword)
                       VALUES ('$Name','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: index.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
   
   $sql="SELECT * FROM user WHERE uemail='$email' and upassword='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['uemail']=$row['uemail'];
    header("Location: homepage.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}
?>