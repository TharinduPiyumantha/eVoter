<?php

class Sql
{

    public function createNewElection($connect,$electName, $date, $startTime, $endTime, $noOfVotesPerPerson, $electionStatus)
    {
        $queryToInsertElection = mysqli_query($connect, "INSERT INTO election(electionName,date,startTime,endTime,noOfVotesPerPerson,electionStatus) VALUES ('$electName','$date','$startTime','$endTime','$noOfVotesPerPerson','$electionStatus')");

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
    public function createNewCandidate($connect,$electionID,$memberID,$candidateNo,$symbolImage)
    {
        $queryToInsertCandidate = mysqli_query($connect, "INSERT INTO candidate(electionID,memberID,candidateNo,symbolImage) VALUES ('$electionID','$memberID','$candidateNo','$symbolImage')");

    }
    public function createNewMember($connect,$name,$NIC,$dateOfBirth,$email,$homeAddress,$mobileNumber,$occupation,$clubPost,$profileImage,$status,$dateOfJoin,$username,$password)
    {
        $queryToInsertClubMember = mysqli_query($connect, "INSERT INTO clubmember(name,NIC,dateOfBirth,email,homeAddress,mobileNumber,occupation,clubPost,profileImage,status,dateofjoin,username,password) VALUES ('$name','$NIC','$dateOfBirth','$email','$homeAddress','$mobileNumber','$occupation','$clubPost','$profileImage','$status','$dateOfJoin','$username','$password')");

    }
    public function selectMembersForElection($connect){
<<<<<<< HEAD
        $queryToSelectMembersForElection= mysqli_query($connect, "SELECT memberID,name,clubPost,dateOfJoin,email,mobileNumber FROM clubmember WHERE status=\"registered\"");
=======
        $queryToSelectMembersForElection= mysqli_query($connect, "SELECT memberID,name,clubPost,dateofjoin,email,mobileNumber FROM clubmember WHERE status=\"registered\"");
>>>>>>> 3f0ff4e9c4ad37e1e6aaf94bf6cfc131da422834
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
        $queryToloadAllElectionsWithDetails = mysqli_query($connect, "SELECT electionID,electionName,date,startTime,endTime,electionStatus FROM election");
        return $queryToloadAllElectionsWithDetails;
    }
    public function getMemberDetailsOfElection($connect,$electionID){
        $queryToGetMemDetails = mysqli_query($connect,"SELECT name,candidate.memberID,candidateNo,symbolImage from clubmember,candidate where clubmember.memberID=candidate.memberID AND candidate.electionID='$electionID'");
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


}
?>
