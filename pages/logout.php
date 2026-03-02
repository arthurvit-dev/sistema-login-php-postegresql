<?php
session_start();
session_destroy();

header("Location: /pagcadastro/index.php");
exit;