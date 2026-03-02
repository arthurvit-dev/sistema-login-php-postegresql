<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    height: 100vh;
    font-family: Arial, sans-serif;

    /* Centraliza tudo na tela */
    display: flex;
    justify-content: center;
    align-items: center;

    background-color: #ecf0f1;
}

.container {
    background-color: rgba(22, 66, 211, 0.404);
  padding: 25px;
  text-align: center;
}

.menu {
    list-style: none;
    display: flex;
    gap: 25px;
}

.menu li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
}

.menu li a:hover {
    color: #f1c40f;
}
    </style>

    <div class="container">
        <nav>
            <ul class="menu">
                <li><a href="/pagcadastro/crud/cadastro.php">Cadastrar</a></li>
                <li><a href="/pagcadastro/crud/listar.php">Ver cadastros</a></li>
                <li><a href="/pagcadastro/crud/excluir.php">Excluir</a></li>
                <li><a href="/pagcadastro/crud/editar.php">Editar</a></li>
            </ul>
        </nav>
        <br>
        <a href="logout.php">SAIR</a>
    </div>
</body>
</html>