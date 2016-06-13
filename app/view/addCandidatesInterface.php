<?php include "../templates/header.php";?>
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

            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
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
            <form class="form-horizontal" role="form" method="post" action="../controller/addCandidates.php?electID=<?php echo $_GET["electID"];?>">
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