<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>RH - Config</title>
  <link rel="stylesheet" href="ExcFunc.css">
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
  <form action="FuncExc.php" method="POST">
    <div id="janela">
      <div id="Configfunc">
        <h1>Selecione o Funcionário que deseja desativar</h1> 
          <?php
          $pdo = new PDO('mysql:host=localhost;dbname=infinityponto','root','');
          
          // Query SQL para buscar os nomes dos funcionários
          $sql = "SELECT ID, nome FROM funcionario where DESATIVADO = '0'";
          
          // Preparar e executar a consulta
          $stmt = $pdo->query($sql);
          
          // Verificar se há registros retornados
          if ($stmt->rowCount() > 0) {
              // Iniciar o elemento <select>
              echo '<select id="funcionarioSelect" name="funExc" required>';
              
              // Loop através dos registros retornados
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  // Exibir cada nome como uma opção
                  echo '<option value="' . $row['ID'] . '">' . $row['nome'] . '</option>'; // Corrigido para usar o valor do ID como valor da opção
              }
              
              // Fechar o elemento <select>
              echo '</select>';
          } else {
              // Caso não haja registros encontrados
              echo 'Nenhum funcionário encontrado.';
          }
          ?>
      </div>
    </div>
    <div class="center">
      <button type="button">Cancelar</button> 
      <button id="excluir" name="acaoexc" type="submit" value="Excluir">Desativar</button>
    </div>
  </form>
</body>

<script>
  <?php if (isset($_GET['sucesso'])): ?>
  // Verificar se a variável 'sucesso' está definida na URL
  // Se estiver definida, exibir o alert de sucesso
  alert('Funcionário desativado com sucesso');
  <?php endif; ?>
</script>

</html>
