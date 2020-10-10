<?php
include "app/master.php";
include "app/controller/administratorcontroller.php";
if (isset($_POST['action']) && $_POST['action'] == "Register"){
    if (empty($_POST['email'])){
        echo "<script>alert('Please fill in email in the textbox');window.history.go(-1);</script>";
        exit();
    }
    if (empty($_POST['password'])){
        echo "<script>alert('Please fill in password in the textbox');window.history.go(-1);</script>";
        exit();
    }
    if (empty($_POST['firstname'])){
        echo "<script>alert('Please fill in firstname in the textbox');window.history.go(-1);</script>";
        exit();
    }
    if (empty($_POST['lastname'])){
        echo "<script>alert('Please fill in lastname in the textbox');window.history.go(-1);</script>";
        exit();
    }
    $administratorCtrl = new AdministratorController($_POST['email'],$_POST['password'],$_POST['firstname'],$_POST['lastname']);
    echo ($administratorCtrl->register() ? "<script>alert('Register successfully');window.location.href='adminlogin.php';</script>" : "<script>alert('Register fail');</script>");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/LoginSignup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partilha -Sign up Page</title>
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
             <li><a href="adminlogin.php">Login</a></li>
         </ul>
         <div class="toggle" onclick="toggle()"></div>
     </header>
     <section id="contact">
        <div>
            <div class="box">             
                <form action="" method="post">
                    <div class="inputbox">
                        <label for="">First Name</label>
                        <input type="text" name="firstname" required="" placeholder="First Name"> 
                    </div>
                    <div class="inputbox">
                        <label for="">Last Name</label>
                        <input type="text" name="lastname" required="" placeholder="Last Name"> 
                    </div>
                    <div class="inputbox">
                        <label for="">Email Address</label>
                        <input type="email" name="email" required="" placeholder="Email"> 
                    </div>
                    <div class="inputbox">
                        <label for="">Password</label>
                        <input type="password" name="password" required="" placeholder="Password"> 
                    </div>
                    <input type="submit" name="action" value="Register">
                    <a href="">Forgot My Password</a>
                </form>
            </div>
        </div>    
    </section>
</body>
</html>