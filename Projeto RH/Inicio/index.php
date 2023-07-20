<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>Infinity RH</title>
  <link rel="stylesheet" href="RHCss.css">
</head>
<header id="menu">
  <img src="RH-Infinity-Logo.png">
  <nav>
    <ul id="botaomenu">
      <li><a href="index.php">Início</a></li>
      <li><a href="../Configurações/ConfigMenu.html">Configurações</a></li>
      <li><a href="../Relatorios/relatorio.php">Relatórios</a></li>
    </ul>
  </nav>
</header>
<body>
    <div class="corpo">
    <form method="post" action="formulario.php">
    <div id="janela">
      <div id="func">
        <h1>Registre o horário</h1>
        <p>Funcionário:</p>
        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=infinityponto','root','');
        
        // Query SQL para buscar os nomes dos funcionários
        $sql = "SELECT ID, nome FROM funcionario where DESATIVADO = '0'";
        
        // Preparar e executar a consulta
        $stmt = $pdo->query($sql);
        
        // Verificar se há registros retornados
        if ($stmt->rowCount() > 0) {
            // Iniciar o elemento <select>
            echo '<select id="funcionarioSelect" name="funSelect" required>';
            
            // Loop através dos registros retornados
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Exibir cada nome como uma opção
                echo '<option value="' . $row['nome'] . '">' . $row['nome'] . '</option>';
            }
            
            // Fechar o elemento <select>
            echo '</select>';
        } else {
            // Caso não haja registros encontrados
            echo 'Nenhum funcionário encontrado.';
        }
        ?>
      </div>
<br><br>
    <div id=data>
        <p>Data:<p>
        <input type="date" name="data" id="cEnt" >
        <br><br>
    <div id="entrada">
      <p>Entrada:</p>
      <input type="time" name="entrada" id="cHt" >
    </div>
    <br><br>
    <div id="saida">
      <p>Saída:</p>
      <input type="time" name="saida" id="cSaidaTime" >
    </div></div>
    <button id="registro" name= 'acao' type="submit" value="Enviar">Registrar</button>
    
  </form>

  
</div>
<script>
  <?php if (isset($_GET['sucesso'])): ?>
  // Verificar se a variável 'sucesso' está definida na URL
  // Se estiver definida, exibir o alert de sucesso
  alert('Horário registrado com sucesso');
  <?php endif; ?>
</script>
</body>
</html>
