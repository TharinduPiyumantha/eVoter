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

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Create Election </h1>
        </div>
    </div>

<div class="election">
    <form class="form-horizontal" role="form" method="post" action="../controller/createElection.php">
        <div class="form-group">
            <label class="control-label col-sm-3" for="name">Election Name:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="elecName" name="elecName" placeholder="Enter election name" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="date">Date:</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" id="date" name="date" placeholder="Enter date" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="stime">Start Time:</label>
            <div class="col-sm-9">
                <input type="time" class="form-control" id="sTime" name="sTime" placeholder="Enter start time" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="etime">End Time:</label>
            <div class="col-sm-9">
                <input type="time" class="form-control" id="eTime" name="eTime" placeholder="Enter end time" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="noOfVotesPerson">Number of Votes Per Person:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="votes" name="votes" placeholder="Enter number of votes per person" required>
            </div>
        </div>
        <br><br>

            <div class="col-sm-6 col-sm-offset-11 controls" >
                <input name="submit" class="btn btn-default btn-primary" type="submit" id="evaluationCriteriaSaveBtn" value="Next >>"/>
            </div>
    </form>
</div>
</div>
        </div>
</div>
</body>
</html>
