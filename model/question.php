<?php

    class Question
    {
        private $conn;

        // Question properties
        public $id_ques;
        public $title;
        public $ques_a;
        public $ques_b;
        public $ques_c;
        public $ques_d;
        public $correct_ans;

        // Connect DB
        public function __construct($db)
        {
            $this->conn = $db;
        }

        // Read Data
        public function read()
        {
            $query = "SELECT * FROM questions ORDER BY id_ques DESC";
            //statement
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

         // Show Data
         public function show()
         {
             $query = "SELECT * FROM questions WHERE id_ques=? LIMIT 1";
             //statement
             $stmt = $this->conn->prepare($query);
             $stmt->bindParam(1, $this->id_ques);
             $stmt->execute();
             
             $row = $stmt->fetch(PDO::FETCH_ASSOC);   
             
             $this->title = $row['title'];
             $this->ques_a = $row['ques_a'];
             $this->ques_b = $row['ques_b'];
             $this->ques_c = $row['ques_c'];
             $this->ques_d = $row['ques_d'];
             $this->correct_ans = $row['correct_ans'];
        
         }

         // Create Data
         public function create()
         {
            $query = "INSERT INTO questions SET 
                    title=:title, 
                    ques_a=:ques_a, 
                    ques_b=:ques_b, 
                    ques_c=:ques_c, 
                    ques_d=:ques_d, 
                    correct_ans=:correct_ans";

            $stmt = $this->conn->prepare($query);

            // Clean Data (Bỏ ký tự đặc biệt hoặc không mong muốn)
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->ques_a = htmlspecialchars(strip_tags($this->ques_a));
            $this->ques_b = htmlspecialchars(strip_tags($this->ques_b));
            $this->ques_c = htmlspecialchars(strip_tags($this->ques_c));
            $this->ques_d = htmlspecialchars(strip_tags($this->ques_d));
            $this->correct_ans = htmlspecialchars(strip_tags($this->correct_ans));

            // Bind Data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':ques_a', $this->ques_a);
            $stmt->bindParam(':ques_b', $this->ques_b);
            $stmt->bindParam(':ques_c', $this->ques_c);
            $stmt->bindParam(':ques_d', $this->ques_d);
            $stmt->bindParam(':correct_ans', $this->correct_ans);

            if($stmt->execute())
            {
                return true;
            }
            printf("Error %s.\n", $stmt->error);
            return false;
         }


         // Update Data
         public function update()
         {
            $query = "UPDATE questions SET title=:title, ques_a=:ques_a, ques_b=:ques_b, ques_c=:ques_c, ques_d=:ques_d, correct_ans=:correct_ans WHERE id_ques=:id_ques";

            $stmt = $this->conn->prepare($query);

            // Clean Data (Bỏ ký tự đặc biệt hoặc không mong muốn)
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->ques_a = htmlspecialchars(strip_tags($this->ques_a));
            $this->ques_b = htmlspecialchars(strip_tags($this->ques_b));
            $this->ques_c = htmlspecialchars(strip_tags($this->ques_c));
            $this->ques_d = htmlspecialchars(strip_tags($this->ques_d));
            $this->correct_ans = htmlspecialchars(strip_tags($this->correct_ans));
            $this->id_ques = htmlspecialchars(strip_tags($this->id_ques));

            // Bind Data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':ques_a', $this->ques_a);
            $stmt->bindParam(':ques_b', $this->ques_b);
            $stmt->bindParam(':ques_c', $this->ques_c);
            $stmt->bindParam(':ques_d', $this->ques_d);
            $stmt->bindParam(':correct_ans', $this->correct_ans);
            $stmt->bindParam(':id_ques', $this->id_ques);

            if($stmt->execute())
            {
                return true;
            }
            printf("Error %s.\n", $stmt->error);
            return false;
         }


         // Delete Data
         public function delete()
         {
            $query = "DELETE FROM questions WHERE id_ques=:id_ques";
            $stmt = $this->conn->prepare($query);

            // Clean Data (Bỏ ký tự đặc biệt hoặc không mong muốn)
            $this->id_ques = htmlspecialchars(strip_tags($this->id_ques));

            // Bind Data
            $stmt->bindParam(':id_ques', $this->id_ques);

            if($stmt->execute())
            {
                return true;
            }
            printf("Error %s.\n", $stmt->error);
            return false;
         }

         

    }

?>