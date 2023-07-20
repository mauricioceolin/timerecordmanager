<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>RH - Config</title>
  <link rel="stylesheet" href="AddFunc.css">
</head>
<header id="menu">
  <img src="../../RH-Infinity-Logo.png">
  <div>
    <ul id="botaomenu">
      <li><a href="../../Inicio/index.php">Início</a></li>
      <li><a href="../../Configurações/ConfigMenu.html">Configurações</a></li>
      <li><a href="../../Relatorios/relatorio.php">Relatórios</a></li>
    </ul>
  </div>
</header>

<body>
  <form method="post">
    <div id="janela">
      <div id = "Configfunc" name ="ConfigFunc">
        <h1>Adicionar Funcionário</h1> </br>
        <p>Nome:</p><input type="text" name="Nome" placeholder="Digite o Nome">
        <p>Salário:</p> <p>R$</p><input type="number" name="Salario" min="0" placeholder="Informe o salário">
      </div>
    </div>
    <div class="center">
    <button>Cancelar</button>
    <button id="registro" name= 'acao' type="submit" value="Enviar">Registrar</button>
    
  </div>
  </form>
</body>
</html>



<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['Nome'];
    $salario = $_POST['Salario'];

    $pdo = new PDO('mysql:host=localhost;dbname=infinityponto', 'root', '');

    // Insira os valores na tabela funcionario
    $sql = "INSERT INTO funcionario (nome, salario) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $salario]);

    if ($stmt->rowCount() > 0) {
        // Redirecionar para uma página de sucesso
        header('Location: addFunc.php');
        exit;
    } else {
        // Redirecionar para uma página de erro
        alert('Operação não realizada, confira os dados e tente novamente');
        exit;
    }
}
?>
