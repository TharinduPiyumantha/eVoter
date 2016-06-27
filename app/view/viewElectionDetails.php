<?php include "../templates/header.php";
/**
* Created by PhpStorm.
* User: ShalikaFernando
* Date: 6/7/2016
* Time: 4:17 PM
*/
?>
<body>
<?php
require_once('../model/election.php');
require_once('../model/DB.php');
$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}
echo $electionID;
$db= new DB();
$connection = $db->connectToDatabase();
$election = new Election();
$queryData = $election->getElectionDetails($connection,$electionID);
$row = mysqli_fetch_row($queryData);

?>
<div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top color-change" role="navigation" >
        <?php include "../templates/topmenu.php";
        include "../templates/sidemenu.php";
        ?>
    </nav>

    <div id="page-wrapper">
        <div class="container">
            <h2>Election Details</h2>
            <form class="form-horizontal" role="form" method="post" action="../controller/createElection.php">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Election Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="elecName" name="elecName" value="<?php echo $row[0]?>" readonly>

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="date">Date:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" name="date" value="<?php echo $row[1]?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="stime">Start Time:</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="sTime" name="sTime" value="<?php echo $row[2]?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="etime">End Time:</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="eTime" name="eTime" value="<?php echo $row[3]?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="noOfVotesPerson">Number of Votes Per Person:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="votes" name="votes" value="<?php echo $row[4]?>" readonly>
                    </div>
                </div>
                <br><br>
            </form>
        </div>
        <div class="container">
            <h2>Candidates Details</h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Member Name</th>
                    <th>Member ID</th>
                    <th>Candidate No</th>
                    <th>Image Of Party</th>
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
                        <td><?php echo $data1[3] ?></td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>
            </table>
        </div>
        <div class="container">
            <h2>Voters Details</h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Member Name</th>
                    <th>Club Post</th>
                    <th>Data OF Join</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
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
        </div>
        <input type="button" value="Edit" class="btn btn-default" id="editElection" onClick="document.location.href='editElectionEventInterface.php?electID=<?php echo $electionID;?>'" />
        <input type="button" value="Delete" class="btn btn-default" id="deleteElection" onClick="document.location.href='deleteElectionEvent.php'" />
        <input type="button" value="Cancel" class="btn btn-default" id="cancelElection" onClick="document.location.href='electionList.php'" />
    </div>
</div>

</body>
</html>