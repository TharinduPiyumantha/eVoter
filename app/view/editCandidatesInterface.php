<?php
require_once('../core/init.php');
include "../templates/header.php";
/**
* Created by PhpStorm.
* User: ShalikaFernando
* Date: 6/15/2016
* Time: 8:59 AM
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
        var chckBoxCount = document.querySelectorAll('input[type="checkbox"]:checked').length;

        if(chckBoxCount!=0) {
            var r = confirm("Are You Sure You Want To Remove The Candidate?");

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
                    //alert(memID);
                    //alert(eID);


                    if (null != chkbox && true == chkbox.checked) {
                        memberIDs.push(memID);
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
                var json = JSON.stringify(memberIDs);

                window.location = "cmntsOnRemovingCandidates.php?electID=" + eID + "&memberIDs=" + json + "&token=" + "\'candidate\'";

            } else {

            }
        }else{
            alert("Please Select Candidates You Want To Remove!");
        }
    }

</script>
<script>
    function validateTable(){
        var tableLength = document.getElementById("memberTable").rows.length - 1;
        var i;
        var resultBool = true;
        var eID = '<?php echo $electionID; ?>';


        for(i=1;i<=tableLength;i++){
            var candNo = document.getElementById(i+"candNo").value;
            var img = document.getElementById(i+"img").value;

            if(candNo == '0' || img == '' ){
                resultBool = resultBool && false;
            }
            else{
                resultBool = resultBool && true;
            }
        }
        if(resultBool == false){
            window.location = "newCandidateList.php?electID="+ eID ;
            return false;
        }else{
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
                    <h4 class="page-header"> Selected Candidates: </h4>
                </div>
            </div>
            <br>

            <form class="form-horizontal" role="form" method="post" action="editVotersInterface.php?electID=<?php echo $electionID;?>" onsubmit="return validateTable();">

                    <input type="button" id="add" value="Add More Candidates"  class="btn btn-default btn-primary" onClick="location.href = 'addNewCandidates.php?electID=<?php echo $electionID;?>'" style="margin-top: -20;"/>

                    <input type="button" id="remove" value="Remove Candidates" class="btn btn-default btn-primary"  onClick="deleteRow('dataTable')" style="margin-top: -20;"/> <br><br>
                    <table id="memberTable" class="table table-striped table-bordered" cellspacing="0" width="10%">
                        <thead>
                        <tr bgcolor="#2952a3">
                            <th style="color:White"></th>
                            <th style="color:White">MemberID</th>
                            <th style="color:White">Member Name</th>
                            <th style="color:White">Candidate No</th>
                            <th style="color:White">Symbol Image</th>
                        </tr>
                        </thead>
                        <tbody id="dataTable">
                        <?php
                        $i =1;
                        $candidateList= $election->getCandidateDetails($connection,$electionID);
                        while($data1 = $candidateList -> fetch_row()) {
                        ?>
                        <tr  id = <?php echo $data1[0]?>>
                            <td class="tableData" name=<?php echo $data1[0]?>><input name="<?php echo $data1[0] ?>" id=<?php echo $data1[0] ?> class="CheckBoxSchedule" type="checkbox" value="<?php echo $data1[0] ?>"></td>
                            <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[0] ?></td>
                            <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[1] ?></td>
                            <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[2] ?></td>
                            <input type="hidden" id='<?php echo $i ."candNo"?>' name="candNo" value="<?php echo $data1[2] ?>"/>
                            <td class="tableData" name=<?php echo $data1[0] ?>><img src="<?php echo $data1[3]?>" width="50" height="50"></td>
                            <input type="hidden" id='<?php echo $i ."img"?>' name="img" value="<?php echo $data1[3] ?>"/>
                            <?php
                                $i = $i+1;
                            } ?>
                        </tbody>
                    </table><br><br>

                    <div class="form-group">
                        <div class="col-sm-offset-8 col-sm-5">
                            <input type="button" value="<<< Back" class="btn btn-default" id="backToElection" onClick="document.location.href='editElectionEventInterface.php?electID=<?php echo $_GET["electID"];?>'" />
                            <input type="button" value="Cancel" class="btn btn-default" id="cancelElection" onClick="document.location.href='electionList.php'" />
                            <input name="submit" type="submit" class="btn btn-default btn-primary" id="addVotersBtn" value="Next>>>"/>
                        </div>
                    </div>
            </form>

        </div>
    </div>
</div>
</body>
</html>