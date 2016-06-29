<?php include "../templates/header.php";
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
            <br>

            <form class="form-horizontal" role="form" method="post" action="../controller/uploadPartyImageNewCandidates.php?electID=<?php echo $electionID ?>" enctype="multipart/form-data">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Member Name</th>
                        <th>Member ID</th>
                        <th>Candidate No</th>
                        <th>Image Of Party</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $candidateList= (new Candidate)->getCandWithoutSymbol($connection, $electionID);
                    while($data1 = $candidateList -> fetch_row()) {
                        ?>
                        <tr>
                            <td><?php echo $data1[0] ?></td>
                            <td><input type="text" id='<?php echo $data1[1]."member" ?>' name= "memberID[]"  value="<?php echo $data1[1]?>" readonly /></td>
                            <td><input type="text" id='<?php echo $data1[1]."CandNo" ?>' name= 'candNo[]' required/></td>
                            <td><input type="file" id='<?php echo $data1[1]."ImgPath" ?>' name= 'imgPath[]' required /></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div class="col-sm-6 col-sm-offset-11 controls">
                    <input class="btn btn-default btn-primary" name="submit" type="submit" id="addPartyImage" value="Next>>>"/>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

