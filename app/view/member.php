<?php include "../templates/header.php";?>

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
            <div class="col-lg-12">
                <div class="panel panel-countdown">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-clock-o fa-5x"></i>
                            </div>
                            <div class="col-xs-6">
                                <div class="huge-countdown">00:00:00</div>
                            </div>
                            <div class="col-xs-3 text-right" style="float: right;margin-top: 120px;">
                                <div>Count Down For Election</div>
                            </div>
                        </div>
                    <!--<a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">Election</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>-->
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user fa-fw"></i>Candidates</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-4">
                            <div class="candi_wrapper">
                                <img class="candidate" src="<?php echo SCRIPT_ROOT ?>/public/images/user-images/user1.jpg" alt="">
                                <div class="button">
                                    <a href="#" class="btn btn-default btn-align">Support</a>
                                    <a href="#" class="btn btn-default btn-align">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="candi_wrapper">
                                <img class="candidate" src="<?php echo SCRIPT_ROOT ?>/public/images/user-images/user1.jpg" alt="">
                                <div class="button">
                                    <a href="#" class="btn btn-default btn-align">Support</a>
                                    <a href="#" class="btn btn-default btn-align">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="candi_wrapper">
                                <img class="candidate" src="<?php echo SCRIPT_ROOT ?>/public/images/user-images/user1.jpg" alt="">
                                <div class="button">
                                    <a href="#" class="btn btn-default btn-align">Support</a>
                                    <a href="#" class="btn btn-default btn-align">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Tasks Panel</h3>
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
                            <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
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

<!-- jQuery -->
<script src="<?php echo SCRIPT_ROOT ?>/public/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo SCRIPT_ROOT ?>/public/js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo SCRIPT_ROOT ?>/public/js/plugins/morris/raphael.min.js"></script>
<script src="<?php echo SCRIPT_ROOT ?>/public/js/plugins/morris/morris.min.js"></script>
<script src="<?php echo SCRIPT_ROOT ?>/public/js/plugins/morris/morris-data.js"></script>

</body>

</html>
