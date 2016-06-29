<?php
include "../templates/header.php";
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 6/15/2016
 * Time: 8:24 AM
 */
?>
<body>
<?php
require_once('../model/election.php');
require_once('../model/DB_1.php');
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
<div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top color-change" role="navigation" >
        <?php include "../templates/topmenu.php";
        include "../templates/sidemenu.php";
        ?>
    </nav>

    <div id="page-wrapper">
        <div class="container">
            <h2>Edit Election</h2>
            <form class="form-horizontal" role="form" method="post" action="../controller/editElectionDetails.php?electID=<?php echo $electionID;?>">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Election Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="elecName" name="elecName" value="<?php echo $row[0]?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="date">Date:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="date" name="date" value="<?php echo $row[1]?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="stime">Start Time:</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="sTime" name="sTime" value="<?php echo $row[2]?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="etime">End Time:</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" id="eTime" name="eTime" value="<?php echo $row[3]?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="noOfVotesPerson">Number of Votes Per Person:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="votes" name="votes" value="<?php echo $row[4]?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input name="submit" type="submit" id="electionDetailEdit" class="btn btn-default btn-primary" value="Next>>>"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>