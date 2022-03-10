<?php
include('includes/header.php');
include('includes/functions.php');
?>
<div class="row pt-3">
    <div class="col-12">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <h3 class="card-title">Answers</h3>
            </div>
            <div class="card-body">
                <table id="tabletest" class="table table-dark table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Admin</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Correct</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $uid=$_SESSION['uid'];
                    $i=1;
                        $sql = "SELECT * from answers a INNER JOIN questions q on a.question_id=q.question_id INNER JOIN admin ad on ad.id=q.admin_id WHERE q.deleted_at IS NULL AND ad.deleted_at IS NULL   ORDER BY q.question_id ASC";
                    $res=$con->query($sql);
                    while($r=$res->fetch_assoc())
                    {
                        $can_do=canManageQuestion($r['admin_role'],$r['admin_id']);
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $r['email']; ?></td>
                            <td><?php echo $r['question']; ?></td>
                            <td><?php echo $r['answer']; ?></td>
                            <td>
                                <?php if($r['is_correct'] == 1){ ?>
                                <span class="badge badge-success">Yes</span>
                                <?php } else { ?>
                                <span class="badge badge-danger">No</span>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="editQuestions?id=<?php echo $r['question_id'];  ?>" class="btn btn-sm btn-primary <?php if(!$can_do){ echo 'disabled';} ?>"><i class="far fa-edit"></i></a>
                            </td>
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
