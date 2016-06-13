<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 10/06/2016
 * Time: 21:35
 */

class USER {
    private $db;

    function __construct($db_con){
        $this->db = $db_con;
    }

    public function signup($fname,$mid,$nic,$email,$mobile,$doj,$clubpost,$username,$confirmpwd){
        try {
            $prof_image = "#";
            $status = 0;
            $new_pass = password_hash($confirmpwd, PASSWORD_DEFAULT);

            $stmtu = $this->db->prepare("INSERT INTO clubmember(memberID,name,NIC,email,mobileNumber,clubpost,dateOfJoin,profileImage,status,username,password) VALUES('$mid','$fname','$nic','$email','$mobile','$clubpost','$doj','$prof_image','$status','$username','$new_pass')");
            $stmtu->execute();
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    public function login($uemail,$upass){
        try{
            $stmt = $this->db->prepare("SELECT * FROM employee WHERE E_email= '$uemail'");
            $stmt->execute();
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() > 0){
                if(password_verify($upass,$userRow['E_password']) && $userRow['Admin_auth'] == 1){
                    $_SESSION['user_session'] = $userRow['E_nic'];
                    return true;
                }
            }
            else{
                return false;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function is_loggedin(){
        if(isset($_SESSION['user_session'])){
            return true;
        }
    }

    public function redirect($url){
        header("Location: $url");
    }

    public function logout(){
        unset($_SESSION['user_session']);
        $_SESSION['user_Session'] = false;
        session_destroy();
        return true;
    }

    public function user_details($user_id){
        $stmt = $this->db->prepare("SELECT * FROM employee WHERE E_nic = '$user_id'");
        $stmt->execute();
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $userRow;
    }
    public function unread_messages($user_id){
        $stmt = $this->db->prepare("SELECT * FROM message WHERE to_user = '$user_id' AND read_status = '0' AND deleted ='0'");
        $stmt->execute();
        $msgcount = $stmt->rowCount();
        return $msgcount;
    }

}
