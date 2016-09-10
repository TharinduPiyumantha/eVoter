<?php include "../templates/header.php";
/**
* Created by PhpStorm.
* User: ShalikaFernando
* Date: 6/7/2016
* Time: 4:17 PM
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
$status="";
if(isset($_GET["status"])){
    $status=$_GET["status"];
}
//echo $electionID;
$db= new DB_1();
$connection = $db->connectToDatabase();
$election = new Election();
$queryData = $election->getElectionDetails($connection,$electionID);
$row = mysqli_fetch_row($queryData);
?>
<script>
    function deleteElection(electID){
        var r = confirm("Are you sure you want to delete the election?");
        var electionID = electID;

        if(r==true) {
            window.location.href = "../controller/deleteElection.php?electID="+electionID;
        }else{

        }

    }
</script>
<script>
    function changeStatus(electID){

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
                    <h1 class="page-header"> Election Details </h1>
                </div>
            </div>

            <form class="form-horizontal" role="form" method="post" action="../controller/createElection.php">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="name">Election Name:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="elecName" name="elecName" value="<?php echo $row[0]?>" readonly>

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="date">Date:</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="date" name="date" value="<?php echo $row[1]?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="stime">Start Time:</label>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" id="sTime" name="sTime" value="<?php echo $row[2]?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="etime">End Time:</label>
                    <div class="col-sm-4">
                        <input type="time" class="form-control" id="eTime" name="eTime" value="<?php echo $row[3]?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="noOfVotesPerson">Number of Votes Per Person:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="votes" name="votes" value="<?php echo $row[4]?>" readonly>
                    </div>
                </div>
            </form>
        </div>
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Candidates Details </h1>
                </div>
            </div>

            <table class="table table-bordered" style="align-content: center">
                <thead>
                <tr bgcolor="#2952a3">
                    <th style="color:White">Member Name</th>
                    <th style="color:White">Member ID</th>
                    <th style="color:White">Candidate No</th>
                    <th style="color:White">Image Of Party</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $candidateList= $election->getCandidateDetails($connection,$electionID);
                while($data1 = $candidateList -> fetch_row()) {
                    ?>
                    <tr>
                        <td><?php echo $data1[0] ?></td>
                        <td><?php echo $data1[1] ?></td>
                        <td><?php echo $data1[2] ?></td>
                        <td><img src="<?php echo $data1[3]?>" width="50" height="50"></td>



                    </tr>
                    <?php
                }
                ?>

                </tbody>
            </table>
        </div>
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Voters Details </h1>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                <tr bgcolor="#2952a3">
                    <th style="color:White">Member ID</th>
                    <th style="color:White">Member Name</th>
                    <th style="color:White">Club Post</th>
                    <th style="color:White">Data OF Join</th>
                    <th style="color:White">Email</th>
                    <th style="color:White">Mobile Number</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $votersList= $election->getVoterDetails($connection,$electionID);
                while($data1 = $votersList -> fetch_row()) {
                    ?>
                    <tr>
                        <td><?php echo $data1[0] ?></td>
                        <td><?php echo $data1[1] ?></td>
                        <td><?php echo $data1[2] ?></td>
                        <td><?php echo $data1[3] ?></td>
                        <td><?php echo $data1[4] ?></td>
                        <td><?php echo $data1[5] ?></td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>
            </table>
        </div><br>

        <div class="form-group">
            <div class="col-sm-offset-9 col-sm-3">
                <?php if($status == "Scheduled"){?>
        <input type="button" value="Edit" class="btn btn-default" id="editElection" onClick="document.location.href='editElectionEventInterface.php?electID=<?php echo $electionID;?>'" />
               <?php }
                if($status != "On Going"){?>
        <input type="button" value="Delete" class="btn btn-default" id="deleteElection" onClick="deleteElection('<?php echo $electionID ?>')" />
                <?php }?>
        <input type="button" value="Cancel" class="btn btn-default" id="cancelElection" onClick="document.location.href='electionList.php'" />
                <?php
                if($status == "Finished"){?>
                <input type="button" value="Finish" class="btn btn-default" id="ChangeStatus" onClick="document.location.href='../controller/changeCandidateStatus.php?electID=<?php echo $electionID;?>'"  />
                <?php }?>
                </div></div>
        <br><br>

    </div>
</div>

</body>
</html>