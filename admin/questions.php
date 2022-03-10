<?php
include('includes/header.php');
include('includes/functions.php');
if(isset($_GET['did'])){
    $did=$_GET['did'];
    $sql="SELECT * FROM questions q INNER JOIN admin a ON a.id=q.admin_id WHERE q.question_id=$did";
    $res=$con->query($sql);
    $r=$res->fetch_assoc();
    $question=$r['question'];
    $can=canManageQuestion($r['admin_role'],$r['admin_id']);
    if(!$can) {

            ?>
            <script>
                window.location.href='questions';
            </script>
            <?php
            exit();


    }
    $date=date('Y-m-d');
    $sql="UPDATE `questions` SET `deleted_at`='$date' WHERE `question_id`=$did";
    $res=$con->query($sql);
    if($res)
    {
        $action= 'Archived Question: '.$question;
        logEntry($action,$_SESSION['uid'],$con);
        ?>
        <script>
            window.location.href='questions'
        </script>
        <?php
    }
}
?>
<style>

</style>
<div class="row pt-3">
    <div class="col-12">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                <h3 class="card-title">Questions</h3>
                <a class="btn btn-sm btn-primary" href="addQuestions">Add New Question</a>
                </div>
            </div>
            <div class="card-body">
                <table id="tabletest" class="table table-dark table-striped">
                    <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 15%">Admin</th>
                        <th style="width: 60%">Question</th>
                        <th style="width: 20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $uid=$_SESSION['uid'];
                    $i=1;
                        $sql = "SELECT * from questions q INNER join admin a ON a.id=q.admin_id WHERE q.deleted_at IS NULL AND a.deleted_at IS NULL  ORDER BY q.question_id ASC";
                    $res=$con->query($sql);
                    while($r=$res->fetch_assoc())
                    {
                     $can_do=canManageQuestion($r['admin_role'],$r['admin_id']);
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $r['email']; ?></td>
                        <td><?php echo $r['question']; ?></td>
                        <td class="d-flex">
                            <a href="editQuestions?id=<?php echo $r['question_id']; ?>" class="btn btn-sm btn-primary <?php if(!$can_do){echo 'disabled';} ?>"><i class="far fa-edit"></i></a>
                            <a href="questions?did=<?php echo $r['question_id'];?>" class="btn btn-sm ml-1 btn-danger delete-confirm <?php if(!$can_do){echo 'disabled';} ?>"><i class="fas fa-trash-alt"></i></a>
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
                    window.location.href=url
                }
            })
        });

    </script>

<?php
include('includes/footer.php')
?>
