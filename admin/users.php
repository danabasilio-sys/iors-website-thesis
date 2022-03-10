<?php
include('includes/header.php');
include('includes/functions.php');
?>
<div class="row pt-3">
    <div class="col-12">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                <h3 class="card-title">User Information Log</h3>
                </div>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-dark table-striped table-hover">
                    <thead>
                    <tr>
                         <th style="width: 5%">#</th>
                        <th style ="width: 20%">Username</th>
                        <th style ="width: 10%">Age</th>
                        <th style ="width: 10%">Gender</th>
                        <th style ="width: 10%">Race</th>
                        <th style ="width: 15%">Pre-game Quiz Score</th>
                        <th style ="width: 15%">Post-game Quiz Score</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                         $uid=$_SESSION['uid'];
                         $i=1;
                         $sql="SELECT `username`, `age`, `gender`, `race`, `preGameScore`, `postGameScore` FROM `player_info`"; //decrypt username
                         $res=$con->query($sql);
                    while($r=$res->fetch_assoc())
                    {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <?php echo encrypt_decrypt($r['username'],'decrypt');?>
                            </td>
                            <td>
                                <?php echo $r['age'];?>
                            </td>
                            <td>
                                <?php echo $r['gender'];?>
                            </td>
                            <td>
                                <?php echo $r['race'];?>
                            </td>
                            <td>
                                <?php echo $r['preGameScore'];?>
                            </td>
                            <td>
                                <?php echo $r['postGameScore'];?>
                            </td>
                            
                        </tr>
                  <?php $i++;  }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php')
?>
