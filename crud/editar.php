<?php
require __DIR__ . '/../config/conexao.php';

$mensagem = "";

/* =========================
   Se for POST → Atualiza
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {

    $id    = $_POST['id'];
    $userr = $_POST['userr'];
    $nivel = $_POST['nivel'];

    $sql = "UPDATE usuarios 
            SET userr = :userr, nivel = :nivel 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'userr' => $userr,
        'nivel' => $nivel,
        'id'    => $id
    ]);

    $mensagem = "Usuário atualizado com sucesso!";
}


/* =========================
   Se tiver ID → Busca usuário
========================= */
$usuario = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}


/* =========================
   Buscar todos usuários para o select
========================= */
$sqlLista = "SELECT id, userr FROM usuarios ORDER BY id ASC";
$stmtLista = $pdo->query($sqlLista);
$listaUsuarios = $stmtLista->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="/pagcadastro/public/assets/estilo.css">
</head>

<body>

    <div class="container">

        <?php if (!empty($mensagem)): ?>
            <div class="mensagem-sucesso">
                <?= $mensagem ?>
            </div>
        <?php endif; ?>

        <h2>Selecionar Usuário para Editar</h2>

        <form method="GET">
            <select name="id" required>
                <option value="">Selecione um usuário</option>
                <?php foreach ($listaUsuarios as $u): ?>
                    <option value="<?= $u['id'] ?>">
                        <?= $u['id'] ?> - <?= htmlspecialchars($u['userr']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Carregar</button>
            <?php if (!$usuario): ?>
                <a href="/pagcadastro/pages/adm.php">VOLTAR</a>
            <?php endif; ?>

        </form>



        <?php if ($usuario): ?>

            <h2>Editando Usuário ID <?= $usuario['id'] ?></h2>

            <form method="POST">
                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

                <label>Usuário:</label><br>
                <input type="text" name="userr"
                    value="<?= htmlspecialchars($usuario['userr']) ?>" required><br><br>

                <label>Nível:</label><br>
                <select name="nivel" required>
                    <option value="admin"
                        <?= ($usuario['nivel'] === 'admin') ? 'selected' : '' ?>>
                        Admin
                    </option>

                    <option value="Usuario"
                        <?= ($usuario['nivel'] === 'Usuario') ? 'selected' : '' ?>>
                        Usuario
                    </option>
                </select>
                <br><br>

                <button type="submit">Salvar Alterações</button>
            </form>
            <a href="/pagcadastro/pages/adm.php">VOLTAR</a>

    </div>

<?php endif; ?>

</body>

</html>