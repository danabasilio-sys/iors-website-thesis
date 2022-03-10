<?php
include('includes/header.php');
include('includes/functions.php');

        if(!$_SESSION['is_s_admin'] && !$_SESSION['is_admin'])
        {
            ?>
            <script>
                window.location.href='index';
            </script>
            <?php
            exit();
        }
?>
<div class="row pt-3">
    <div class="col-12">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                <h3 class="card-title">Audit Log</h3>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-dark table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Admin</th>
                        <th>Browser</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    //to decrypt in mysql
                    //SELECT AES_DECRYPT(a.action,UNHEX('F3229A0B371ED2D9441B830D21A390C3')) as action, AES_DECRYPT(a.date_created,UNHEX('F3229A0B371ED2D9441B830D21A390C3')) as datee , AES_DECRYPT(a.browser,UNHEX('F3229A0B371ED2D9441B830D21A390C3')) as browser, ad.first_name, ad.last_name, a.audit_id from audit_log a INNER join admin ad on a.admin_id=ad.id ORDER BY a.audit_id DESC;
                    $key='F3229A0B371ED2D9441B830D21A390C3';
                    $uid=$_SESSION['uid'];
                    $i=1;
                        $sql = "SELECT AES_DECRYPT(a.action,UNHEX('$key')) as action, AES_DECRYPT(a.date_created,UNHEX('$key')) as datee , AES_DECRYPT(a.browser,UNHEX('$key')) as browser, ad.first_name, ad.last_name, a.audit_id from audit_log a INNER join admin ad on a.admin_id=ad.id ";
                    $res=$con->query($sql);
                    while($r=$res->fetch_assoc())
                    {
                    ?>
                    <tr>
                        <td><?php echo $r['datee']; ?></td>
                        <td><?php echo $r['first_name'].' '.$r['last_name']; ?></td>
                        <td><?php echo $r['browser']; ?></td>
                        <td><?php echo $r['action']; ?></td>
                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php')
?>
