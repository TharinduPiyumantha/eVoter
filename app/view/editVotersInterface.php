<?php
include "../templates/header.php";
require_once("../model/election.php");
require_once("../model/DB_1.php");

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}
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
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            alert("Are you sure you want to delete the selected row?");
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkboxname = row.cells[0].childNodes[0].name;
                var chkbox = row.cells[0].childNodes[0];
                var memID = chkboxname;
                var eID = '<?php echo $electionID; ?>';

                if (null != chkbox && true == chkbox.checked) {
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
            //location.reload();

        }catch(e) {
            alert(e);
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
                    <h2 class="page-header"> Edit Election </h2>
                </div>
            </div>

            <form class="form-horizontal" role="form" method="post" action="../view/viewElectionDetails.php?electID=<?php echo $electionID;?>">
                <label class="control-label col-sm-2" for="addCandidates">Selected Voters:</label><br>
                <INPUT type="button" id="remove" value="Remove Voters" class="btn btn-default btn-primary" onClick="deleteRow('dataTable')" style="margin-top: -20;"/>
                <INPUT type="button" id="add" value="Add New Voters" class="btn btn-default btn-primary" onClick="location.href = 'addNewVoters.php?electID=<?php echo $electionID;?>'" style="margin-top: -20;"/> <br><br>

                <table id="memberTable" class="table table-striped table-bordered" cellspacing="0" width="10%">
                    <thead>
                    <tr>
                        <th></th>
                        <th>MemberID</th>
                        <th>Member Name</th>
                        <th>Club Post</th>
                        <th>Date Of Join</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>MemberID</th>
                        <th>Member Name</th>
                        <th>Club Post</th>
                        <th>Date Of Join</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                    </tr>
                    </tfoot>
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
                    <div class="col-sm-offset-2 col-sm-10">
                        <input name="submit" type="submit" id="addVotersBtn" class="btn btn-default btn-primary" value="Next>>>"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>