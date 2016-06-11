<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 6/7/2016
 * Time: 7:24 AM
 */
class SMS{
    private $user,$password;
    public function __construct(){
        $this->user = "94711877531";
        $this->password = "8078";
    }
    public function sendSMS($message,$mobileNo){
        $text = urlencode($message);
        $to = $mobileNo;

        $baseurl ="http://www.textit.biz/sendmsg";
        $url = "$baseurl/?id=$this->user&pw=$this->password&to=$to&text=$text&reply=Y";
        $ret = file($url);

        $res= explode(":",$ret[0]);

        if (trim($res[0])=="OK")
        {
            //echo "Message Sent - ID : ".$res[1];
        }
        else
        {
            //echo "Sent Failed - Error : ".$res[1];
        }

    }

}