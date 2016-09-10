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
require_once("../model/ballotPaper.php");

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

$db = new DB_1();
$connection = $db->connectToDatabase();

$electID="";
if(isset($_GET["electID"])){
    $electID=$_GET["electID"];
}

if(isset($_GET["attempts"])){
    $remain_attempt=$_GET["attempts"];
    //echo $remain_attempt;
}else{
    $remain_attempt = 3;
}
?>

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
            "order": [[ 2, "desc" ]]
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
<?php
$user = new User();
$ballot = new BallotPaper();

$userID = $user->data()->memberID;
$attempts = $ballot->getUserSecurityPin($connection,$userID);
$attempts1 = $attempts->fetch_row();
$attempts2 = $attempts1[1];
?>

<script>
    var remain_attempt ='<?php echo $remain_attempt; ?>';

    if (remain_attempt == 0){
        alert("sorry you have exceeded maximum number of attempts");
        window.location = "home.php";
    }
    else if (remain_attempt < 3){
        alert("Sorry the answers are incorrect. You have remaining : "+remain_attempt+ " attempts");
    }
</script>

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
                    <h1 class="page-header"> Security Questions </h1>
                </div>
            </div>
            <div id="answer-form">
                <form class="form-horizontal" id="answerform" name="answerform" action="../controller/securityQuestions.php?electID=<?php echo $electID; ?>" role="form" method="post"
                      style="margin-top: 30px;margin-right: 40px;" onsubmit="return checkAttempts();">

                    <?php
                    $user = new User();
                    $ballot = new BallotPaper();

                    $questionsArray = $ballot->getUserSecurityQuestions($connection,$user->data()->memberID);
                    while ($array = mysqli_fetch_row($questionsArray)) {
                        ?> <br>
                        <?php echo $array[0]; ?>

                        <input type="hidden" name="qid[]" value="<?php echo $array[1]; ?> ">
                        <input type="text" name="answer[]" style="color: #000000;width: 300px;"><br><br>
                    <?php

                    }
                    ?>



                    <div class="col-sm-5 col-sm-offset-7 controls" style="margin-top: 40px;margin-left: 270px;width: 330px;padding-right: 15px;">

                        <button type="submit" id="btn-submit" name="btn-submit" class="btn btn-default btn-primary">
                            <i class="fa fa-thumbs-o-up"></i>&nbsp;SUBMIT
                        </button>

                    </div>

                </form>
            </div>


        </div>
    </div>
</div>
</body>
</html>