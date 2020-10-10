<?php
abstract class AccountModel{
    private $userId,$email,$password,$firstname,$lastname;
    function __construct(){
    }
    abstract public function login();
    abstract public function register();
    abstract public function viewProfile();
    abstract public function updateProfile($firstname,$lastname);
    abstract public function checkSession();
    abstract public function doChangePassword($oldPwd,$newPwd);
    abstract public function doUpdatePassword();
    abstract public function doResetPassword();
    abstract public function doVerifyAccount();
}
?>