<?php include "../templates/header.php";
/**
* Created by PhpStorm.
* User: ShalikaFernando
* Date: 6/15/2016
* Time: 8:59 AM
*/

require_once('../model/election.php');
require_once('../model/DB_1.php');
$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

$db= new DB();
$connection = $db->connectToDatabase();
$election = new Election();

?>
<script>

    function addRow(tableID) {

        var table = document.getElementById(tableID);

        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);

        var cell1 = row.insertCell(0);
        var element1 = document.createElement("input");
        element1.type = "checkbox";
        element1.name="chkbox[]";
        cell1.appendChild(element1);

        var cell2 = row.insertCell(1);
        cell2.innerHTML = "<input type='text' name='memberName[]' required>";

        var cell3 = row.insertCell(2);
        cell3.innerHTML = "<input type='text'  name='memberID[]' required/>";

        var cell4 = row.insertCell(3);
        cell4.innerHTML =  "<input type='text'  name='candNo[]' required/>";

        var cell5 = row.insertCell(4);
        cell5.innerHTML =  "<input type='submit'  name='browse[]' value='Browse' required/>";
    }

    function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            //alert("Are you sure you want to delete the selected row?");
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkboxname = row.cells[0].childNodes[0].name;
                var chkbox = row.cells[0].childNodes[0];
                var memID = chkboxname;
                var eID = '<?php echo $electionID; ?>';
                //alert(memID);
                //alert(eID);
                if (null != chkbox && true == chkbox.checked) {
                    $(document).ready(
                        function () {

                            $.post("deleteRowData.php",
                                {
                                    memberID: memID,
                                    electID: eID

                                },
                                function (data) {

                                }

                            );

                        }

                    );
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
        }catch(e) {
            alert(e);
        }
    }
</script>
<body>

<div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top color-change" role="navigation" >
        <?php include "../templates/topmenu.php";
        include "../templates/sidemenu.php";
        ?>
    </nav>

    <div id="page-wrapper">

        <div class="container">
            <h2>Create Election</h2>
            <form class="form-horizontal" role="form" method="post" action="#">
                <div class="container">
                    <label class="control-label col-sm-2" for="addCandidates">Add Candidates:</label>

                    <INPUT type="button" id="add" value="Add Row" onClick="addRow('dataTable')" />

                    <INPUT type="button" id="remove" value="Delete Row" onClick="deleteRow('dataTable')" /> <br><br>

                    <table width="83%" border="1" align="center" class="table-striped" id="tableCommon">
                        <thead>
                        <tr>
                            <th width="5%" scope="col"></th>
                            <th width="30%" scope="col">Member Name</th>
                            <th width="20%" scope="col">Member ID</th>
                            <th width="20%" scope="col">Candidate Number</th>
                            <th width="30%" scope="col">Image of Party</th>
                        </tr>
                        </thead>
                        <tbody id="dataTable">
                        <?php
                        $candidateList= $election->getCandidateDetails($connection,$electionID);
                        while($data1 = $candidateList -> fetch_row()) {
                            ?>
                            <tr>
                                <td><input name="<?php echo $data1[1] ?>" id=<?php echo $data1[0] ?> class="CheckBoxSchedule" type="checkbox"/></td>
                                <td><input type="text" value=" <?php echo $data1[0] ?>" name="<?php echo $data1[0] ?>"/></td>
                                <td><input type="text" value=" <?php echo $data1[1] ?>" name="<?php echo $data1[1] ?>" readonly/></td>
                                <td><input type="text" value=" <?php echo $data1[2] ?>" name="<?php echo $data1[2] ?>"/></td>
                                <td><input type="submit" value="<?php echo $data1[3] ?>" name="<?php echo $data1[3] ?>"/></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <br><br>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input name="submit" type="submit" id="addCandidatesBtn" value="Next>>>"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>