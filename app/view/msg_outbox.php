<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 04/07/2016
 * Time: 00:06
 */

 include "../templates/header.php";
require_once '../model/dbConfig.php';
?>


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
                    <h1 class="page-header"> My Outbox </h1>
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
                    $sql = "SELECT * FROM messages WHERE from_user = '' ";
                    $result = mysqli_query($con, $sql);
                    ?>

                    <form name="table" method="post" onsubmit="return validate();">
                        <input type="checkbox" onClick="toggle(this)" /> Select All<br/><br/>
                        <table class="table table_striped" id="table">

                            <div>
                                <div style="float:right;">
                                    <button class="btn btn-default btn-primary"  type="submit" id="remove" name="delete1" >Remove</button>
                                </div>
                                <div style="float:right;">
                                    <a href="msg_inbox.php" ><button class="btn btn-default btn-primary" type="submit"  name="outbox" id="outbox" style="width: 129px;">Inbox</button></a>
                                </div>
                                <div style="float:right;">
                                    <button class="btn btn-default btn-primary" type="button" data-toggle="modal" data-target="#NewMsg" name="new_message" style="width: 129px;">New Message</button>
                                </div>
                            </div>

                            <thead>
                            <tr>
                                <th></th>
                                <th>Time</th>
                                <th>Date</th>
                                <th>To</th>
                                <th>Message</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            while ($array = mysqli_fetch_row($result))
                            {?>
                                <td>" . "<input name='checkbox[]' type='checkbox' id='checkbox[]' class='box' value={$db_result[$i]->id}>"."</td>
                                <td><?php echo $array[1] ?></td>
                                <td><?php echo $array[2] ?></td>
                                <td><?php echo $array[3] ?></td>
                                <td><?php echo $array[8] ?></td>
                                <td type='button' name='view_msg' id='view_msg' data-toggle='modal' data-id='$db_msg' data-target='#ViewMsg'>View</td>

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
