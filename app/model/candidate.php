<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 6/5/2016
 * Time: 8:57 AM
 */
require_once("Sql.php");

class Candidate{
    private $candidateNo;
    private $symbolImage;
    private $memberID;
    private $electionID;

    public function __construct() {
        $argv = func_get_args();
        switch( func_num_args() ) {
            case 0:
                self::__construct1();
                break;
            case 4:
                self::__construct2( $argv[0], $argv[1], $argv[2], $argv[3]);
        }
    }


    public function __construct1(){
        $this->electionID = "";
        $this->memberID = "";
        $this->candidateNo = "";
        $this->symbolImage = "";
    }
    public function __construct2($electionID,$memberID,$candidateNo,$symbolImage){
        $this->electionID = $electionID;
        $this->memberID = $memberID;
        $this->candidateNo = $candidateNo;
        $this->symbolImage = $symbolImage;
    }

    public function setMemberID($memberID)
    {
        $this->memberID = $memberID;
    }

    public function setElectionID($electionID)
    {
        $this->electionID = $electionID;
    }

    public function setCandidateNo($candidateNo)
    {
        $this->candidateNo = $candidateNo;
    }

    public function setSymbolImage($symbolImage)
    {
        $this->symbolImage = $symbolImage;
    }

    public function getMemberID()
    {
        return $this->memberID;
    }

    public function getElectionID()
    {
        return $this->electionID;
    }

    public function getCandidateNo()
    {
        return $this->candidateNo;
    }

    public function getSymbolImage()
    {
        return $this->symbolImage;
    }
    public function insertCandidateIntoDB($connection,$electID,$membID){
        (new Sql)->createNewCandidate($connection,$electID, $membID);

    }
    public function deleteCandidate($connection,$electID,$memberID){
        (new Sql)->deleteCandidateRow($connection,$electID,$memberID);
    }
    public function getCandidatesDetails($connection,$electID){
        return (new Sql)->getCandDetails($connection,$electID);

    }
    public function updateCandidate($connect,$candNo,$symbolImage,$electionID,$membID){
        (new Sql)->updateCandDetails($connect,$candNo,$symbolImage,$electionID,$membID);
    }
    public function getCandWithoutSymbol($connect, $electionID)
    {
        return (new Sql)->getCandWithoutSymbol($connect, $electionID);
    }
    public function getCandidateInfo($connect, $electionID){
        return (new Sql)->getCandidatesDetails($connect, $electionID);
    }
    public function getCandidateNoOfNotNull($connect, $electionID){
        return (new Sql)->getCandidateNumbersOfNotNull($connect, $electionID);
    }
    public function getCandidateForStatus($connect, $electionID){
        return (new Sql)->selectMembers($connect,$electionID);
    }
    public function getNoOfElectionsPerCandidate($connect, $userID){
        return (new Sql)->getNoOfElectionsPerCandidate($connect, $userID);
    }
}