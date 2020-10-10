<?php
include "app/master.php";
include "app/controller/administratorcontroller.php";
if (isset($_POST['action'])){
    switch($_POST['action']){
        case "updatePassword":
            $administratorCtrl = new AdministratorController($_POST['pass'],$_POST['token'],$_POST['cvv']);
            if ($administratorCtrl->doUpdatePassword()){
                echo "<script>alert('Password updated!');window.location.href='adminlogin.php';</script>";
                exit();
            }
            else{
                echo "<script>alert('This link has been broken!Please request new one!');window.location.href='forgot.php';</script>";
                exit();
            }
        break;
        case "resetPassword":
            $administratorCtrl = new AdministratorController($_POST['email']);
            if ($administratorCtrl->doResetPassword()){
                echo "<script>alert('The reset password email has been sent to your registered email');window.location.href='forgot.php';</script>";
                exit();
            }
            else{
                echo "<script>alert('This email is not in the system.');window.history.go(-1);</script>";
                exit();
            }
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
            crossorigin="anonymous">
        <link rel="stylesheet" href="css/userupdate.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Partilha -Search Page</title>
        <script type="text/javascript">
            function toggle() {
                var header = document.getElementById("header")
                header
                    .classList
                    .toggle('active')
            }
        </script>
    </head>
    <body>
        <header id="header">
            <a href="loginlanding.php" class="logo"><img src="img/logo/Partilha Logo.png" alt="logo"></a>
                <ul>
                    <li>
                        <a href="adminregister.php">Register</a>
                    </li>
                    <li>
                        <a href="adminlogin.php" onclick="toggle()">Login</a>
                    </li>
                    <li>
                        <a href="#"><img src="img/png/profile.png" alt=""></a>
                    </li>
                </ul>
            <div class="toggle" onclick="toggle()"></div>
        </header>

        <section>
        <div class="container">
                <div style="margin-top:20px;" class="row justify-content-center">
                    <h1>Forgot Password</h1>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-<?php echo ((isset($_GET['action']) && $_GET['action'] == "newPassword" && isset($_GET['token'])) ? "7" : "5" );?>">
                        <form method="POST" style="text-algin:left;">
                            <input type="hidden" name="action" value="<?php echo ((isset($_GET['action']) && $_GET['action'] == "newPassword" && isset($_GET['token'])) ? "updatePassword" : "resetPassword" );?>">
                            <?php 
                            if (isset($_GET['action']) && $_GET['action'] == "newPassword" && isset($_GET['token']) && isset($_GET['cvv'])){
                            ?>
                            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                            <input type="hidden" name="cvv" value="<?php echo $_GET['cvv']; ?>">
                            <div class="form-group row">
                                <label for="inputEmail3" class="text col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input
                                        autocomplete="off"
                                        type="password"
                                        class="form-control"
                                        id="inputEmail3"
                                        name="pass">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="text col-sm-4 col-form-label">Confirm Password</label>
                                <div class="col-sm-8">
                                    <input
                                        autocomplete="off"
                                        type="password"
                                        class="form-control"
                                        id="inputEmail3"
                                        name="cfmpass">
                                </div>
                            </div>
                            <?php
                            }
                            else{
                            ?>
                            <div class="form-group row">
                                <label for="inputEmail3" class="text col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input
                                        autocomplete="off"
                                        type="text"
                                        class="form-control"
                                        id="inputEmail3"
                                        name="email">
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                                   <center> <button type="submit" class="btn btn-light">Submit</button></center>
                            </form>
                            </div>
                            </div>
                            </div>

        </body>
    </html>