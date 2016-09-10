<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 8/1/2016
 * Time: 10:47 AM
 */

include "../templates/header.php";
require_once("../model/election.php");
require_once("../model/DB_1.php");
require_once("../model/candidate.php");
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

$candidate = new Candidate();

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

$db= new DB_1();
$connection = $db->connectToDatabase();
$election = new Election();
$electionDetailsArr = $election->getElectionDetails($connection,$electionID);
$electionDetails = $electionDetailsArr->fetch_row();
$noOfVotesPerPerson = $electionDetails[4];
echo $noOfVotesPerPerson;
?>
<link href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script>
    function validateBallotPaper(){

        var noOfVotesPerVoter = <?php echo $noOfVotesPerPerson ?>;
        var checkboxes = $("[type='checkbox']:checked").length;

        if((noOfVotesPerVoter >= checkboxes) && (checkboxes != '0') ){
            return true;

        }else {
            if(checkboxes == '0'){
                alert("You have to select "+noOfVotesPerVoter);
                return false;
            }else{
                alert("You can select only "+noOfVotesPerVoter);
                return false;
            }

        }
    }

</script>
</head>
<body>

<div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top color-change" role="navigation" >
        <?php include "../templates/topmenu.php";
        include "../templates/sidemenu.php";
        ?>
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Ballot Paper </h1>
                </div>
            </div>
            <div class="ballotPaper">
                <form class="form-horizontal" role="form" method="post" action="../controller/ballotPaper.php?electID=<?php echo $electionID?>" name="f1" id="form1" onsubmit="return validateBallotPaper();">
                    <table id="electionTable" class="table">
                        <thead>
                        <tr>
                            <th>Candidate Name</th>
                            <th>Candidate No</th>
                            <th>Candidate Symbol</th>
                            <th>Vote</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $candidateDetails = $candidate->getCandidateInfo($connection,$electionID);
                        while($data1 = $candidateDetails -> fetch_row()){

                            ?>
                            <script> var id = <?php echo(json_encode($data1[0])); ?>;</script>
                            <tr class="tableRow" id = <?php echo $data1[0] ?> href="viewElectionResults.php?electID=<?php echo $data1[0]?>">
                                <td class="tableData" ><?php echo $data1[0] ?> </td>
                                <td class="tableData" ><?php echo $data1[1] ?></td>
                                <td class="tableData" ><img src="<?php echo $data1[2]?>" width="50" height="50"></td>
                                <td class="tableData" ><input type="checkbox" name="vote[]" value="<?php echo $data1[1] ?>"></td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="col-sm-6 col-sm-offset-11 controls" >
                        <input name="submit" class="btn btn-default btn-primary" type="submit" id="ballotSubmitBtn" value="confirm" />
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>