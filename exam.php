<?php
session_start();

include 'includes/config.php';
include 'includes/header.php';

$exam_id = $_GET['exam_id'];
$query = "SELECT * FROM questions WHERE exam_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Location: submit_answers.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Exam</title>
    <link rel="stylesheet" href="assets/css/styles.css">

</head>
<body>



    <form method="POST">
        <?php while ($row = $result->fetch_assoc()): ?>
            <p><?php echo $row['question_text']; ?></p>
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <label>
                    <input type="radio" name="answers[<?php echo $row['id']; ?>]" value="<?php echo $i; ?>">
                    <?php echo $row["option$i"]; ?>
                </label><br>
            <?php endfor; ?>
        <?php endwhile; ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
