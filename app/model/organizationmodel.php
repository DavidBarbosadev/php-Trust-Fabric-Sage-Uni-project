<?php
abstract class OrganizationModel{
    function __construct(){

    }
    static public function getAll(){
        $sOrg = Database::connect()->query("SELECT * FROM organization;");
        $rOrg = $sOrg->fetchAll();
        return json_encode($rOrg);
    }
    static public function view($id){
        $sOrg = Database::connect()->prepare("SELECT organization FROM organization WHERE id = ?;");
        $sOrg->execute(array($id));
        $rOrg = $sOrg->fetch();
        return $rOrg['organization'];
    }
}
?>