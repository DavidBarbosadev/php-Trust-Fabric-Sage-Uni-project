<?php
include $_SERVER['DOCUMENT_ROOT']."/app/model/documentmodel.php";
class DocumentController{
    private $documentModel;
    function __construct(){
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        if ($number_of_arguments == 0){
            $this->documentModel = new DocumentModel();
        }
        else{
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
    }
    function __construct1($hashkey){
        $this->documentModel = new DocumentModel($hashkey);
    }
    function __construct3($hashKey,$dtpaid,$referenceNo){
        $this->documentModel = new DocumentModel($hashKey,$dtpaid,$referenceNo);
    }
    function __construct7($hashkey,$organization,$vatNumber,$amountPaid,$dtdue,$note,$ownerId){
        $this->documentModel = new DocumentModel($hashkey,$organization,$vatNumber,$amountPaid,$dtdue,$note,$ownerId);
    }
    function __construct10($hashkey,$organization,$vatNumber,$amountPaid,$dtdue,$note,$dtpaid,$referenceNo,$ownerId,$creator){
        $this->documentModel = new DocumentModel($hashkey,$organization,$vatNumber,$amountPaid,$dtdue,$note,$dtpaid,$referenceNo,$ownerId,$creator);
    }
    function create(){
        return $this->documentModel->create();
    }
    function delete(){
        return $this->documentModel->delete();
    }
    function view(){
        return json_decode($this->documentModel->view());
    }
    function viewAll(){
        return $this->documentModel->viewAll();
    }
    function search(){
        return $this->documentModel->search();
    }
    function update(){
        return $this->documentModel->update();
    }
    function updatePayment(){
        return $this->documentModel->updatePayment();
    }
}
?>