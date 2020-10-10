<?php
session_start();
include "app/master.php";
include "app/controller/administratorcontroller.php";
if (isset($_POST['action']) && $_POST['action'] == "Login"){
    $administratorCtrl = new AdministratorController($_POST['email'],$_POST['password']);
    if (!$administratorCtrl->login()){
        echo "<script>alert('Wrong credentials is given');window.history.go(-1);</script>";
        exit();
    }
    $admInfo = $administratorCtrl->viewProfile();
    if (!$administratorCtrl->doCheckVerification()){
        MailServiceController::send($admInfo->email,"Hi {$admInfo->firstname}<br/><br/>Please do click below link to active your account<br/><br/><a href=\"http://localhost/adminlogin.php?token=".hash('sha256',$admInfo->email)."\">http://localhost/adminlogin.php?token=".hash('sha256',$admInfo->email)."</a><br/><br/> Thank you <br/><br/>Sincerely,<br/>Prihatian.","An verification email","Email verification");
        echo "<script>alert('Please do verify our account first and an verification email has sent to your registered email');window.location.href='adminlogin.php';</script>";
        exit();
    }
    $_SESSION['id'] = $admInfo->id;
    echo "<script>alert('Login success');window.location.href='loginlanding.php';</script>";
    exit();
}
else if (isset($_GET['token'])){
    $administratorCtrl = new AdministratorController($_GET['token']);
    echo ($administratorCtrl->doVerifyAccount() ? "<script>alert('Account verified successfully');window.location.href='adminlogin.php';</script>" : "<script>alert('Account has been verified, please directly proceed to login.');window.location.href='login.php';</script>");
    exit();
}
if (isset($_SESSION['id'])){
    $administratorCtrl = new AdministratorController($_SESSION['id']);
    if ($administratorCtrl->checkSession() == 1){
        header("Location: loginlanding.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/LoginSignup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partilha -Login Page</title>

</head>
<body>
    <script type="text/javascript">
        function toggle(){
            var header = document.getElementById("header")
            header.classList.toggle('active')
        }
        
    </script>
    <header id="header">
    
        <a href="index.php" class="logo"><img src="img/logo/Partilha Logo.png" alt="logo"></a>
         <ul>
             <li><a href="index.php" onclick="toggle()">←</a></li>
             <li><a href="adminregister.php">New Account</a></li>
         </ul>
         <div class="toggle" onclick="toggle()"></div>
     </header>
     <section id="contact">
        <div>
            <div class="box">             
                <form action="" method="post">
                    <div class="inputbox">
                        <label for="">Email Address</label>
                        <input type="email" name="email" required="" placeholder="Email"> 
                    </div>
                    <div class="inputbox">
                        <label for="">Password</label>
                        <input type="password" name="password" required="" placeholder="Password"> 
                        
                    </div>
                    <input type="submit" name="action" value="Login">
                    <a href="forgot.php">Forgot My Password</a>
                </form>
            </div>
        </div> 
    </section>
</body>
</html>