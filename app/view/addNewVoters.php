<?php
require_once('../core/init.php');
include "../templates/header.php";
require_once("../model/member.php");
require_once("../model/DB_1.php");

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
            "bAutoWidth": false });
    });
</script>

<script language="JavaScript">
    function toggle(source) {
        checkboxes = document.getElementsByName('check_list[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>
<script>
    function sendNotifications() {
        var chckBoxCount = document.querySelectorAll('input[type="checkbox"]:checked').length;

        if(chckBoxCount >= 1) {
            var r = confirm("Are You Sure You Want To Send Emails and SMSs To The Selected Voters?");

            if (r == true) {
                var table = document.getElementById("memberTable");
                var rowCount = table.rows.length;
                for (var i = 0; i < rowCount; i++) {
                    var row = table.rows[i];
                    var email = row.cells[5].childNodes[0].name;
                    var mobile = row.cells[6].childNodes[0].name;
                    var eID =  <?php echo $_GET["electID"];?>;
                    var type = "voter";
                    var chkbox = row.cells[0].childNodes[0];

                    if (null != chkbox && true == chkbox.checked) {
                        $.post("../controller/notiToCandidatesAndVoters.php",
                            {
                                emailAdd: email,
                                mobileNo: mobile,
                                electID:eID,
                                memType:type
                            }
                        );
                    }
                }
                alert("Notifications are sent successfully!");

            } else {

            }
        }else{
            alert("Please Select Appropriate Number Of Voters To Send Notifications!");
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
                    <h4 class="page-header"> Add More Voters: </h4>
                </div>
            </div>

            <form class="form-horizontal" role="form" method="post" action="../controller/addVoters.php?electID=<?php echo $_GET["electID"];?>&status=<?php echo $status?>">
                <input type="checkbox" onClick="toggle(this)" /> Select All<br/><br/>
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
                    <tbody>
                    <?php
                    $member = new Member();
                    $regNotInElect = $member->getRegMemNotInElect((new DB_1)->connectToDatabase(),$electionID);
                    while($data1 = $regNotInElect -> fetch_row()){
                    ?>
                    <tr  id = <?php echo $data1[0]?>>
                        <td class="tableData" name=<?php echo $data1[0]?>><input name="check_list[]" id=<?php echo $data1[0] ?> class="CheckBoxSchedule" type="checkbox" value="<?php echo $data1[0] ?>"></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[0] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[1] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[2] ?></td>
                        <input type="hidden" name="member[0][clubPost]" value="<?php echo $data1[2] ?>"/>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[3] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><input type="hidden" name="<?php echo $data1[4]?>"/><?php echo $data1[4] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><input type="hidden" name="<?php echo $data1[5]?>"/><?php echo $data1[5] ?></td>
                        <?php } ?>
                    </tbody>
                </table><br>
                <div class="form-group">
                    <div class="col-sm-offset-7 col-sm-6">
                        <input type="button" value="Send Notifications" class="btn btn-default" id="sendNoti" onclick="sendNotifications()" />
                        <input type="button" value="<<< Back" class="btn btn-default" id="backToElection" onClick="document.location.href='editVotersInterface.php?electID=<?php echo $_GET["electID"];?>'" />
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