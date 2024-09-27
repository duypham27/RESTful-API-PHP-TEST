<?php
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json; charset=utf-8');
    
    include_once('../../config/db.php');
    include_once('../../model/question.php');

    $db = new db();
    $connect = $db->connect();

    $question = new Question($connect);
    $read = $question->read();


    $num = $read->rowCount();
    if($num > 0)
    {
        $question_array = [];
        $question_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $question_item = array(
                'id_question' => $id_ques,
                'title' => $title,
                'question_a' => $ques_a,
                'question_b' => $ques_b,
                'question_c' => $ques_c,
                'question_d' => $ques_d,
                'correct_answer' => $correct_ans

            );
            array_push($question_array['data'], $question_item);

        }
        // Sử dụng JSON_PRETTY_PRINT và JSON_UNESCAPED_UNICODE để đảm bảo không escape Unicode
        echo json_encode($question_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        // Trả về thông báo khi không có dữ liệu
        echo json_encode(['message' => 'No questions found'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

?>