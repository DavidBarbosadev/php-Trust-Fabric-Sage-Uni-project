<?php
include $_SERVER['DOCUMENT_ROOT']."/app/model/administratormodel.php";
include $_SERVER['DOCUMENT_ROOT']."/app/controller/sendmailcontroller.php";
class AdministratorController{

    protected $administratorModel;

    function __construct(){
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        if ($number_of_arguments == 0){
            
        }
        else{
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
    }
    
    function __construct1($var){
        if (is_numeric($var)) {
            $this->administratorModel = new AdministratorModel("id-".$var);
        }
        else{
            if (strpos($var,"@")){
                $this->administratorModel = new AdministratorModel("email-".$var);
            }
            else{
                $this->administratorModel = new AdministratorModel("token-".$var);
            }
        }
    }

    function __construct2($email,$password){
        $this->administratorModel = new AdministratorModel($email,$password);
    }

    function __construct3($password,$token,$cvv){
        $this->administratorModel = new AdministratorModel($password,$token,$cvv);
    }
    function __construct4($email,$password,$firstname,$lastname){
        $this->administratorModel = new AdministratorModel($email,$password,$firstname,$lastname);
    }

    function login(){
        return $this->administratorModel->login();
    }

    function register(){
        $regRes = $this->administratorModel->register();
        if ($regRes){
            MailServiceController::send($this->administratorModel->email,"Hi {$this->administratorModel->firstname}<br/><br/>Please do click below link to active your account<br/><br/><a href=\"http://localhost/adminlogin.php?token=".hash('sha256',$this->administratorModel->email)."\">http://localhost/adminlogin.php?token=".hash('sha256',$this->administratorModel->email)."</a><br/><br/> Thank you <br/><br/>Sincerely,<br/>Prihatian.","An verification email","Email verification");
        }
        return $regRes;
    }

    function checkSession(){
        return $this->administratorModel->checkSession();
    }

    function doCheckVerification(){
        return $this->administratorModel->doCheckVerification();
    }
    function doResetPassword(){
        $admObj = json_decode($this->administratorModel->doResetPassword());
        if (!empty($admObj)){
            $body =  mb_convert_encoding("Hi {$admObj->firstname}<br/><br/>Please do click below link to reset your account password<br/><br/>http://localhost/forgot.php?action=newPassword%26cvv=".hash('sha256',$admObj->email)."%26token=".hash('sha256',$admObj->password)."<br/><br/> Thank you <br/><br/>Sincerely,<br/>Prihatian.",'HTML-ENTITIES');
            MailServiceController::send($admObj->email,$body,"Recently, you have request a password reset","Reset password");
            return true;
        }
        return false;
    }

    function doUpdatePassword(){
        return $this->administratorModel->doUpdatePassword();
    }

    function doVerifyAccount(){
        return $this->administratorModel->doVerifyAccount();
    }

    function viewProfile(){
        return json_decode($this->administratorModel->viewProfile());
    }

    function doChangePassword($oldPwd,$newPwd){
        return $this->administratorModel->doChangePassword($oldPwd,$newPwd);
    }

    function updateProfile($firstname,$lastname){
        return $this->administratorModel->updateProfile($firstname,$lastname);
    }
}
?>