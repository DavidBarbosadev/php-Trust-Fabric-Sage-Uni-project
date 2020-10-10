<?php
class DocumentModel{
    private $hashKey = null,$organization = null,$vatNumber = null,$amountPaid = null,$note = null,$referenceNo = null,$dtdue = null,$dtpaid = null,$ownerId = null,$creator = null;
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
    function __construct1($hashKey){
        $this->hashKey = $hashKey;
    }
    function __construct3($hashKey,$dtpaid,$referenceNo){
        $this->hashKey = $hashKey;
        $this->dtpaid = $dtpaid;
        $this->referenceNo = $referenceNo;
    }
    function __construct7($hashKey,$organization,$vatNumber,$amountPaid,$dtdue,$note,$ownerId){
        $this->hashKey = $hashKey;
        $this->organization = $organization;
        $this->vatNumber = $vatNumber;
        $this->amountPaid = $amountPaid;
        $this->dtdue = $dtdue;
        $this->note = $note;
        $this->ownerId = $ownerId;
    }
    function __construct10($hashKey,$organization,$vatNumber,$amountPaid,$dtdue,$note,$dtpaid,$referenceNo,$ownerId,$creator){
        $this->hashKey = $hashKey;
        $this->organization = $organization;
        $this->vatNumber = $vatNumber;
        $this->amountPaid = $amountPaid;
        $this->dtdue = $dtdue;
        $this->note = $note;
        $this->referenceNo = $referenceNo;
        $this->dtpaid = $dtpaid;
        $this->ownerId = $ownerId;
        $this->creator = $creator;
    }
    function create(){
        $sCreate = Database::connect()->prepare("INSERT INTO documents (hashkey,belongedToOrganization,amountPaid,vatNumber,dtpaid,referenceNumber,note,dtCreated,createdBy,paidBy) VALUES (?,?,?,?,?,?,?,NOW(),?,?);");
        $sCreate->execute(array($this->hashKey,$this->organization,$this->amountPaid,$this->vatNumber,$this->dtpaid,$this->referenceNo,$this->note,$this->creator,$this->ownerId));
        return ($sCreate->rowCount() == 1 ? true : false);
    }
    function delete(){
        $sDelete = Database::connect()->prepare("DELETE FROM documents WHERE hashkey = ?;");
        $sDelete->execute(array($this->hashKey));
        return ($sDelete->rowCount() == 1 ? true : false);
    }
    function update(){
        $sUpdate = Database::connect()->prepare("UPDATE documents SET belongedToOrganization = ?, amountPaid = ?, vatNumber = ?,dtdue = ?,note = ?,paidBy = ?,dtlastmodified = NOW() WHERE hashkey = ?;");
        $sUpdate->execute(array($this->organization,$this->amountPaid,$this->vatNumber,$this->dtdue,$this->note,$this->ownerId,$this->hashKey));
        return ($sUpdate->rowCount() == 1 ? true : false);
    }
    function updatePayment(){
        $sUpdate = Database::connect()->prepare("UPDATE documents SET dtpaid = ?, referenceNumber = ? WHERE hashkey = ?;");
        $sUpdate->execute(array($this->dtpaid,$this->referenceNo,$this->hashKey));
        return ($sUpdate->rowCount() == 1 ? true : false);
    }
    function viewAll(){
        $json = array();
        $sView = Database::connect()->query("SELECT * FROM documents;");
        if ($sView->rowCount() > 0){
            $json = $sView->fetchAll();
        }
        return json_encode($json);
    }
    function view(){
        $json = array();
        $sView = Database::connect()->prepare("SELECT * FROM documents WHERE hashkey = ?;");
        $sView->execute(array($this->hashKey));
        if ($sView->rowCount() == 1){
            $rView = $sView->fetchAll();
            $json = $rView[0];
        }
        return json_encode($json);
    }
    function search(){
        $sSearch = Database::connect()->prepare("SELECT hashkey FROM documents WHERE hashkey = ?;");
        $sSearch->execute(array($this->hashKey));
        return ($sSearch->rowCount() == 1 ? true : false);
    }
}
?>