<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json; charset=utf-8');
        
    include_once('../../config/db.php');
    include_once('../../model/question.php');
    
    $db = new db();
    $connect = $db->connect();
    
    $question = new Question($connect);

    $question->id_ques = isset($_GET['id']) ? $_GET['id'] : die;

    $question->show();

    $question_item = array(
        'id_question' => $question->id_ques,
        'title' => $question->title,   
        'question_a' => $question->ques_a,
        'question_b' => $question->ques_b,
        'question_c' => $question->ques_c,
        'question_d' => $question->ques_d,
        'correct_answer' => $question->correct_ans
    );

    //print_r(json_encode($question_item));
    echo json_encode($question_item, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
    
    

?>