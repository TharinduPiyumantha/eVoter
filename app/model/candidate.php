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

    public function __construct($electionID,$memberID,$candidateNo,$symbolImage){
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
    public function insertCandidateIntoDB($connection){
        (new Sql)->createNewCandidate($connection,$this->getElectionID(), $this->getMemberID(), $this->getCandidateNo(), $this->getSymbolImage());

    }
}