<?php include "../templates/header.php";
/**
* Created by PhpStorm.
* User: ShalikaFernando
* Date: 6/15/2016
* Time: 8:59 AM
*/

require_once('../model/election.php');
require_once('../model/DB_1.php');
$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

$db= new DB_1();
$connection = $db->connectToDatabase();
$election = new Election();

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
<script src="../../public/js/jquery.min.js"></script>
<script>
    function deleteRow(tableID) {
            var r = confirm("Are You Sure You Want To Remove The Candidate?");
            if(r==true) {
                var table = document.getElementById(tableID);
                var rowCount = table.rows.length;
                for (var i = 0; i < rowCount; i++) {
                    var row = table.rows[i];
                    var chkboxname = row.cells[0].childNodes[0].name;
                    var chkbox = row.cells[0].childNodes[0];
                    var memID = chkboxname;
                    var eID = '<?php echo $electionID; ?>';

                    if (null != chkbox && true == chkbox.checked) {
                        $.post("../controller/deleteRowData.php",
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
            }else{

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

        <div class="container">
            <h2>Edit Election</h2>
            <form class="form-horizontal" role="form" method="post" action="editVotersInterface.php?electID=<?php echo $electionID;?>">
                <div class="container">
                    <label class="control-label col-sm-2" for="addCandidates">Selected Candidates:</label><br>

                    <INPUT type="button" id="add" value="Add More Candidates"  class="btn btn-default btn-primary" onClick="location.href = 'addNewCandidates.php?electID=<?php echo $electionID;?>'" />

                    <INPUT type="button" id="remove" value="Remove Candidates" class="btn btn-default btn-primary"  onClick="deleteRow('dataTable')" /> <br><br>

                    <table id="memberTable" class="table table-striped table-bordered" cellspacing="0" width="10%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>MemberID</th>
                            <th>Member Name</th>
                            <th>Candidate No</th>
                            <th>Symbol Image</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th>MemberID</th>
                            <th>Member Name</th>
                            <th>Candidate No</th>
                            <th>Symbol Image</th>

                        </tr>
                        </tfoot>
                        <tbody id="dataTable">
                        <?php
                        $candidateList= $election->getCandidateDetails($connection,$electionID);
                        while($data1 = $candidateList -> fetch_row()) {
                        ?>
                        <tr  id = <?php echo $data1[0]?>>
                            <td class="tableData" name=<?php echo $data1[0]?>><input name="<?php echo $data1[0] ?>" id=<?php echo $data1[0] ?> class="CheckBoxSchedule" type="checkbox" value="<?php echo $data1[0] ?>"></td>
                            <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[0] ?></td>
                            <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[1] ?></td>
                            <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[2] ?></td>
                            <input type="hidden" name="member[0][clubPost]" value="<?php echo $data1[2] ?>"/>
                            <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[3] ?></td>
                            <?php } ?>
                        </tbody>
                    </table><br><br>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input name="submit" type="submit" class="btn btn-default btn-primary" id="addVotersBtn" value="Next>>>"/>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>