<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Methods: POST');        
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once('../../config/db.php');
    include_once('../../model/question.php');
    
    $db = new db();
    $connect = $db->connect();
    
    $question = new Question($connect);
    $data = json_decode(file_get_contents("php://input"));
    $question->title = $data->title;
    $question->ques_a = $data->ques_a;
    $question->ques_b = $data->ques_b;
    $question->ques_c = $data->ques_c;
    $question->ques_d = $data->ques_d;
    $question->correct_ans = $data->correct_ans;

    if($question->create())
    {
        echo json_encode(array('message', 'Question Created'));
    }else{
        echo json_encode(array('message', 'Question Not Created'));
    }

?>