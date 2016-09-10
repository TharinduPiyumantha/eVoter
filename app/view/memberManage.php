<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/08/2016
 * Time: 10:26
 */

include "../templates/header.php";
require_once '../model/dbConfig.php';
require_once("../model/DB_1.php");
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}
?>

<script type="text/JavaScript">
    function confirmDelete(){
        confirm("Are you sure you want to delete this file?");
    }
</script>

<script type="text/javascript">
    <!-- clickable raws-->
    $(document).ready(function(){
        $('.tableRow').click(function(){
            window.location = $(this).attr('href');
            return false;
        });
    });
</script>

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

    <!-- clickable raws-->
    $(document).ready(function(){
        $('.tableRow').click(function(){
            window.location = $(this).attr('href');
            return false;
        });
    });
</script>

<script src="../../public/js/deleteMember_checkbox.js"></script>
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
                    <h1 class="page-header"> Member Manage </h1>
                </div>
            </div>

            <?php
            $user = new User();
            $current_user = $user->data()->memberID;
            $sql = "SELECT * FROM clubmember WHERE status = 'registered' OR status = 'candidate' AND memberID != '$current_user'  ";
            $result = mysqli_query($con, $sql);
            ?>

            <form class="form-horizontal" role="form" method="post" action="../controller/deleteMembers.php">

                <input type="checkbox" onClick="toggle(this)" /> Select All<br/>

                <div class="col-sm-offset-10 col-sm-2" style="margin-bottom: 10px; margin-left: 860px;">
                    <button type="submit" id="btn-signup" name="btn-signup" class="btn btn-default btn-primary" onclick="confirmDelete()">
                        <i class="fa fa-hand-o-right"></i>&nbsp;Delete Member
                    </button>
                </div>

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
                    <tbody>
                    <?php
                    while($data1 = mysqli_fetch_row($result)){
                    ?>
                    <tr  class='tableRow' id = <?php echo $data1[0]?> href='admin_profile.php?value=<?php echo $data1[0]?>' >
                        <td class="tableData" name=<?php echo $data1[0]?>><input name="check_list[]" id=<?php echo $data1[0] ?> class="CheckBoxSchedule" type="checkbox" value="<?php echo $data1[0] ?>"></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[0] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[1] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[2] ?></td>
                        <input type="hidden" name="member[0][clubPost]" value="<?php echo $data1[2] ?>"/>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[3] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[4] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[5] ?></td>
                        <?php } ?>
                    </tbody>
                </table><br>

            </form>
        </div>
    </div>
</div>
</body>
</html>