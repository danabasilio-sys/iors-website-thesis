<?php
    require_once 'init.php';
    require_once 'db_conn.php';
    if(isset($_POST['questionrequest'])  && $_POST['questionrequest'] === "post-game"){
        for($i = 10;$i < 20;$i++){
            $get_option = [];
            $question_arr[$i]['question'] = $_SESSION['questions'][$i]['question'];
            $sql = sprintf("SELECT *  FROM answers where question_id = '%s'",$_SESSION['questions'][$i]['question_id']);
            $res = mysqli_query($conn, $sql);
            while(($row = mysqli_fetch_assoc($res))) {
				$get_option[] = $row;
			}
            $ans_set = 0;
            foreach($get_option as $key=>$option){
                if($option['is_correct']==1){
                    $ans_set =$key;
                }
                $question_arr[$i]['choice'.($key+1)] = $option['answer'];
            }
            $question_arr[$i]["answer"] = $ans_set+1;
            $ans_set = 0;
        }
        echo json_encode($question_arr);
        exit();
    }
