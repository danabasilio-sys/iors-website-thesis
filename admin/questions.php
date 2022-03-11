<?php
include('includes/header.php');
include('includes/functions.php');
if(isset($_GET['did'])){
    $did=$_GET['did'];
    $sql="SELECT * FROM `questions` WHERE `question_id`=$did";
    $res=$con->query($sql);
    $r=$res->fetch_assoc();
    $question=$r['question'];
    if(!$_SESSION['is_s_admin']) {
        if($r['admin_id'] !=$_SESSION['uid'])
        {
            ?>
            <script>
                window.location.href='questions.php';
            </script>
            <?php
            exit();
        }

    }
    $date=date('Y-m-d');
    $sql="UPDATE `questions` SET `deleted_at`='$date' WHERE `question_id`=$did";
    $res=$con->query($sql);
    if($res)
    {
        $action= 'Deleted Question: '.$question;
        logEntry($action,$_SESSION['uid'],$con);
        ?>
        <script>
            window.location.href='questions.php'
        </script>
        <?php
    }
}
?>
<div class="row pt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                <h3 class="card-title">Questions</h3>
                <a class="btn btn-sm btn-primary" href="addQuestions.php">Add new Question</a>
                </div>
            </div>
            <div class="card-body">
                <table id="tableTest" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 15%">Admin</th>
                        <th style="width: 60%">Question</th>
                        <th style="width:20%">Answer</th>
                        <th style="width: 20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $uid=$_SESSION['uid'];
                    $i=1;
                        $sql = "SELECT * FROM questions q INNER JOIN admin a ON a.id = q.admin_id INNER JOIN answers ans ON ans.question_id = q.question_id AND is_correct=1 WHERE q.deleted_at IS NULL AND a.deleted_at IS NULL ORDER BY q.question_id ASC";
                    $res=$con->query($sql);
                    while($r=$res->fetch_assoc())
                    {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $r['email']; ?></td>
                        <td><?php echo $r['question']; ?></td>
                        <td><?php echo $r['answer']; ?></td>
                        <td>
                            <a href="editQuestions.php?id=<?php echo $r['question_id']; ?>" class="btn btn-sm btn-primary <?php if(!$_SESSION['is_s_admin']){ if($r['id'] !=$uid){echo 'disabled';}} ?>"><i class="far fa-edit"></i></a>
                            <a href="questions.php?did=<?php echo $r['question_id'];?>" class="btn btn-sm btn-danger delete-confirm <?php if(!$_SESSION['is_s_admin']){ if($r['id'] !=$uid){echo 'disabled';}} ?>"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <script>
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You can retrieve this later",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        window.location.href=url
                    )
                }
            })
        });

    </script>

<?php
include('includes/footer.php')
?>
