<?php
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
            "order": [[ 1, "desc" ],[2, "desc"]]
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
                    <h1 class="page-header"> Elections List </h1>
                </div>
            </div>

            <table id="electionTable" class="table">
                <thead>
                <tr bgcolor="#2952a3">
                    <th style="color:White">Election Name</th>
                    <th style="color:White">Date</th>
                    <th style="color:White">Start Time</th>
                    <th style="color:White">End Time</th>
                    <th style="color:White">Status</th>
                </tr>
                </thead>

                <tbody>
                    <?php
                        $election = new Election();
                        $electionList= $election->getElectionList((new DB_1)->connectToDatabase());
                        $currentDate = date("Y-m-d");
                        //echo $currentDate;
                        date_default_timezone_set("Asia/Colombo");
                        $currentTime = date("H:i:s");
                        //echo $currentTime;
                        $color = "";
                        $status = "";

                        while($data1 = $electionList -> fetch_row()){
                            if($currentDate < $data1[2]){
                                $color = "#99ccff";
                                $status = "Scheduled";
                            }else if($currentDate > $data1[2]){
                                $color = "#ff9999";
                                $status = "Finished";
                            }else if(($currentDate == $data1[2]) && (($data1[3]<=$currentTime)&&($data1[4]>=$currentTime))){
                                $color = "#99ff99";
                                $status = "On Going";
                            }else if(($currentDate == $data1[2]) && (($data1[3]>$currentTime)&&($data1[4]>$currentTime))){
                                $color = "#99ccff";
                                $status = "Scheduled";
                            }else if(($currentDate == $data1[2]) && (($data1[3]<$currentTime)&&($data1[4]<$currentTime))){
                                $color = "#ff9999";
                                $status = "Finished";
                            }
                    ?>
                <script> var id = <?php echo(json_encode($data1[0])); ?>;</script>
                <tr bgcolor="<?php echo $color?>" class="tableRow" id = <?php echo $data1[0] ?> href="viewElectionDetails.php?electID=<?php echo $data1[0]?>&status=<?php echo $status?>">
                    <td class="tableData" ><?php echo $data1[1] ?></td>
                    <td class="tableData" ><?php echo $data1[2] ?></td>
                    <td class="tableData" ><?php echo $data1[3] ?></td>
                    <td class="tableData" ><?php echo $data1[4] ?></td>
                    <td class="tableData" ><?php echo $status ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
</body>
</html>