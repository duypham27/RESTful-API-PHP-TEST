<?php

    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Methods: DELETE');        
    header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once('../../config/db.php');
    include_once('../../model/question.php');
    
    $db = new db();
    $connect = $db->connect();
    
    $question = new Question($connect);

    $data = json_decode(file_get_contents("php://input"));

    $question->id_ques = $data->id_ques;

    if($question->delete())
    {
        echo json_encode(array('message', 'Question Deleted'));
    }else{
        echo json_encode(array('message', 'Question Not Deleted'));
    }

?>