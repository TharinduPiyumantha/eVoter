<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 8/4/2016
 * Time: 12:37 AM
 */
include "../templates/header.php";

require_once('../model/election.php');
require_once('../model/member.php');
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

$member = new Member();

$data = json_decode($_GET['memberIDs']);

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    function validateTable(){
        var tableLength = document.getElementById("candTable").rows.length - 1;
        var comment;
        var i;
        var commentBool = true;

        for(i=1;i<=tableLength;i++){
            comment = document.getElementById(i+"comment").value;

            if((/^[A-Za-z0-9 ]+$/.test(comment)) && !(/^[0-9 ]+$/.test(comment))){
                commentBool = commentBool && true;
            }else if((/^[A-Za-z0-9 _@./#&+-]+$/.test(comment)) && !(/^[0-9 _@./#&+-]+$/.test(comment))){
                commentBool = commentBool && true;
            }
            else{
                commentBool = commentBool && false;
            }
        }
        if(commentBool == false){
            alert("Please enter a valid comment");
            return false;
        }else{
            return true;
        }
    }
</script>
<script>
    function sendNotifications(){
        var tableLength = document.getElementById("candTable").rows.length - 1;
        var comment;
        var memberID;
        var memberType = "candidate";
        var electionID;
        var i;
        var commentBool = true;

        for(i=1;i<=tableLength;i++){
            comment = document.getElementById(i+"comment").value;

            if((/^[A-Za-z0-9 ]+$/.test(comment)) && !(/^[0-9 ]+$/.test(comment))){
                commentBool = commentBool && true;
            }else if((/^[A-Za-z0-9 _@./#&+-]+$/.test(comment)) && !(/^[0-9 _@./#&+-]+$/.test(comment))){
                commentBool = commentBool && true;
            }
            else{
                commentBool = commentBool && false;
            }
        }
        if(commentBool == false){
            alert("Please enter a valid comment");
        }else{
            for(i=1;i<=tableLength;i++){
                comment = document.getElementById(i+"comment").value;
                memberID = document.getElementById(i+"memID").value;
                electionID = <?php echo $_GET["electID"];?>;

                $.post("../controller/notiToRemovedCandsAndVoters.php",
                    {
                        electID:electionID,
                        memType:memberType,
                        commentSt:comment,
                        memID:memberID
                    }
                );


            }
            alert("Comments Were Sent To The Removed Candidates Successfully!");
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
                    <h1 class="page-header"> Reasons For Removing Candidates</h1>
                </div>
            </div>

            <br><br><br><br><br><br>
            <form class="form-horizontal" role="form" method="post" action="../view/editCandidatesInterface.php?electID=<?php echo $electionID ?>" enctype="multipart/form-data" onsubmit="return validateTable();">
                <table class="table table-striped" id="candTable">
                    <thead>
                    <tr bgcolor="#2952a3">
                        <th style="color:White;width:10%">Member ID</th>
                        <th style="color:White">Member Name</th>
                        <th style="color:White">Reason For Removing</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $memberID = "";
                    $i =1;
                    if(!empty($data)) {
                    foreach ($data as $mbrID) {
                        $memberID = $mbrID;
                        $array = $member->getMemberName($connection,$memberID);
                        $data = $array->fetch_row();
                        $mmbrName = $data[0];
                        ?>
                        <tr>
                            <td style="width:10px"><input type="text" id='<?php echo $i ."memID"?>' name= "memberID"  value="<?php echo $memberID?>" readonly style="border:none;width: 30%"/></td>
                            <td style="width:20px"><input type="text" id='<?php echo $i ."memName"?>' name= "memberName" value="<?php echo $mmbrName?>" readonly style="border:none"/></td>
                            <td style="width:50px"><input type="text" id='<?php echo $i ."comment"?>' name= 'comment' required style="width: 100%"/></td>
                        </tr>
                        <?php
                        $i = $i+1;

                    }}
                    ?>
                    </tbody>
                </table>
                <br><br><br><br><br><br>
                <div class="col-sm-3 col-sm-offset-9 controls">
                    <input type="button" value="Send Notifications" class="btn btn-default" id="sendNoti" onclick="sendNotifications()" />
                    <input class="btn btn-default btn-primary" name="submit" type="submit" id="addPartyImage" value="Next>>>"/>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

