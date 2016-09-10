<?php
require_once('../core/init.php');
include "../templates/header.php";
require_once("../model/election.php");
require_once("../model/DB_1.php");
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}
$status = "Scheduled";
?>
<link href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>

<script>
    $(document).ready(function() {
        $('#memberTable').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "stateSave": false
        });
    });
</script>
<script>
    function deleteRow(tableID) {
        var chckBoxCount = document.querySelectorAll('input[type="checkbox"]:checked').length;

        if(chckBoxCount!=0) {
            var r = confirm("Are You Sure You Want To Remove The Selected Voters?");

            if (r == true) {
                var memberIDs = new Array();
                var table = document.getElementById(tableID);
                var rowCount = table.rows.length;
                for (var i = 0; i < rowCount; i++) {
                    var row = table.rows[i];
                    var chkboxname = row.cells[0].childNodes[0].name;
                    var chkbox = row.cells[0].childNodes[0];
                    var memID = chkboxname;
                    var eID = '<?php echo $electionID; ?>';

                    if (null != chkbox && true == chkbox.checked) {
                        memberIDs.push(memID);
                        $.post("../controller/deleteVoters.php",
                            {
                                memberID: memID,
                                electID: eID
                            }
                        );
                        table.deleteRow(i);
                        rowCount--;
                        i--;
                    }
                }
                var json = JSON.stringify(memberIDs);

                window.location = "cmntsOnRemovingVoters.php?electID=" + eID + "&memberIDs=" + json + "&token=" + "\'voter\'";

            } else {

            }
        }else{
            alert("Select Voters You Want To Remove!");
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
                    <h4 class="page-header"> Selected Voters: </h4>
                </div>
            </div>
            <br>

            <form class="form-horizontal" role="form" method="post" action="../view/viewElectionDetails.php?electID=<?php echo $electionID;?>&status=<?php echo $status?>">
                <INPUT type="button" id="remove" value="Remove Voters" class="btn btn-default btn-primary" onClick="deleteRow('dataTable')" style="margin-top: -20;"/>
                <INPUT type="button" id="add" value="Add More Voters" class="btn btn-default btn-primary" onClick="location.href = 'addNewVoters.php?electID=<?php echo $electionID;?>'" style="margin-top: -20;"/> <br><br>

                <table id="memberTable" class="table table-striped table-bordered" cellspacing="0" width="10%">
                    <thead>
                    <tr bgcolor="#2952a3">
                        <th style="color:White"></th>
                        <th style="color:White">MemberID</th>
                        <th style="color:White">Member Name</th>
                        <th style="color:White">Club Post</th>
                        <th style="color:White">Date Of Join</th>
                        <th style="color:White">Email</th>
                        <th style="color:White">Mobile Number</th>
                    </tr>
                    </thead>
                    <tbody id="dataTable">
                    <?php
                    $election = new Election();
                    $selectedVotersForElection = $election->getVoterDetails((new DB_1)->connectToDatabase(),$electionID);
                    while($data1 = $selectedVotersForElection -> fetch_row()){
                    ?>
                    <tr  id = <?php echo $data1[0]?>>
                        <td class="tableData" name=<?php echo $data1[0]?>><input name="<?php echo $data1[0] ?>" id=<?php echo $data1[0] ?> class="CheckBoxSchedule" type="checkbox" value="<?php echo $data1[0] ?>"></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[0] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[1] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[2] ?></td>
                        <input type="hidden" name="member[0][clubPost]" value="<?php echo $data1[2] ?>"/>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[3] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[4] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[5] ?></td>
                        <?php } ?>
                    </tbody>
                </table><br><br>

                <div class="form-group">
                    <div class="col-sm-offset-8 col-sm-3">
                        <input type="button" value="<<< Back" class="btn btn-default" id="backToElection" onClick="document.location.href='editCandidatesInterface.php?electID=<?php echo $_GET["electID"];?>'" />
                        <input type="button" value="Cancel" class="btn btn-default" id="cancelElection" onClick="document.location.href='electionList.php'" />
                        <input name="submit" type="submit" id="addVotersBtn" class="btn btn-default btn-primary" value="Finish"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>