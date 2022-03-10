<?php
include('includes/header.php');
include('includes/functions.php');
$question=null;
$answer1=null;
$answer2=null;
$answer3=null;
$answer4=null;
$correct= null;
$question_err=null;
$answer1_err=null;
$answer2_err=null;
$answer3_err=null;
$answer4_err=null;
$correct_err=null;
$yes=null;
$error=null;
if(isset($_POST['addquestion']))
{
   $validinput = true;
    $check = notOnlySpecialChars($_POST['question']);
    if($check['status'] === false){
        $validinput = false;
        $question_err = $check['message'];
    }
    $check = notOnlySpecialChars($_POST['answer1']);
    if($check['status'] === false){
        $validinput = false;
        $answer1_err = $check['message'];
    }
    $check = notOnlySpecialChars($_POST['answer2']);
    if($check['status'] === false){
        $validinput = false;
        $answer2_err = $check['message'];
    }
    $check = notOnlySpecialChars($_POST['answer3']);
    if($check['status'] === false){
        $validinput = false;
        $answer3_err = $check['message'];
    }
    $check = notOnlySpecialChars($_POST['answer4']);
    if($check['status'] === false){
        $validinput = false;
        $answer4_err = $check['message'];
    }
    if($validinput){
        $question=toggleSlash($_POST['question'], 'add');
        $answer1=toggleSlash($_POST['answer1'], 'add');
        $answer2=toggleSlash($_POST['answer2'], 'add');
        $answer3=toggleSlash($_POST['answer3'], 'add');
        $answer4=toggleSlash($_POST['answer4'], 'add');
        if(isset($_POST['answer'])) {
            $correct = $_POST['answer'];
        }
        $valid=true;
        if(empty($question))
        {
            $valid=false;
            $question_err="Question is required";
        }
        if(empty($answer1))
        {
            $valid=false;
            $answer1_err="Answer 1 is required";
        }
        if(empty($answer2))
        {
            $valid=false;
            $answer2_err="Answer 2 is required";
        }
        if(empty($answer3))
        {
            $valid=false;
            $answer3_err="Answer 3 is required";
        }
        if(empty($answer4))
        {
            $valid=false;
            $answer4_err="Answer 4 is required";
        }
        if($correct == null)
        {
            $valid =false;
            $correct_err="Please choose one correct answer";
        }
        if($valid)
        {
            $date=date('Y-m-d H:i:s');
            $admin=$_SESSION['uid'];
            $sql="SELECT * FROM `questions` WHERE `question` = '$question'";
            $res=$con->query($sql);
            if (($res->num_rows == 0)) {
                $sql = "INSERT INTO `questions`(`question`, `admin_id`, `created_at`, `updated_at`) VALUES ('$question',$admin,'$date','$date')";
                $res=$con->query($sql);
                if ($res === true ) {
                    $question_id = $con->insert_id;
                    for ($i = 1; $i <= 4; $i++) {
                        $its_correct = 0;
                        if ($i == $correct) {
                            $its_correct = 1;
                        }
                        $answer_temp=${'answer' . $i};
                        $sql = "INSERT INTO `answers`(`question_id`, `answer`, `is_correct`, `created_at`, `updated_at`) VALUES ($question_id,'$answer_temp',$its_correct,'$date','$date')";
                        $con->query($sql);
                    }
                    $action=' Added Question: '.$question;
                    logEntry($action,$_SESSION['uid'],$con);
                    $yes = "Question added successfully";
                } else {
                    $error = "Question addition error. Try again.";
                }
            }
            else
            {
                $question_err="Question already exists";
            }
        }
    }
}
?>
<div class="row pt-3">
    <div class="col-md-6 offset-md-3">
        <div class="card card-dark bg-dark text-white">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Add New Question</h3>
                    <a class="btn btn-sm btn-secondary" href="questions">Back</a>
                </div>
            </div>
            <form method="post" action="#">
                <div class="card-body">
                    <?php if($yes !=null ){ ?>
                    <p class="alert alert-success"><?php  echo $yes; ?></p>
                    <?php }
                    if($error !=null){
                    ?>
                    <p class="alert alert-danger"><?php  echo $error; ?></p>
                    <?php } 
                        $question=toggleSlash($question, 'remove');
                        $answer1=toggleSlash($answer1, 'remove');
                        $answer2=toggleSlash($answer2, 'remove');
                        $answer3=toggleSlash($answer3, 'remove');
                        $answer4=toggleSlash($answer4, 'remove');
                    ?>
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="question" name="question"  placeholder="Enter Question"  value="<?php echo $question; ?>">
                        <span class="text-danger"><?php echo $question_err; ?></span>
                    </div>
                    <div class="ml-4 mr-4">
                    <p class="mt-5">Add Answers</p>
                    <div class="form-group">
                        <label for="answer1">Answer 1</label>
                        <input type="text" class="form-control" id="answer1" placeholder="Answer 1" required name="answer1"  value="<?php echo $answer1; ?>">
                        <span class="text-danger"><?php echo $answer1_err; ?></span>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="radio" class="custom-control-input" id="rad_answer1" name="answer" value="1" <?php if($correct==1){echo 'checked';} ?>>
                            <label class="custom-control-label" for="rad_answer1">Correct Answer</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="answer2">Answer 2</label>
                        <input type="text" class="form-control" id="answer2" placeholder="Answer 2" required name="answer2"  value="<?php echo $answer2; ?>">
                        <span class="text-danger"><?php echo $answer2_err; ?></span>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="radio" class="custom-control-input" id="rad_answer2" name="answer" value="2" <?php if($correct==2){echo 'checked';} ?>>
                            <label class="custom-control-label" for="rad_answer2">Correct Answer</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="answer3">Answer 3</label>
                        <input type="text" class="form-control" id="answer3" placeholder="Answer 3" required name="answer3"   value="<?php echo $answer3; ?>">
                        <span class="text-danger"><?php echo $answer3_err; ?></span>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="radio" class="custom-control-input" id="rad_answer3" name="answer" value="3" <?php if($correct==3){echo 'checked';} ?>>
                            <label class="custom-control-label" for="rad_answer3">Correct Answer</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="answer4">Answer 4</label>
                        <input type="text" class="form-control" id="answer4" placeholder="Answer 4" required name="answer4"   value="<?php echo $answer4; ?>">
                        <span class="text-danger"><?php echo $answer4_err; ?></span>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="radio" class="custom-control-input" id="rad_answer4" name="answer" value="4" <?php if($correct==4){echo 'checked';} ?>>
                            <label class="custom-control-label" for="rad_answer4">Correct Answer</label>
                        </div>
                    </div>
                    <span class="text-danger"><?php echo $correct_err; ?></span>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" name="addquestion">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>
