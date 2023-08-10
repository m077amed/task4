<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$todos = [];

if (file_exists('todos.json')) {
    $todos = json_decode(file_get_contents('todos.json'), true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['task'])) {
        $newTask = $_POST['task'];
        $todos[] = $newTask;
        file_put_contents('todos.json', json_encode($todos));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... Existing code ...

    if (isset($_POST['remove'])) {
        $indexToRemove = $_POST['remove'];
        if (isset($todos[$indexToRemove])) {
            unset($todos[$indexToRemove]);
            // Reindex the array to remove any gaps in the keys
            $todos = array_values($todos);
            file_put_contents('todos.json', json_encode($todos));
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO App</title>
</head>

<body>
    <h1>Welcome, <?php echo $_SESSION['user']; ?>!</h1>
    <h2>Your TODO List:</h2>
    <ul>
        <?php foreach ($todos as $index => $task) : ?>
            <li>
                <?php echo $task; ?>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="remove" value="<?php echo $index; ?>">
                    <button type="submit">Remove</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <form method="POST">
        <input type="text" name="task" placeholder="Enter a new task" required><Br>
        <button type="submit">Add Task</button>
    </form>

    <center><br><a class="BTN" href="logout.php">Logout</a></center>
    <br>
</body>

</html>