<?php
session_start();

if (!isset($_SESSION['userr'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

<h1>Bem-vindo, <?php echo $_SESSION['userr']; ?>!</h1>

<a href="logout.php">Sair</a>

</body>
</html>