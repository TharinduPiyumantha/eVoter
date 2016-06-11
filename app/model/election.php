<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 6/4/2016
 * Time: 8:03 PM
 */
require_once("Sql.php");

class Election{
    private $electionName;
    private $date;
    private $startTime;
    private $endTime;
    private $noOfVotesPerPerson;
    private $noOfVoters;
    private $electionStatus;

    public function __construct() {
        $argv = func_get_args();
        switch( func_num_args() ) {
            case 0:
                self::__construct1();
                break;
            case 6:
                self::__construct2( $argv[0], $argv[1], $argv[2], $argv[3],$argv[4],$argv[5]);
        }
    }
    public function __construct1(){

    }

    public function __construct2($electionName,$date,$startTime,$endTime,$noOfVotesPerPerson,$electionStatus){
        $this->electionName = $electionName;
        $this->date = $date;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->noOfVotesPerPerson = $noOfVotesPerPerson;
        $this->electionStatus = $electionStatus;

    }

    public function setElectionName($electionName)
    {
        $this->electionName = $electionName;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    public function setNoOfVotesPerPerson($noOfVotesPerPerson)
    {
        $this->noOfVotesPerPerson = $noOfVotesPerPerson;
    }

    public function setNoOfVoters($noOfVoters)
    {
        $this->noOfVoters = $noOfVoters;
    }
    public function setElectionStatus($electionStatus)
    {
        $this->electionStatus = $electionStatus;
    }

    public function getElectionName()
    {
        return $this->electionName;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function getNoOfVotesPerPerson()
    {
        return $this->noOfVotesPerPerson;
    }
    public function getNoOfVoters()
    {
        return $this->noOfVoters;
    }

    public function getElectionStatus()
    {
        return $this->electionStatus;
    }
    public function insertIntoElection($connection){

        (new Sql)->createNewElection($connection,$this->getElectionName(), $this->getDate(), $this->getStartTime(), $this->getEndTime(), $this->getNoOfVotesPerPerson(), $this->getElectionStatus());
    }
    public function getMaxElectionID($connection){
        return (new Sql)->getElectionID($connection);
    }
    public function getElectionDetails($connection,$electionID){
        return (new Sql)->selectElectiondetails($connection,$electionID);
    }
    public function getElectionList($connection){
        return (new Sql)->loadAllElectionsWithDetails($connection);
    }

}
?>