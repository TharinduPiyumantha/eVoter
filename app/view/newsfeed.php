<?php
/**
 * Created by PhpStorm.
 * User: Dilushika
 * Date: 16/06/2016
 * Time: 11:52
 */
include "../templates/header.php";
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

$mysqli = new mysqli("localhost", "root", "", "evoter");

if(isset($_POST["submit"])) {
    if (isset($_POST["textArea"]) && !empty($_POST["textArea"])) {

        $textArea = $_POST['textArea'];

        mysqli_query($mysqli, "INSERT INTO newsfeed (news,attachment,news_Owner,Date_Time,electionID) VALUES ('abc','$textArea','D.S.Weerawardhana',NOW(),1111)");

    }
}
?>

<script>
    function _(e1){
        return document.getElementById(e1);
    }

    function uploadFile(){
        var file = _("file1").files[0];
        if(file == null){
            alert("You have to choose a file!");
        }

        else{
            //alert(file.name+" | "+file.size+" | "+file.type);
            var formdata = new FormData();
            formdata.append("file1",file);

            var ajax = new XMLHttpRequest();

            ajax.upload.addEventListener("progress",progressHandler,false);
            ajax.addEventListener("load",completeHandler,false);
            ajax.addEventListener("error",errorHandler,false);
            ajax.addEventListener("abort",abortHandler,false);

            ajax.open("POST","file_upload_parser.php");
            ajax.send(formdata);
            if (_("progressBar").style.display=='none'){
                _("progressBar").style.display ='block';
            }
        }
    }

    function progressHandler(event){
        _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
        var percent = (event.loaded / event.total) * 100;
        _("progressBar").value = Math.round(percent);
        alert(Math.round(percent)+"% uploaded...please wait")
        //_("status").innerHTML = Math.round(percent)+"% uploaded...please wait";
    }

    function completeHandler(event){
        _("upload_form").reset();
        //_("status").innerHTML = event.target.responseText;
        alert("Successfully updated!")
        _("progressBar").value = 0;

    }

    function errorHandler(event){
        alert("Upload failed!")
        //_("status").innerHTML = "Upload failed!";
    }

    function abortHandler(event){
        alert("Upload failed!")
        //_("status").innerHTML = "Upload failed!";
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

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> News Feed </h1>
                </div>
            </div>

            <div class="col-xs-8 col-md-8 col-sm-offset-3" style="margin-top: 80px;">

                <form class="form-horizontal" method="post" action="" id="upload_form" enctype="multipart/form-data">

                    <h4>To share your thoughts...</h4>
                    <fieldset>
                        <div class="form-group">
                            <div class="col-lg-10">
                                <textarea class="form-control" rows="3" id="textArea" name="textArea"></textarea>
                                <span class="help-block">What you feel, share your idea</span>
                                <br>
                                <input type="file" name="file1" id="file1" accept="image/*"><br>
                                <progress id="progressBar" value="0" max="100" style="width:300px;display:none;"></progress>
                                <br>
                                <button type="submit" name="submit" id="submit" class="btn btn-default btn-primary" value="post" onclick="uploadFile()">Post</button>
                            </div>
                        </div>


                        <div class="form-group">
                            <div  class="col-lg-10">
                                <h3 id="status"></h3>
                            </div>
                        </div>

                    </fieldset>
                </form>

            </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
