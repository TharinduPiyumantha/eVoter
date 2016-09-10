<?php include "../templates/header.php";
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

    $currentDate = date("Y-m-d");
    //echo $currentDate;
    date_default_timezone_set("Asia/Colombo");
    $currentTime = date("H:i:s");
    //echo $currentTime;
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

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Create Election </h1>
        </div>
    </div>

<div class="election">
    <form class="form-horizontal" role="form" method="post" action="../controller/createElection.php" onsubmit="return validateElection();">
        <div class="form-group">
            <label class="control-label col-sm-4" for="name">Election Name:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="elecName" name="elecName" placeholder="Enter election name" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="date">Date:</label>
            <div class="col-sm-4">
                <input type="date" min="<?php echo date("Y-m-d"); ?>" class="form-control" id="date" name="date" placeholder="Enter date" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="stime">Start Time:</label>
            <div class="col-sm-4">
                <input type="time" class="form-control" id="sTime" name="sTime" placeholder="Enter start time" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="etime">End Time:</label>
            <div class="col-sm-4">
                <input type="time" class="form-control" id="eTime" name="eTime" placeholder="Enter end time" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="noOfVotesPerson">Number of Votes Per Person:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="votes" name="votes" placeholder="Enter number of votes per person" required>
            </div>
        </div>
        <br><br>
            <div class="col-sm-3 col-sm-offset-7 controls" >
                <input type="button" value="Cancel" class="btn btn-default" id="cancelElection" onClick="document.location.href='electionList.php'" />
                <input name="submit" class="btn btn-default btn-primary" type="submit" id="electionSaveBtn" value="Next >>"/>
            </div>

    </form>
</div>
</div>
        </div>
</div>
</body>
</html>
