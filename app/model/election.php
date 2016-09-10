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

    public function __construct() {
        $argv = func_get_args();
        switch( func_num_args() ) {
            case 0:
                self::__construct1();
                break;
            case 5:
                self::__construct2( $argv[0], $argv[1], $argv[2], $argv[3],$argv[4]);
        }
    }
    public function __construct1(){

    }

    public function __construct2($electionName,$date,$startTime,$endTime,$noOfVotesPerPerson){
        $this->electionName = $electionName;
        $this->date = $date;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->noOfVotesPerPerson = $noOfVotesPerPerson;

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

    public function insertIntoElection($connection){

        (new Sql)->createNewElection($connection,$this->getElectionName(), $this->getDate(), $this->getStartTime(), $this->getEndTime(), $this->getNoOfVotesPerPerson());
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
    public function getCandidateDetails($connection,$electionID){
        return (new Sql)->getMemberDetailsOfElection($connection,$electionID);
    }
    public function getVoterDetails($connection,$electionID){
        return (new Sql)->getVoterDetailForElection($connection,$electionID);
    }
    public function updateElectionDetails($connection,$elecName,$date,$sTime,$eTime,$votes,$electionID){
        return (new Sql)->updateElectionDetails($connection,$elecName,$date,$sTime,$eTime,$votes,$electionID);

    }
    public function deleteElection($connection,$electionID){
        return (new Sql)->deleteElectionAll($connection,$electionID);
    }
    public function finishedElectList($connection){
        return (new Sql)->getFinishedElectList($connection);
    }
    public function getMaxFinishedElectDate($connection){
        return (new Sql)->getLatestElectDate($connection);
    }
    public function getNoOfQualifiedCandidates($connection,$electID){
        return (new Sql)->noOfQualifiedCandidates($connection,$electID);
    }
    public function getNoOfCastedVoters($connection,$electID){
        return (new Sql)->noOfCastedVoters($connection,$electID);
    }
    public function getNoOfQualifiedVoters($connection,$electID){
        return (new Sql)->noOfQualifiedVoters($connection,$electID);
    }
    public function getWonPersonality($connection,$electID){
        return (new Sql)->wonPersonality($connection,$electID);
    }
    public function getWonPersonalityDetails($connection,$electID,$candidateID){
        return (new Sql)->getWonPersonalityDetails($connection,$electID,$candidateID);
    }
    public function getElectionResults($connection,$electID){
        $sql = new Sql();
        $resultsArray_small = array();
        $resultsArray_big = array();
        $votesArray = $sql->getResultsOfElection($connection,$electID);
        while($votes = $votesArray->fetch_row()){
            $candDetailsArr =  $sql->getCandidateDetailsForResults($connection,$electID,$votes[0]);
            $candDetails = $candDetailsArr->fetch_row();
            $candName = $candDetails[0];
            $symbol = $candDetails[1];
            array_push($resultsArray_small, $candName, $votes[0],$symbol,$votes[1]);
            array_push($resultsArray_big,$resultsArray_small);
            $resultsArray_small = array();
        }

        return  $resultsArray_big;
    }
    public function getCandNameAndVotes($connection,$electID){
        return (new Sql)->getNameAndVotes($connection,$electID);
    }
    public function getCandidateNumbers($connection,$electID){
        return (new Sql)->getCandidateNoForElection($connection,$electID);
    }
    public function getVotesCountPerCandidate($connection,$electID,$candNo){
        return (new Sql)->getBallotCountPerCandidate($connection,$electID,$candNo);
    }
    public function getCandidatesDetailsForResults($connection,$electID,$candNo){
        return (new Sql)->getCandDetailsForResults($connection,$electID,$candNo);
    }
    public function getNoOfCandidates($connection,$electID){
        return (new Sql)->countNoOfCandidatesInElection($connection,$electID);
    }
    public function electionDetails($connection,$userID){
        return (new Sql)->getElectionDetailsCandidates($connection,$userID);
    }
    public function haveElectDetails($connection,$userID){
        return (new Sql)->loadHaveElections($connection,$userID);
    }


}
?>