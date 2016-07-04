<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 04/07/2016
 * Time: 00:05
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
                    <h1 class="page-header"> My Inbox </h1>
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
                    $sql = "SELECT * FROM messages WHERE to_user = '' ";
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
                                    <a href="msg_outbox.php" ><button class="btn btn-default btn-primary" type="submit"  name="outbox" id="outbox" style="width: 129px;">Outbox</button></a>
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
                                <th>From</th>
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
                                    <td><?php echo $array[4] ?></td>
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

            <!--pop up newmsg modal-->
            <div class="modal fade" id="NewMsg" role="dialog" action="" >
                <div class="modal-dialog">
                    <div>
                        <div class="col-lg-10 col-lg-offset-2 model_addnew">
                            <h4 style="color:white;text-align:left;">New Message</h4>
                            <form class="form-horizontal" action="../controller/send_msg.php"  data-toggle="validator" method="post" id="admin-adduser">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">To:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="to_user" id="to_user" placeholder="Receiver Name" list="exampleList">
                                        <datalist id="exampleList">
                                            <?php
                                            $sql2 = "SELECT * FROM clubmembers WHERE NIC <> '916191197v' ";
                                            $result2 = mysqli_query($con, $sql2);
                                            while ($array = mysqli_fetch_row($result2)) {
                                                echo $array[1];
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Message:</label>
                                    <div class="col-sm-8">
                                        <textarea name="msg" id="msg" class="form-control" placeholder="Text Message" COLS=50 ROWS=10 WRAP=SOFT value=""></TEXTAREA>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-sm-offset-7 controls">
                                    <button type="submit" id="send_btn" name="send_btn" class="btn btn-default btn-primary">
                                        <i class="fa fa-hand-o-right"></i>&nbsp;Send Message
                                    </button>
                                    <button type="button" name="btn-cancel" class="btn btn-default btn-primary" data-dismiss="modal">
                                        <i class="fa fa-ban"></i>&nbsp;Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end pop up new msg modal-->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

</html>
