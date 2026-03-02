<?php
require $_SERVER['DOCUMENT_ROOT'] . '/pagcadastro/config/conexao.php';

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST['userr']) || !isset($_POST['passwor'])) {
        $mensagem = "Dados não enviados.";
    } else {

        $userr   = $_POST['userr'];
        $passwor = $_POST['passwor'];

        $sql = "SELECT id FROM usuarios WHERE userr = :userr";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userr', $userr);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $mensagem = "Esse usuário já existe!";
        } else {


            $sql = "INSERT INTO usuarios (userr, passwor)
            VALUES (:userr, :passwor)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userr', $userr);
            $stmt->bindParam(':passwor', $passwor);
            $stmt->execute();

            $mensagem = "Cadastro realizado com sucesso!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/pagcadastro/public/assets/estilo.css">
</head>

<body>

    <div class="container">
        <header>
            <h1>Defina um usuário e uma senha</h1>
        </header>
        <section>
            <form method="POST">
                <label>USUÁRIO</label><br>
                <input type="text" name="userr" required><br><br>
                <label>SENHA</label><br>
                <input type="password" name="passwor" required><br><br>
                <input type="submit" value="Enviar">
            </form>
            <p><?= $mensagem ?></p>
        </section>
        <a href="logout.php">SAIR</a>
    </div>

</body>

</html>