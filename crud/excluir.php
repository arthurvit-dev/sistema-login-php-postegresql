<?php
require __DIR__ . '/../config/conexao.php';

$sql = "SELECT id, userr FROM usuarios";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['id']) && !empty($_POST['id'])) {

        $id = $_POST['id'];

        $sqlDelete = "DELETE FROM usuarios WHERE id = :id";
        $stmtDelete = $pdo->prepare($sqlDelete);
        $stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDelete->execute();

          header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link rel="stylesheet" href="/pagcadastro/public/assets/estilo.css">
</head>
<body>

<div class="container">
    <h2>Usuários cadastrados</h2>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Ação</th>
        </tr>
    
    
    
        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= $u['userr'] ?></td>
                <td>
                    <form method="post" action="excluir.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
    
        <?php endforeach; ?>
    </table>
    <a href="/pagcadastro/pages/adm.php">VOLTAR</a>
</div>

</body>
</html>