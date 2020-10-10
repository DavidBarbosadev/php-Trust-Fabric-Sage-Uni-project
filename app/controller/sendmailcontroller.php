<?php
class MailServiceController{
    static public function send($receiverEmail,$body,$altBody,$subject){
        $curlHandler = curl_init();
    
        curl_setopt_array($curlHandler, [
            CURLOPT_URL => 'https://api.patdevs.com',
            CURLOPT_RETURNTRANSFER => true,
        
            /**
             * Specify POST method
             */
            CURLOPT_POST => true,
        
            /**
             * Specify request content
             */
            CURLOPT_POSTFIELDS => "receiverEmail={$receiverEmail}&senderEmail=noreply@partiha.com&body={$body}&altBody={$altBody}&subject={$subject}&isHTML=1&senderName=Prihatian Accounting Film",
        ]);
        
        $response = curl_exec($curlHandler);
        
        curl_close($curlHandler);
        
    }
}
?>