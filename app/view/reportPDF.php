<?php

require_once('../../public/fpdf181/diag.php');
require_once("../model/election.php");
include("../model/DB_1.php");
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

$db = new DB_1();
$connect = $db->connectToDatabase();

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}
$election = new Election();

$electionDetailsArr = $election->getElectionDetails($connect,$electionID);
$electDet = $electionDetailsArr->fetch_row();
$electionName = $electDet[0];
$date = $electDet[1];

$qualifiedCandidates = $election->getNoOfQualifiedCandidates($connect,$electionID);
$noOfQualifiedCandidatesArr = $qualifiedCandidates->fetch_row();
$noOfQualifiedCandidates = $noOfQualifiedCandidatesArr[0];
//echo $noOfQualifiedCandidates;

$qualifiedVoters = $election->getNoOfQualifiedVoters($connect,$electionID);
$noOfQualifiedVotersArr = $qualifiedVoters->fetch_row();
$noOfQualifiedVoters = $noOfQualifiedVotersArr[0];
//echo $noOfQualifiedVoters;

$castedVoters = $election->getNoOfCastedVoters($connect,$electionID);
$noOfCastedVotersArr = $castedVoters->fetch_row();
$noOfCastedVoters = $noOfCastedVotersArr[0];
//echo $noOfCastedVoters;

$wonParty = $election->getWonPersonality($connect,$electionID);
$wonPartyArr = $wonParty->fetch_row();
$wonPartyCandNo = $wonPartyArr[0];
//echo $wonPartyCandNo;

$wonPersonDetails = $election->getWonPersonalityDetails($connect,$electionID,$wonPartyCandNo);
$wonPersonDetailsArr = $wonPersonDetails->fetch_row();
$wonPersonName = $wonPersonDetailsArr[1];
//echo $wonPersonName;

$candNoArr = $election->getCandidateNumbers($connect,$electionID);
$resultsArray_small = array();
$resultsArray_big = array();
while($candNo = $candNoArr->fetch_row()) {
    $candiNo = $candNo[0];
    $candVoteCountArray = $election->getVotesCountPerCandidate($connect, $electionID, $candiNo);
    $candVoteCount = $candVoteCountArray->fetch_row();
    $voteCount = $candVoteCount[0];

    $candDetailsArray = $election->getCandidatesDetailsForResults($connect, $electionID, $candNo[0]);
    $details = $candDetailsArray->fetch_row();
    $name = $details[0];

    array_push($resultsArray_small, $name, $candiNo, $voteCount);
    array_push($resultsArray_big,$resultsArray_small);
    $resultsArray_small = array();
}
$number_of_records = sizeof($resultsArray_big);

//Initialize the 3 columns and the total
$column_candNo = "";
$column_candName = "";
$column_votes = "";

//For each row, add the field to the corresponding column
foreach($resultsArray_big as $row)
{
    $number = $row[1];
    $name = substr($row[0],0,20);
    $votes = $row[2];

    $column_candNo = $column_candNo.$number."\n";
    $column_candName = $column_candName.$name."\n";
    $column_votes = $column_votes.$votes."\n";

}

$data_array = array();
foreach($resultsArray_big as $row) {
    $data_array[$row[0]] = $row[2];
}
mysqli_close($connect);

//Create a new PDF file
$pdf = new PDF_Diag();
$pdf->AddPage();

$pdf->SetFont('Arial','U',26);
$pdf->SetTextColor(0, 0, 153);
$pdf->Write(5,$electionName." - Results");
$pdf->Ln(12);

$pdf->SetX(40);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(20,6,'Date Held : ',0,0,'C',0);
$pdf->SetFont('Arial','',11);
$pdf->Write(5,$date);
$pdf->Ln(8);

$pdf->SetX(40);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(15,6,'Winner : ',0,0,'C',0);
$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(255, 153, 0);
$pdf->Write(5,$wonPersonName);
$pdf->Ln(8);

$pdf->SetX(40);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(45,6,'Number Of Candidates : ',0,0,'C',0);
$pdf->SetFont('Arial','',11);
$pdf->Write(5,$noOfQualifiedCandidates);
$pdf->Ln(8);

$pdf->SetX(40);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(55,6,'Number Of Qualified Voters : ',0,0,'C',0);
$pdf->SetFont('Arial','',11);
$pdf->Write(5,$noOfQualifiedVoters);
$pdf->Ln(8);

$pdf->SetX(40);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(50,6,'Number Of Casted Voters : ',0,0,'C',0);
$pdf->SetFont('Arial','',11);
$pdf->Write(5,$noOfCastedVoters);
$pdf->Ln(8);
$pdf->Ln(8);

$pdf->SetFont('Arial', 'BIU', 12);
$pdf->Cell(0, 5, 'Results In Tabular Format', 0, 1);

$Y_Fields_Name_position = 90;
//Table position, under Fields Name
$Y_Table_Position = 96;

//First create each Field Name
//Blue color filling each Field Name box
$pdf->SetFillColor(102, 153, 255);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',11);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(25);
$pdf->Cell(30,6,'Candidate No',1,0,'C',1);
$pdf->SetX(55);
$pdf->Cell(50,6,'Candidate Name',1,0,'C',1);
$pdf->SetX(105);
$pdf->Cell(15,6,'Votes',1,0,'C',1);
$pdf->SetX(120);
$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial','',10);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(25);
$pdf->MultiCell(30,6,$column_candNo,1,'C');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(55);
$pdf->MultiCell(50,6,$column_candName,1,'L');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(105);
$pdf->MultiCell(15,6,$column_votes,1,'C');
$pdf->SetX(120);

//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $number_of_records)
{
    $pdf->SetX(25);
    $pdf->MultiCell(95,6,'',1);
    $i = $i +1;
}


$pdf->Ln(8);
$pdf->SetFont('Arial', 'BIU', 12);
$pdf->Cell(0, 5, 'Results In Bar Diagram Format', 0, 1);
$pdf->Ln(8);
$valX = $pdf->GetX();
$valY = $pdf->GetY();
$pdf->BarDiagram(190, 70, $data_array, '%l : %v (%p)', array(255, 204, 0));
$pdf->SetXY($valX, $valY + 80);

$pdf->Output();
?>

