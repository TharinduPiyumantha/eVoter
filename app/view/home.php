<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 16/06/2016
 * Time: 11:52
 */
 include "../templates/header.php";
 include "../controller/userRequest.php";
include "../controller/electionNo.php";
require_once '../model/dbConfig.php';
?>
<!--
<script src="../../public/js/userRequest.js"></script>
<script src="../../public/js/electionsNo.js"></script>-->
<script src="../countdown.js"></script>

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
                    <h1 class="page-header"> Home Page </h1>
                </div>
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-inbox fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo "$no_of_elections"?></div>
                                    <div>Elections</div>
                                </div>
                            </div>
                        </div>
                        <a href="viewElectionDetails.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Election Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-8">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">

                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                        <script type="application/javascript">

                                            function doneHandler(result){

                                                //alert("Complete");
                                            }

                                            function myTime (time) {
                                                var time=parseInt(time);
                                                // body...

                                                var myCountdown1 = new Countdown({
                                                    time: time, // 86400 seconds = 1 day
                                                    width:460,
                                                    height:110,
                                                    rangeHi:"day",
                                                    style:"flip",   // <- no comma on last item!
                                                    onComplete: doneHandler
                                                });

                                            }
                                            var sampleDate = new Date("2016-07-01T02:13:46Z");
                                            //alert(sampleDate);
                                            myTime(1000);

                                        </script>
                                    </div>
                                    <!--<div>New Tasks</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" id="memberRequest"><?php echo "$new_requests"?></div>
                                    <div>Member Requests</div>
                                </div>
                            </div>
                        </div>
                        <a href="userRequests.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Requests</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-users fa-fw"></i>&nbsp; Candidates</h3>
                        </div>
                        <div class="panel-body">

                            <?php
                            $currentDate = date("Y-m-d");
                            $sql = "SELECT MIN(date),electionID FROM election WHERE date < '$currentDate'";
                            $result = mysqli_query($con, $sql);

                            while ($array = mysqli_fetch_row($result))
                            {
                                $electionDate=$array[0];
                                $electionID= $array[1];

                                $sql1 = "SELECT memberID,candidateNo,symbolImage FROM candidate WHERE electionID = '$electionID'";
                                $result1 = mysqli_query($con, $sql1);

                            while ($array1 = mysqli_fetch_row($result1)) {
                                $candidatememberID = $array1[0];
                                $candidatecandidateNo = $array1[1];
                                $candidatesymbol = $array1[2];

                                $sql2 = "SELECT * FROM clubmember WHERE memberID = '$candidatememberID'";
                                $result2 = mysqli_query($con, $sql2);

                                while ($array2 = mysqli_fetch_row($result2)) {
                                    $candidatename = $array2[1];
                                    ?>

                                    <div class="col-lg-4">
                                        <div class="candi_wrapper">
                                            <img class="candidate"
                                                 src="<?php echo SCRIPT_ROOT ?>/public/images/user-images/user1.jpg"
                                                 alt="">
                                            Name:<label
                                                style="color: #004580;text-align: center;"><?php echo $candidatename ?></label>
                                            <br>
                                            Candidate No. <label
                                                style="color: #004580;text-align: center;"><?php echo $candidatecandidateNo ?></label>
                                            <!--<img class="candidate"
                                                 src="<?php /*$candidatesymbol*/?>"
                                                 alt="">-->
                                        </div>

                                        <div class="button">
                                            <a href="profile.php?value=<?php echo $candidatememberID ?>">
                                                <button type="button" name="btn-view"
                                                        class="btn btn-default btn-primary"
                                                        style="float: right;">
                                                    <i class="fa fa-hand-o-right"></i>&nbsp;View
                                                </button>
                                            </a>
                                        </div>
                                    </div>

                                <?php
                                }
                            }
                            }
                            ?>

                            </div>
                        </div>
                    </div>


                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-newspaper-o fa-fw"></i>&nbsp; News Feed</h3>
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <span class="badge">just now</span>
                                    <i class="fa fa-fw fa-calendar"></i> Calendar updated
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">4 minutes ago</span>
                                    <i class="fa fa-fw fa-comment"></i> Commented on a post
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">1 hour ago</span>
                                    <i class="fa fa-fw fa-user"></i> A new user has been added
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">yesterday</span>
                                    <i class="fa fa-fw fa-globe"></i> Saved the world
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">two days ago</span>
                                    <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                                </a>
                            </div>
                            <div class="text-right">
                                <a href="news_feed.php">View All News <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

</body>

</html>
