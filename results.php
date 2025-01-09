<?php
include 'includes/config.php';
 include 'header.php';

session_start();

if (!isset($_SESSION['userID'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_SESSION['userID'];
$role = $_SESSION['role'];

// Fetch results for students or all results for admins
if ($role === 'admin') {
    $query = "
        SELECT 
            r.id, u.username, e.title AS exam_title, r.score
        FROM 
            results r
        JOIN 
            users u ON r.user_id = u.id
        JOIN 
            exams e ON r.exam_id = e.id
    ";
} else {
    $query = "
        SELECT 
            e.title AS exam_title, r.score
        FROM 
            results r
        JOIN 
            exams e ON r.exam_id = e.id
        WHERE 
            r.user_id = ?
    ";
}

$stmt = $conn->prepare($query);
if ($role !== 'admin') {
    $stmt->bind_param("i", $user_id);
}
$stmt->execute();
$results = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">


    <div class="container">
        <h2>Welcome to Your Dashboard</h2>
        <!-- Display logout link -->
        <a href="logout.php">Logout</a>
    </div>




        <h2>Exam Results</h2>
        <table border="1">
            <thead>
                <tr>
                    <?php if ($role === 'admin'): ?>
                        <th>Result ID</th>
                        <th>Username</th>
                        <th>Exam Title</th>
                        <th>Score</th>
                    <?php else: ?>
                        <th>Exam Title</th>
                        <th>Score</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $results->fetch_assoc()): ?>
                    <tr>
                        <?php if ($role === 'admin'): ?>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['exam_title']; ?></td>
                            <td><?php echo $row['score']; ?></td>
                        <?php else: ?>
                            <td><?php echo $row['exam_title']; ?></td>
                            <td><?php echo $row['score']; ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
