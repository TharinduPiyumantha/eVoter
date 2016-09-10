<?php
require_once('../core/init.php');
include "../templates/header.php";

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 6/7/2016
 * Time: 4:17 PM
 */
require_once('../model/election.php');
require_once('../model/candidate.php');
require_once('../model/DB_1.php');
$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}
//echo $electionID;
$db= new DB_1();
$connection = $db->connectToDatabase();

?>

<script>
    function validateTable(){
        var tableLength = document.getElementById("candTable").rows.length - 1;
        var candNo;
        var imgType;
        var i;
        var candBool = true;
        var imgBool = true;
        var candidateNo = [];
        var imagesType = [];

        for(i=1;i<=tableLength;i++){
            candNo = document.getElementById(i+"cand").value;
            imgType = document.getElementById(i+"img").value;

            candidateNo.push(candNo);
            imagesType.push(imgType);

            if( (candNo == 0) || (candNo < 0) || (candNo % 1 != 0)){
                candBool = candBool && false;
            }else if(!(imgType.includes(".jpg")) && !(imgType.includes(".png")) && !(imgType.includes(".jpeg"))){
                imgBool = imgBool && false;
            }else{
                candBool = candBool && true;
                imgBool = imgBool && true;
            }
        }
        if(candBool == false){
            alert("Candidate Number Shoud Be A Positive Integer!");
            return false;
        }else if(imgBool == false){
            alert("Candidate Symbol Type Should Be .jpg or .png or .jpeg");
            return false;
        }else{
                loop1:
                for(var i = 0; i <= candidateNo.length; i++) {
                    loop2:
                    for(var j = i; j <= candidateNo.length; j++) {
                        if(i != j && candidateNo[i] == candidateNo[j]) {
                            alert("Duplicated Candidate Numbers! Please assign unique candidate number for each candidate!");
                            return false;
                            break loop1;
                        }else if(i != j && imagesType[i] == imagesType[j]){
                            alert("Duplicated Candidate Symbols! Please assign unique candidate symbol for each candidate!");
                            return false;
                            break loop1;
                        }
                    }
                }
                alert("Candidate Numbers And Symbols Are Added Successfully!");
                return true;

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
                    <h1 class="page-header"> Candidate Details </h1>
                </div>
            </div>

            <br><br><br><br><br>
            <form class="form-horizontal" role="form" method="post" action="../controller/uploadPartyImage.php?electID=<?php echo $electionID ?>" enctype="multipart/form-data" onsubmit="return validateTable();">
                <table class="table table-striped" id="candTable">
                    <thead>
                    <tr bgcolor="#2952a3">
                        <th style="color:White">Member Name</th>
                        <th style="color:White">Member ID</th>
                        <th style="color:White">Candidate No</th>
                        <th style="color:White">Candidate Symbol</th>
                        <th style="color:White"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $candidateList= (new Candidate)->getCandidatesDetails($connection,$electionID);
                    $id = 1;
                    while($data1 = $candidateList -> fetch_row()) {
                        ?>
                        <tr>
                            <td><?php echo $data1[0] ?></td>
                            <td><input type="text" id='<?php echo $id ."mem"?>' name= "memberID[]"  value="<?php echo $data1[1]?>" readonly style="border:none"/></td>
                            <td><input type="text" id='<?php echo $id."cand"?>' name= 'candNo[]' required/></td>
                            <td><input type="file" id='<?php echo $id."img"?>' name= 'imgPath[]'  required/></td>
                        </tr>
                    <?php
                        $id=$id+1;
                    }
                    ?>
                    </tbody>
                </table>
                <br><br>
                <div class="col-sm-4 col-sm-offset-8 controls">
                    <input type="button" value="<<< Back" class="btn btn-default" id="backToElection" onClick="document.location.href='addNewCandidates.php?electID=<?php echo $_GET["electID"];?>'" />
                    <input type="button" value="Cancel" class="btn btn-default" id="cancelElection" onClick="document.location.href='electionList.php'" />
                    <input class="btn btn-default btn-primary" name="submit" type="submit" id="addPartyImage" value="Next>>>"/>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

