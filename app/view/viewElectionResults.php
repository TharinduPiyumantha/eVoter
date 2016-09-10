<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 7/30/2016
 * Time: 10:19 AM
 */
include "../templates/header.php";
require_once("../model/election.php");
require_once("../model/DB_1.php");
include("../../public/php-wrapper/wrappers 2/php-wrapper/fusioncharts.php");
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

$db = new DB_1();
$connect = $db->connectToDatabase();

$election = new Election();

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}
$election = new Election();
$electionDetails = $election->getElectionDetails($connect,$electionID);
$electDataArray = $electionDetails->fetch_row();
$electionName = $electDataArray[0];
$date = $electDataArray[1];
//echo $electionName;

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

?>
<link href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<link  rel="stylesheet" type="text/css" href="css/style.css" />
<script src="../../public/php-wrapper/wrappers 2/php-wrapper/js/fusioncharts.js"></script>

</head>
<body>

<div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top color-change" role="navigation" >
        <?php include "../templates/topmenu.php";
        include "../templates/sidemenu.php";
        ?>
    </nav>

    <div id="page-wrapper">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> <?php echo $electionName; ?> - Results </h1>
            </div>
        </div>
        <div>
            <table width="35%" cellpadding="5" style="display: inline-block;" class="table-striped">
                <tbody>
                    <tr>
                        <th width="25%" scope="row">Election Name&nbsp;&nbsp;&nbsp;:</th>
                        <td height="40" width="50%"><?php echo $electionName; ?></td>
                    </tr>

                    <tr bgcolor="#e6ecff">
                        <th scope="row">Date Held&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</th>
                        <td height="40"><?php echo $date; ?></td>
                    </tr>

                    <tr>
                        <th scope="row">Winner&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</th>
                        <td height="40"><?php echo $wonPersonName; ?></td>
                    </tr>

                </tbody>
            </table>

            <table width="40%" cellpadding="5" style="display: inline-block;padding-left: 80px;" class="table-striped">
                <tbody>
                    <tr>
                        <th width="15%" scope="row">No Of Candidates&nbsp;&nbsp;&nbsp;:</th>
                        <td height="40" width="30%"><?php echo $noOfQualifiedCandidates ?></td>
                    </tr>

                    <tr bgcolor="#e6ecff">
                        <th scope="row">No Of Qualified Voters&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</th>
                        <td height="40"><?php echo $noOfQualifiedVoters ?></td>
                    </tr>

                    <tr>
                        <th scope="row">No Of Casted Voters&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</th>
                        <td height="40"><?php echo $noOfCastedVoters ?></td>
                    </tr>

                </tbody>
            </table>

            <!---<input type="button" class="btn btn-default btn-primary" value="View PDF" onclick="window.open('reportPDF.php?electID=<?php echo $electionID?>')"/><br><br><br>--->

        </div>


        <?php
        $candNoArr = $election->getCandidateNumbers($connect,$electionID);
        $resultsArray_small = array();
        $resultsArray_big = array();
        while($candNo = $candNoArr->fetch_row()) {
            $candVoteCountArray = $election->getVotesCountPerCandidate($connect, $electionID, $candNo[0]);
            $candVoteCount = $candVoteCountArray->fetch_row();
            $voteCount = $candVoteCount[0];

            $candDetailsArray = $election->getCandidatesDetailsForResults($connect, $electionID, $candNo[0]);
            $details = $candDetailsArray->fetch_row();
            $name = $details[0];

            array_push($resultsArray_small, $name, $voteCount);
            array_push($resultsArray_big,$resultsArray_small);
            $resultsArray_small = array();
        }

        if ($resultsArray_big) {
            // The `$arrData` array holds the chart attributes and data
            $arrData = array(
                "chart" => array(
                    "caption" => "Election Results",
                    "paletteColors" => "#ffcc00",
                    "bgColor" => "#1a75ff",
                    "borderAlpha"=> "20",
                    "canvasBorderAlpha"=> "0",
                    "usePlotGradientColor"=> "0",
                    "plotBorderAlpha"=> "10",
                    "showXAxisLine"=> "1",
                    "xAxisLineColor" => "#000000",
                    "showValues" => "0",
                    "divlineColor" => "#000000",
                    "divLineIsDashed" => "1",
                    "showAlternateHGridColor" => "0",
                    "width"=> "50",
                    "height"=> "50",
                    "xAxisName"=>"Candidate Name",
                    "yAxisName"=>"No Of Votes"

                )
            );

            $arrData["data"] = array();

            // Push the data into the array
            foreach($resultsArray_big as $row) {
                array_push($arrData["data"], array(
                        "label" => $row[0],
                        "value" => $row[1]
                    )
                );
            }

            /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

            $jsonEncodedData = json_encode($arrData);

            /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

            $columnChart = new FusionCharts("bar2D", "myFirstChart" , 500, 300, "chart-1", "json", $jsonEncodedData);

            // Render the chart
            $columnChart->render();
        }

        ?>
        <div style="display: inline-block;">
            <table width="400" cellpadding="5" class="table-striped" border="#0033cc">
                <thead>
                    <tr bgcolor="#99b3ff" height="60">
                        <th align="center">Candidate</th>
                        <th align="center">Candidate No</th>
                        <th align="center">Symbol Image</th>
                        <th align="center">No Of Votes</th>

                    </tr>
                </thead>

                <tbody>
                    <?php

                    $candNoArr = $election->getCandidateNumbers($connect,$electionID);

                    while($candNo = $candNoArr->fetch_row()){
                        $candVoteCountArray = $election->getVotesCountPerCandidate($connect,$electionID,$candNo[0]);
                        $candVoteCount = $candVoteCountArray->fetch_row();
                        $voteCount = $candVoteCount[0];

                        $candDetailsArray = $election->getCandidatesDetailsForResults($connect,$electionID,$candNo[0]);
                        $details = $candDetailsArray->fetch_row();
                        $name = $details[0];
                        $candNo = $details[1];
                        $symbol = $details[2];
                        ?>
                        <tr class="tableRow" id = <?php echo $candNo[0] ?>>
                            <td class="tableData" height="60" align="center"><?php echo $name ?></td>
                            <td class="tableData" align="center"><?php echo $candNo ?></td>
                            <td class="tableData" align="center"><img src="<?php echo $symbol?>" width="50" height="50"></td>
                            <td class="tableData" align="center"><?php echo $voteCount ?></td>
                        </tr>

                        <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <div id="chart-1" style="display: inline-block;padding-left: 80px;"><!-- Fusion Charts will render here--></div>
        </div>
    </div>
</body>
</html>




