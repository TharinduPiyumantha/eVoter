<?php

class Sql
{

    public function createNewElection($connect,$electName, $date, $startTime, $endTime, $noOfVotesPerPerson)
    {
        $queryToInsertElection = mysqli_query($connect, "INSERT INTO election(electionName,date,startTime,endTime,noOfVotesPerPerson) VALUES ('$electName','$date','$startTime','$endTime','$noOfVotesPerPerson')");

    }

    public function addCandidates($connect, $memberID, $electionID, $candidateNo, $symbolImage)
    {
        $queryToInsertCandidates = mysqli_query($connect, "INSERT INTO candidate(memberID,electionID,candidateNo,symbolImage) VALUES ('$memberID','$electionID','$candidateNo','$symbolImage')");

    }
    public function getElectionID($connect){
        $queryToGetElectionID = mysqli_query($connect,"SELECT MAX(electionID) FROM election");
        $row = mysqli_fetch_row($queryToGetElectionID);
        $electionID = $row[0];
        return $electionID;
    }
    public function createNewCandidate($connect,$electionID,$memberID)
    {
        $queryToInsertCandidate = mysqli_query($connect, "INSERT INTO candidate(electionID,memberID) VALUES ('$electionID','$memberID')");

    }
    public function createNewMember($connect,$name,$NIC,$dateOfBirth,$email,$homeAddress,$mobileNumber,$occupation,$clubPost,$profileImage,$status,$dateOfJoin,$username,$password)
    {
        $queryToInsertClubMember = mysqli_query($connect, "INSERT INTO clubmember(name,NIC,dateOfBirth,email,homeAddress,mobileNumber,occupation,clubPost,profileImage,status,dateofjoin,username,password) VALUES ('$name','$NIC','$dateOfBirth','$email','$homeAddress','$mobileNumber','$occupation','$clubPost','$profileImage','$status','$dateOfJoin','$username','$password')");

    }
    public function selectMembersForElection($connect){
        $queryToSelectMembersForElection= mysqli_query($connect, "SELECT memberID,name,clubPost,dateofjoin,email,mobileNumber FROM clubmember WHERE (status=\"registered\" OR status=\"candidate\") AND user_group!='2'");
        return $queryToSelectMembersForElection;
    }
    public function changeMemberStatus($connect,$status,$memberID){
        $queryToChangeMemberStatus = mysqli_query($connect, "update clubmember set status='$status' where memberID='$memberID'");

    }
    public function insertIntoMemberElectionDetails($connect,$memberID,$electID,$votingStatus){
        $queryToInsertIntoMemberElectionDetails = mysqli_query($connect, "INSERT INTO memberelectiondetails(memberID,electionID,votingStatus) VALUES ('$memberID','$electID','$votingStatus')");
    }
    public function selectMemberEmailAndMobile($connect,$memberID){
        $queryToselectMemberEmailAndMobile = mysqli_query($connect, "SELECT email,mobileNumber FROM clubmember WHERE memberID='$memberID'");
        return $queryToselectMemberEmailAndMobile ;
    }
    public function selectElectiondetails($connect,$electionID){
        $queryToselectElectiondetails = mysqli_query($connect, "SELECT electionName,date,startTime,endTime,noOfvotesPerPerson FROM election WHERE electionID='$electionID'");
        return $queryToselectElectiondetails;
    }
    public function loadAllElectionsWithDetails($connect){
        $queryToloadAllElectionsWithDetails = mysqli_query($connect, "SELECT electionID,electionName,date,startTime,endTime FROM election ORDER BY date DESC ");
        return $queryToloadAllElectionsWithDetails;
    }
    public function getMemberDetailsOfElection($connect,$electionID){
        $queryToGetMemDetails = mysqli_query($connect,"SELECT candidate.memberID,name,candidateNo,symbolImage from clubmember,candidate where clubmember.memberID=candidate.memberID AND candidate.electionID='$electionID'");
        return $queryToGetMemDetails;
    }
    public function getVoterDetailForElection($connect,$electionID){
        $queryToGetVoterDetails = mysqli_query($connect,"SELECT memberelectiondetails.memberID,name,clubPost,dateofjoin,email,mobileNumber from clubmember,memberelectiondetails where clubmember.memberID=memberelectiondetails.memberID AND memberelectiondetails.electionID='$electionID'");
        return $queryToGetVoterDetails;
    }
    public function updateElectionDetails($connect,$elecName,$date,$sTime,$eTime,$votes,$electID){
        $queryToUpdateElectionDetails = mysqli_query($connect, "update election set electionName='$elecName',date='$date',startTime='$sTime',endTime='$eTime',noOfVotesPerPerson='$votes' where electionID='$electID'");
    }
    public function deleteCandidateRow($connect,$electionID,$memberID){
        $queryToDeleteCandidates = mysqli_query($connect,"DELETE FROM candidate WHERE electionID='$electionID' AND memberID='$memberID'");
    }
    public function deleteVoterRow($connect,$electionID,$memberID){
        $queryToDeleteVoters = mysqli_query($connect,"DELETE FROM memberelectiondetails WHERE electionID='$electionID' AND memberID='$memberID'");
    }
    public function getRegisteredMembersNotInElection($connect,$electionID){
        $queryToGetRegisteredMembersNotInElection = mysqli_query($connect,"SELECT memberID,name,clubPost,dateofjoin,email,mobileNumber from clubmember where (status='registered' OR status='candidate') AND user_group!='2' AND memberID NOT IN (SELECT memberID FROM memberelectiondetails WHERE electionID='$electionID')");
        return $queryToGetRegisteredMembersNotInElection;
    }
    public function deleteElectionAll($connect,$electionID){
        $queryToDeleteCandidates = mysqli_query($connect,"DELETE FROM candidate WHERE electionID='$electionID'");
        $queryToDeleteVoters = mysqli_query($connect,"DELETE FROM memberelectiondetails WHERE electionID='$electionID'");
        $queryToDeleteElectionDetails = mysqli_query($connect,"DELETE FROM election WHERE electionID='$electionID'");
    }
    public function getCandDetails($connect,$electionID){
        $queryToGetCandDetails = mysqli_query($connect,"SELECT name,candidate.memberID FROM candidate,clubmember WHERE clubmember.memberID=candidate.memberID AND candidate.electionID='$electionID'");
        return $queryToGetCandDetails;
    }
    public function updateCandDetails($connect,$candNo,$symbolImage,$electionID,$membID){
        $queryToUpdateCandDetails = mysqli_query($connect,"update candidate set candidateNo='$candNo',symbolImage='$symbolImage' where electionID='$electionID' AND memberID='$membID' ");
    }
    public function getCandidatesNotInElection($connect,$electionID){
        $queryToGetCandidatesNotInElection = mysqli_query($connect,"SELECT memberID,name,clubPost,dateofjoin,email,mobileNumber from clubmember where (status='registered' OR status='candidate') AND user_group!='2' AND memberID NOT IN (SELECT memberID FROM candidate WHERE electionID='$electionID')");
        return $queryToGetCandidatesNotInElection;
    }
    public function getCandWithoutSymbol($connect,$electionID){
        $queryToGetCandDetails = mysqli_query($connect,"SELECT name,candidate.memberID FROM candidate,clubmember WHERE (clubmember.memberID=candidate.memberID AND candidate.electionID='$electionID') AND candidateNo='0'");
        return $queryToGetCandDetails;
    }
    public function getFinishedElectList($connect){
        $queryToGetFinishedElectList = mysqli_query($connect,"SELECT electionID,electionName,date,startTime,endTime FROM election WHERE electionStatus='finished'");
        return $queryToGetFinishedElectList;
    }
    public function getLatestElectDate($connect){
        $queryToGetLatestElecDate = mysqli_query($connect,"SELECT Max(date) FROM election WHERE electionStatus='finished'");
        return $queryToGetLatestElecDate;
    }
    public function noOfQualifiedCandidates($connect,$electID){
        $queryToNoOfQualifiedCandidates = mysqli_query($connect,"SELECT COUNT(*) FROM candidate WHERE electionID='$electID'");
        return $queryToNoOfQualifiedCandidates;
    }
    public function noOfCastedVoters($connect,$electID){
        $queryToNoOfCastedVoters = mysqli_query($connect,"SELECT COUNT(*) FROM ballotpaper WHERE electionID='$electID'");
        return $queryToNoOfCastedVoters;
    }
    public function noOfQualifiedVoters($connect,$electID){
        $queryToNoOfQualifiedVoters = mysqli_query($connect,"SELECT COUNT(*) FROM memberelectiondetails WHERE electionID='$electID'");
        return $queryToNoOfQualifiedVoters;
    }
    public function wonPersonality($connect,$electID){
        $queryToGetWonPersonality = mysqli_query($connect,"SELECT vote,COUNT(electionID) AS count FROM ballotpaper WHERE electionID = '$electID' GROUP BY vote ORDER BY count DESC LIMIT 1");
        return $queryToGetWonPersonality;

    }
    public function getWonPersonalityDetails($connect,$electID,$candidateID){
        $queryToGetWonPersonalityDetails= mysqli_query($connect,"SELECT candidate.memberID,clubmember.name FROM candidate,clubmember WHERE candidate.memberID=clubmember.memberID AND candidate.electionID='$electID' AND candidate.candidateNo='$candidateID'");
        return $queryToGetWonPersonalityDetails;
    }
    public function getResultsOfElection($connect,$electID){
        $queryToGetElectionresults= mysqli_query($connect,"SELECT ballotpaper.vote AS candNo, COUNT(vote) AS votes FROM ballotpaper WHERE ballotpaper.electionID='$electID' GROUP BY vote ORDER BY COUNT(vote) DESC");
        return $queryToGetElectionresults;
    }
    public function getCandidateDetailsForResults($connect,$electID,$candNo){
        $queryToGetCandDetailsForResults = mysqli_query($connect,"SELECT clubmember.name, candidate.symbolImage FROM clubmember,candidate WHERE candidate.electionID='$electID' AND candidate.candidateNo='$candNo' AND candidate.memberID=clubmember.memberID");
        return $queryToGetCandDetailsForResults;
    }
    public function getCandidatesDetails($connect,$electID){
        $queryToGetCandidateDetails= mysqli_query($connect,"SELECT name,candidateNo,symbolImage FROM candidate,clubmember WHERE clubmember.memberID=candidate.memberID AND electionID='$electID'");
        return $queryToGetCandidateDetails;
    }
    public function insertIntoBallotPaper($connect,$vote,$electID){
        $queryToInsertIntoBallotPaper= mysqli_query($connect,"INSERT INTO ballotpaper (vote,electionID) VALUES ('$vote','$electID')");
    }
    public function getNameAndVotes($connect,$electID){
        $queryToGetElectionresults= mysqli_query($connect,"SELECT name, COUNT(vote) AS votes FROM ballotpaper,candidate,clubmember WHERE ballotpaper.electionID='$electID' AND ballotpaper.vote=candidate.candidateNo AND candidate.memberID=clubmember.memberID GROUP BY vote ORDER BY COUNT(vote) DESC");
        return $queryToGetElectionresults;
    }
    public function getMemberName($connect,$memberID){
        $queryToGetMemberName = mysqli_query($connect,"SELECT name FROM clubmember WHERE memberID='$memberID'");
        return $queryToGetMemberName;
    }
    public function getCandidateNoForElection($connect,$electID){
        $queryToGetCandidateNumbers = mysqli_query($connect,"SELECT candidateNo FROM candidate WHERE electionID='$electID'");
        return $queryToGetCandidateNumbers;
    }
    public function getBallotCountPerCandidate($connect,$electID,$candNo){
        $queryToGetBallotCountPerCandidate= mysqli_query($connect,"SELECT COUNT(vote) FROM ballotpaper WHERE electionID='$electID' AND vote='$candNo'");
        return $queryToGetBallotCountPerCandidate;
    }
    public function getCandDetailsForResults($connect,$electID,$candNo){
        $queryToGetCandidateDetails= mysqli_query($connect,"SELECT clubmember.name, candidate.candidateNo, candidate.symbolImage FROM clubmember,candidate WHERE candidate.electionID='$electID' AND candidate.candidateNo='$candNo' AND candidate.memberID=clubmember.memberID;");
        return $queryToGetCandidateDetails;
    }
    public function getCandidateNumbersOfNotNull($connect,$electID){
        $queryToGetCandidateNumberOfNullCandNo = mysqli_query($connect,"SELECT candidateNo,symbolImage FROM candidate WHERE candidateNo!='0' AND symbolImage!='None' AND electionID='$electID'");
        return $queryToGetCandidateNumberOfNullCandNo;
    }
    public function checkanswered($connect, $userID)
    {
        $answer = mysqli_query($connect, "SELECT memberID FROM securityquestionanswer WHERE memberID='$userID'");
        return $answer;
    }

    public function getMemberElections($connect, $userID)
    {
        $answer = mysqli_query($connect, "SELECT election.electionName, election.startTime, election.endTime, election.date,election.electionID FROM election,memberelectiondetails WHERE election.electionID=memberelectiondetails.electionID AND memberelectiondetails.votingStatus='to be voting' AND memberelectiondetails.memberID='$userID'");
        return $answer;
    }

    public function changeVotingStatus($connect, $userID, $electID)
    {
        mysqli_query($connect, "update memberelectiondetails set votingStatus='Voted' where (electionID='$electID' AND memberID = '$userID')");
    }

    public function getSecurityQuestions($connect, $userID)
    {
        $answer = mysqli_query($connect, "SELECT securityquestions.question, securityquestions.q_id, securityquestionanswer.answer FROM securityquestions, securityquestionanswer WHERE securityquestions.q_id=securityquestionanswer.SecQueID AND securityquestionanswer.memberID='$userID'");
        return $answer;
    }
    public function getSecurityPin($connect,$userID){
        $answer = mysqli_query($connect, "SELECT pin, attempts FROM securitypin WHERE memberID='$userID'");
        return $answer;
    }
    public  function updateSecurityPin($connect, $userID, $pin){
        mysqli_query($connect, "Update securitypin set pin='$pin' WHERE memberID='$userID'");

    }
    public function updateAttempts($connect, $userID, $attempts){
        mysqli_query($connect, "Update securitypin set attempts='$attempts' WHERE memberID='$userID'");
    }

	public function countNoOfCandidatesInElection($connect,$electID){
        $count = mysqli_query($connect, "SELECT COUNT(candidateNo) FROM candidate WHERE electionID='$electID'");
        return $count;
    }
    public function changeStatusToCandidate($connect,$userID){
        mysqli_query($connect, "Update clubmember set status='candidate' WHERE memberID='$userID'");
    }
    public function selectMembers($connect,$electID){
        $answer = mysqli_query($connect, "SELECT memberID FROM candidate WHERE electionID='$electID'");
        return $answer;
    }
    public function getNoOfElectionsPerCandidate($connect,$userID){
        $noOfElections= mysqli_query($connect, "SELECT electionID FROM candidate WHERE memberID='$userID'");
        return $noOfElections;
    }
    public function getElectionDetailsCandidates($connect,$usrID){
        $electDetails = mysqli_query($connect, "SELECT election.date,election.startTime,election.endTime FROM election,candidate WHERE candidate.memberID='$usrID' AND candidate.electionID=election.electionID");
        return $electDetails;
    }
    public function loadHaveElections($connect,$usrID){
        $electHaveDetails = mysqli_query($connect, "SELECT election.electionID,election.electionName,election.date,election.startTime,election.endTime FROM election,memberelectiondetails,clubmember WHERE memberelectiondetails.votingStatus !='Voted' AND memberelectiondetails.electionID = election.electionID AND clubmember.memberID = '$usrID' AND memberelectiondetails.memberID=clubmember.memberID ORDER BY date DESC");
        return $electHaveDetails;
    }
}
?>
