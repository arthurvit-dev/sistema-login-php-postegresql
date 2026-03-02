<?php
require __DIR__ . '/../config/conexao.php';

// Buscar todos os registros
$sql = "SELECT id, userr, nivel, data_criacao FROM usuarios ORDER BY id ASC";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="/pagcadastro/public/assets/estilo.css">
</head>
<body>

<div class="container">
    <h2>Lista de Usuários</h2>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Nível</th>
            <th>Data de Criação</th>
        </tr>
    
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['id']) ?></td>
                <td><?= htmlspecialchars($usuario['userr']) ?></td>
                <td><?= htmlspecialchars($usuario['nivel']) ?></td>
                <td>
                    <?= date('d/m/Y H:i', strtotime($usuario['data_criacao'])) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="/pagcadastro/pages/adm.php">VOLTAR</a>
</div>

</body>
</html>