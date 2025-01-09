<?php
include 'includes/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $answers = $_POST['answers'];
    $score = 0;

    foreach ($answers as $question_id => $selected_option) {
        $query = "SELECT correct_option FROM questions WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['correct_option'] == $selected_option) {
            $score++;
        }
    }

    $user_id = $_SESSION['user_id'];
    $exam_id = $_POST['exam_id'];
    $query = "INSERT INTO results (user_id, exam_id, score) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $user_id, $exam_id, $score);
    $stmt->execute();

    echo "Your score: $score";
}
?>
