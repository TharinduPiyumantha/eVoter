<?php
require_once '../core/init.php';

?>
<!-- Navigation -->
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">


        <ul class="nav navbar-nav side-nav">
            <?php
            $user = new User();
            if($user->hasPermission('administrator')){?>
                <li>
                    <a href="home.php"><i class="fa fa-fw fa-dashboard"></i>&nbsp;Home Page</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i
                            class="fa fa-fw fa-user"></i>&nbsp;Member Manage<i
                            class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo1" class="collapse">
                        <li>
                            <a href="../view/memberManage.php"><i class="fa fa-fw fa-user"></i>&nbsp;Member Manage</a>
                        </li>
                        <li>
                            <a href="../view/selectAdmin.php"><i class="fa fa-fw fa-user"></i>&nbsp;Admin Manage</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i
                            class="fa fa-fw fa-inbox"></i>&nbsp;Election Event<i
                            class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="../view/electionList.php"><i class="fa fa-fw fa-inbox"></i>&nbsp;View Elections</a>
                        </li>
                        <li>
                            <a href="../view/electionInterface.php"><i class="fa fa-fw fa-inbox"></i>&nbsp;Create Election</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="../view/newsfeed_index.php"><i class="fa fa-fw fa-newspaper-o"></i>&nbsp;News Feed</a>
                </li>
                <li>
                    <a href="../view/campaign_index.php"><i class="fa fa-fw fa-table"></i>&nbsp;Campaign</a>
                </li>

                <li>
                    <a href="../view/finishedElecList.php"><i class="fa fa-fw fa-area-chart"></i>&nbsp; Elections Results</a>
                </li>

            <?php }else {?>
                <li>
                    <a href="memberHome.php"><i class="fa fa-fw fa-dashboard"></i>&nbsp;Home Page</a>
                </li>
                <li>
                    <a href="memberview.php"><i class="fa fa-fw fa-user"></i>&nbsp;Members</a>
                </li>


            <li>
                <a href="../view/member_newsfeed.php"><i class="fa fa-fw fa-newspaper-o"></i>&nbsp;News Feed</a>
            </li>
            <li>
                <a href="../view/campaign_index.php"><i class="fa fa-fw fa-table"></i>&nbsp;Campaign</a>
            </li>

            <li>
                <a href="../view/currentElectionsList.php"><i class="fa fa-fw fa-check-square-o"></i>&nbsp;Vote</a>
            </li>
            <li>
                <a href="../view/finishedElecList.php"><i class="fa fa-fw fa-area-chart"></i>&nbsp; Elections Results</a>
            </li>
            <?php } ?>
        </ul>



       <!-- <ul class="nav navbar-nav side-nav">
            <?php
/*                if($user->hasPermission('administrator')){*/?>
                    <li>
                        <a href="home.php"><i class="fa fa-fw fa-dashboard"></i>Home Page</a>
                    </li>
              <?php /*}else {*/?>
                    <li>
                        <a href="memberHome.php"><i class="fa fa-fw fa-dashboard"></i>Home Page</a>
                    </li>
            <?php /*} */?>
            <li>
                <a href="memberManage.php"><i class="fa fa-fw fa-user"></i>Members</a>
            </li>
            <li>
                <a href="../view/newsfeed.php"><i class="fa fa-fw fa-table"></i>News Feed</a>
            </li>
			<?php
/*            $user = new User();
            if($user->hasPermission('administrator')){*/?>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i
                                class="fa fa-fw fa-arrows-v"></i>Election Event<i
                                class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="../view/electionList.php">View Elections</a>
                            </li>
                            <li>
                                <a href="../view/electionInterface.php">Create Election</a>
                            </li>

                        </ul>
                    </li>
            <?php /*}*/?>

            <li>
                <a href="tables.html"><i class="fa fa-fw fa-table"></i>Campaign</a>
            </li>
            <?php
/*            $user = new User();
            if(!($user->hasPermission('administrator'))){*/?>
                <li>
                    <a href="../view/currentElectionsList.php"><i class="fa fa-fw fa-table"></i>Vote</a>
                </li>
            <?php /*}*/?>

            <li>
                <a href="../view/finishedElecList.php"><i class="fa fa-fw fa-table"></i>Elections Results</a>
            </li>
        </ul>-->
    </div>
    <!-- /.navbar-collapse -->
