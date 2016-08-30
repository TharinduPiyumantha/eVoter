<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 8/1/2016
 * Time: 11:58 AM
 */
require_once("Sql.php");

class BallotPaper{
    private $securityPin;
    private $vote;
    private $electionID;

    public function __construct() {
        $argv = func_get_args();
        switch( func_num_args() ) {
            case 0:
                self::__construct1();
                break;
            case 3:
                self::__construct2( $argv[0], $argv[1], $argv[2]);
        }
    }


    public function __construct1(){
        $this->securityPin = "";
        $this->vote = "";
        $this->electionID = "";
    }
    public function __construct2($securityPin,$vote,$electionID){
        $this->securityPin = $securityPin;
        $this->vote = $vote;
        $this->electionID = $electionID;
    }
    public function insertIntoBallotPaper($connect,$ballot,$electionID,$userID){
        (new Sql)->insertIntoBallotPaper($connect,$ballot,$electionID);
        (new Sql)->changeVotingStatus($connect,$userID,$electionID);
    }
    public function checkanswer($connect,$memeberID){
        return (new Sql)->checkanswered($connect,$memeberID);
    }
    public function getUserSecurityQuestions($connect,$userID){
        return (new Sql)-> getSecurityQuestions($connect, $userID);
    }
    public  function getUserSecurityPin($connect,$userID){
        return (new Sql)->getSecurityPin($connect,$userID);
    }
    public function updateSecurityPin($connect,$userID,$pin){
        (new Sql)->updateSecurityPin($connect, $userID, $pin);
    }
    public function updateAttempts($connect,$userID,$attempts){
        (new Sql)->updateAttempts($connect, $userID, $attempts);
    }
}