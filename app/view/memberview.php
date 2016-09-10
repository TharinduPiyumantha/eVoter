<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 16/06/2016
 * Time: 17:19
 */

include "../templates/header.php";
require_once '../model/dbConfig.php';
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

?>
<script type="text/javascript">
    <!-- clickable raws-->
    $(document).ready(function(){
        $('.tableRow').click(function(){
            window.location = $(this).attr('href');
            return false;
        });
    });
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
                    <h1 class="page-header"> Members </h1>
                </div>
            </div>

            <div>
                <div id="content" scrolling="yes">
                    <?php
                    $user = new User();
                    $current_user = $user->data()->memberID;
                    $sql = "SELECT * FROM clubmember WHERE status = 'registered' AND memberID != '$current_user' ";
                    $result = mysqli_query($con, $sql);
                    ?>

                    <form name="table" method="post" onsubmit="return validate();">
                        <table class="table table_striped" id="table">

                            <thead>
                            <tr>
                                <th>Member ID</th>
                                <th>Member Name</th>
                                <th>NIC</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Club Post</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            while ($array = mysqli_fetch_row($result))
                            {?>


                                <tr class='tableRow' id = <?php echo $array[0] ?> href='profile.php?value=<?php echo $array[0]?>'>

                                    <td><?php echo $array[0] ?></td>
                                    <td><?php echo $array[1] ?></td>
                                    <td><?php echo $array[2] ?></td>
                                    <td><?php echo $array[3] ?></td>
                                    <td><?php echo $array[4] ?></td>
                                    <td><?php echo $array[5] ?></td>
                                </tr>
                            <?php }
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

</body>

</html>
