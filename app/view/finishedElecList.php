<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 7/30/2016
 * Time: 9:08 AM
 */

include "../templates/header.php";
require_once("../model/election.php");
require_once("../model/DB_1.php");
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

?>
<link href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function() {
        $('#electionTable').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false,
            "order": [[ 1, "desc" ]]
        });
    });
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
                    <h1 class="page-header"> Finished Elections Results </h1>
                </div>
            </div>
            <table id="electionTable" class="table">
                <thead>
                <tr>
                    <th>Election Name</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
                </thead>

                <tbody>
                <?php

                $currentDate = date("Y-m-d");
                //echo $currentDate;
                date_default_timezone_set("Asia/Colombo");
                $currentTime = date("H:i:s");
                //echo $currentTime;
                $election = new Election();
                $electionList = $election->getElectionList((new DB_1)->connectToDatabase());
                $color = "#ffff66";
                $value = "Latest";
                while($data1 = $electionList -> fetch_row()){
                    if(($data1[2] < $currentDate ) || (($data1[2] == $currentDate )&&($data1[4]<=$currentTime))){

                    ?>
                    <script> var id = <?php echo(json_encode($data1[0])); ?>;</script>
                    <tr bgcolor="<?php echo $color?>" class="tableRow" id = <?php echo $data1[0] ?> href="viewElectionResults.php?electID=<?php echo $data1[0]?>">
                        <td class="tableData" ><?php echo $data1[1] ?> <span class="badge"><?php echo $value ?></span></td>
                        <td class="tableData" ><?php echo $data1[2] ?></td>
                        <td class="tableData" ><?php echo $data1[3] ?></td>
                        <td class="tableData" ><?php echo $data1[4] ?></td>
                    </tr>
                <?php
                        $color = "#99b3ff";
                        $value = "";
                    }
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
</body>
</html>