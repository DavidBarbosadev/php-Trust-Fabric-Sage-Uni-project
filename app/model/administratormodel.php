<?php
include $_SERVER['DOCUMENT_ROOT']."/app/model/accountmodel.php";
class AdministratorModel extends AccountModel{
    private $token,$cvv;
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
        parent::__construct();
    }
    function __construct2($email,$password){
        $this->email = $email;
        $this->password = $password;
    }
    function __construct1($var){
        if (startsWith($var,"id-")){
            $this->userId = substr($var,3);
        }
        elseif (startsWith($var,"email-")){
            $this->email = substr($var,6);
        }
        else if (startsWith($var,"token-")){
            $this->token = substr($var,6);
        }
    }
    function __construct3($password,$token,$cvv){
        $this->password = $password;
        $this->token = $token;
        $this->cvv = $cvv;
    }
    function __construct4($email,$password,$firstname,$lastname){
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }
    function __construct5($userId,$email,$password,$firstname,$lastname){
        $this->userId = $userId;
        $this->email = $email;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }
    function login(){
        $sLogin = Database::connect()->prepare("SELECT firstname FROM users WHERE email = ? AND password = ?;");
        $sLogin->execute(array($this->email,$this->password));
        return ($sLogin->rowCount() == 1 ? true : false);
    }
    function register(){
        $sRegister = Database::connect()->prepare("INSERT INTO users (firstname,lastname,email,password,dtcreated,userRole) VALUES (?,?,?,?,NOW(),1);");
        $sRegister->execute(array($this->firstname,$this->lastname,$this->email,$this->password));
        return ($sRegister->rowCount() == 1 ? true : false);
    }
    function doCheckVerification(){
        $sVerify = Database::connect()->prepare("SELECT isVerified FROM users WHERE email = ?;");
        $sVerify->execute(array($this->email));
        if ($sVerify->rowCount() == 0){
            return false;
        }
        $rVerify = $sVerify->fetch();
        if ($rVerify['isVerified'] == 0){
            return false;
        }
        return true;
    }
    function checkSession(){
        $sCheckLogin = Database::connect()->prepare("SELECT userRole FROM users WHERE id = ?;");
        $sCheckLogin->execute(array($this->userId));
        if ($sCheckLogin->rowCount() == 1){
            $rCheckLogin = $sCheckLogin->fetch();
            return $rCheckLogin['userRole'];
        }
        else{
            return 0;
        }
    }
    function doResetPassword(){
        $json = array();
        $sVerify = Database::connect()->prepare("SELECT * FROM users WHERE email = ?;");
        $sVerify->execute(array($this->email));
        if ($sVerify->rowCount() == 1){
            $rVerify = $sVerify->fetchAll();
            $json = $rVerify[0];
        }
        return json_encode($json);
    }
    function doUpdatePassword(){
        $sChgPwd = Database::connect()->prepare("UPDATE users SET password = ? WHERE SHA2(password,256) = ? and SHA2(email,256) = ?;");
        $sChgPwd->execute(array($this->password,$this->token,$this->cvv));
        return ($sChgPwd->rowCount() == 1 ? true : false);
    }
    function doVerifyAccount(){
        $sVerify = Database::connect()->prepare("UPDATE users SET isVerified = 1 WHERE SHA2(email,256) = ? AND isVerified = 0;");
        $sVerify->execute(array($this->token));
        return ($sVerify->rowCount() == 1 ? true : false);
    }
    function doChangePassword($oldPwd,$newPwd){
        $sChgPwd = Database::connect()->prepare("UPDATE users SET password = ? WHERE password = ? AND id = ?;");
        $sChgPwd->execute(array($newPwd,$oldPwd,$this->userId));
        return ($sChgPwd->rowCount() == 1 ? true : false);
    }
    function viewProfile(){
        $json = array();
        if (!empty($this->userId)){
            $sViewProfile = Database::connect()->prepare("SELECT * FROM users WHERE id = ?;");
            $sViewProfile->execute(array($this->userId));
        }
        else{
            $sViewProfile = Database::connect()->prepare("SELECT * FROM users WHERE email = ?;");
            $sViewProfile->execute(array($this->email));
        }
        if ($sViewProfile->rowCount() == 1){
            $rViewProfile = $sViewProfile->fetchAll();
            $json = $rViewProfile[0];
        }
        return json_encode($json);
    }
    function updateProfile($firstname,$lastname){
        $sUpdateProfile = Database::connect()->prepare("UPDATE users SET firstname = ?,lastname = ? WHERE id = ?;");
        $sUpdateProfile->execute(array($firstname,$lastname,$this->userId));
        return ($sUpdateProfile->rowCount() == 1 ? true : false);
    }
}
?>