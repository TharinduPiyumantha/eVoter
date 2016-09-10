<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 23/06/2016
 * Time: 18:15
 */

 include "../templates/header.php";
 include "../controller/userRequest.php";
 require_once '../model/dbConfig.php';
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}
?>

<script src="../../public/js/userRequest.js"></script>

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
                    <h1 class="page-header"> New Requests </h1>
                </div>
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                </div>
            </div>
            <!-- /.row -->

            <div>
                <div id="content" scrolling="yes">
                    <?php
                    $sql = "SELECT name,email,clubPost,nic FROM clubmember WHERE status = 'not-registered' ";
                    $result = mysqli_query($con, $sql);
                    ?>

                    <form name="table" method="post" onsubmit="return validate();">
                        <table class="table table_striped" id="table">

                            <thead>
                            <tr>
                                <th>NIC</th>
                                <th>Member Name</th>
                                <th>Email</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            while ($array = mysqli_fetch_row($result))
                            {
                                echo
                                "<tr>
              <td>{$array[0]}</td>
              <td>{$array[1]}</td>
              <td>{$array[2]}</td>
              <td><input type='submit' data-id='{$array[3]}'>Accept</td>
              <td type='submit' data-id='{$array[3]}'>Reject</td>
             </tr>\n";
                            }
                            ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
if (isset($_POST['action'])) {
    echo '<br />The ' . $_POST['submit'] . ' submit button was pressed<br />';
}
?>
</body>

</html>
