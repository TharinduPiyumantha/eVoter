<?php
include "../templates/header.php";
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 6/15/2016
 * Time: 8:24 AM
 */
require_once('../model/election.php');
require_once('../model/DB_1.php');
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

$db= new DB_1();
$connection = $db->connectToDatabase();
$election = new Election();
$queryData = $election->getElectionDetails($connection,$electionID);
$row = mysqli_fetch_row($queryData);
?>
<script>
    function validateElection(){
        var startTime = document.getElementById('sTime').value;
        var endTime = document.getElementById('eTime').value;
        var noOfVotes = document.getElementById('votes').value;
        var electionName = document.getElementById('elecName').value;
        var date = document.getElementById('date').value;

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        var hrs = today.getHours();
        var min = today.getMinutes();
        var sec = today.getSeconds();

        if(dd<10){
            dd='0'+dd
        }
        if(mm<10){
            mm='0'+mm
        }
        var today = yyyy+'-'+mm+'-'+dd;

        if(hrs<10){
            hrs='0'+hrs
        }
        if(min<10){
            min='0'+min
        }
        if(sec<10){
            sec='0'+sec
        }
        var curTime = hrs+':'+min;

        if(!(isNaN(electionName))){
            alert("Election Name Should Be A String!");
            return false;
        }else if(/^[0-9 _@.,/#&+-]+$/.test(electionName)){
            alert("Election Name Should Be A String!");
            return false;
        }else if(today == date){
            if((startTime <= curTime) || (curTime >= endTime)){
                alert("Start Time & End Time Should Be Greater Than The Current Time...Please select appropriate Start & End Times.");
                return false;

            }else if((startTime > endTime) || (startTime == endTime)){
                alert("Start Time Should Be Less Than End Time...Please select appropriate Start & End Times.");
                return false;
            }else if( (noOfVotes == 0) || (noOfVotes < 0) || (noOfVotes % 1 != 0)){
                alert("Number Of Votes Per Person Shoud Be A Positive Integer!");
                return false;
            }

        }
        else if((today != date) && ((startTime > endTime) || (startTime == endTime))){
            alert("Start Time Should Be Less Than End Time...Please select appropriate Start & End Times.");
            return false;
        }
        else if( (noOfVotes == 0) || (noOfVotes < 0) || (noOfVotes % 1 != 0)){
            alert("Number Of Votes Per Person Shoud Be A Positive Integer!");
            return false;
        }else{
            alert("You can select only "+noOfVotesPerVoter);
            return true;
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

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Edit Election </h1>
                </div>
            </div>
            <br>

            <form class="form-horizontal" role="form" method="post" action="../controller/editElectionDetails.php?electID=<?php echo $electionID;?>" onsubmit="return validateElection();">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="name">Election Name:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="elecName" name="elecName" value="<?php echo $row[0]?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="date">Date:</label>
                    <div class="col-sm-4">
                        <input type="date" min="<?php echo date("Y-m-d"); ?>" class="form-control" id="date" name="date" value="<?php echo $row[1]?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="stime">Start Time:</label>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" id="sTime" name="sTime" value="<?php echo $row[2]?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="etime">End Time:</label>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" id="eTime" name="eTime" value="<?php echo $row[3]?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="noOfVotesPerson">Number of Votes Per Person:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="votes" name="votes" value="<?php echo $row[4]?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-7 col-sm-3">
                        <input type="button" value="<<< Back" class="btn btn-default" id="cancelElection" onClick="document.location.href='viewElectionDetails.php?electID=<?php echo $electionID;?>&status=Scheduled'" />
                        <input name="submit" type="submit" id="electionDetailEdit" class="btn btn-default btn-primary" value="Next >>>"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>