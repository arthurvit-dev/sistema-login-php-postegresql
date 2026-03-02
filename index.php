<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pagcadastro/public/assets/estilo.css">
    <title>login</title>
</head>
<body>


   <?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/pagcadastro/config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userr   = $_POST['userr'];
    $passwor = $_POST['passwor'];

    if (empty($userr) || empty($passwor)) {
        $erro = "Preencha todos os campos";
    } else {

        $sql = "SELECT * FROM usuarios WHERE userr = :userr LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':userr', $userr);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($passwor === $user['passwor']) {

                // 🔥 LOGIN OK
                $_SESSION['userr'] = $user['userr'];
                $_SESSION['nivel'] = $user['nivel']; // <-- ADICIONADO

                // 🔥 REDIRECIONAMENTO POR NÍVEL
                if ($user['nivel'] === 'admin') {
                    header("Location: /pagcadastro/pages/adm.php");
                } else {
                    header("Location: /pagcadastro/pages/login.php");
                }

                exit;

            } else {
                $erro = "Senha incorreta";
            }

        } else {
            $erro = "Usuário não encontrado";
        }
    }
}
?>


    <div class="container">
    <header>
        <h1>LOGIN</h1>
    </header>

    <section>

        <?php
            if (!empty($erro)) {
                echo "<p style='color:red; text-align:center;'>$erro</p>";
            }
        ?>

        <form method="POST">

            <label>USUARIO</label><br>
            <input type="text" name="userr" required><br><br>

            <label>SENHA</label><br>
            <input type="password" name="passwor" required><br><br>
            <div class="acoes">

            <input type="submit" value="LOGIN">

            <a href="/pagcadastro/pages/cadastrarse.php">Cadastra-se</a>

            </div>
        </form>
        
    </section>
    </div>
    
</body>
</html>