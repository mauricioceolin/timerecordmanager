<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>RH - Alterar Salário</title>
  <link rel="stylesheet" href="AltFunc.css">
</head>
<header id="menu">
  <img src="../../RH-Infinity-Logo.png">
  <div>
    <ul id="botaomenu">
      <li><a href="../../Inicio/rh.php">Início</a></li>
      <li><a href="../../Configurações/ConfigMenu.html">Configurações</a></li>
      <li><a href="../../Relatorios/relatorio.html">Relatórios</a></li>
    </ul>
  </div>
</header>

<body>
  <form>
    <div id="janela">
      <div id="AltFunc">
      <h1>Alterar salário de funcionário:</h1>
      <p>Funcionário:</p>
      <select id="funcionarioSelect">
        <option value="">Selecione o funcionário</option>
      </select>
    </div>
<br>
    <div id="Salario">
      <p>Novo salário: </p>
      R$ <input type="number" name="AltSal" id="AltSal" min="0" placeholder="Informe o novo salário">
      </div>
    </div>
  </form>
<div class="center">
  <button onclick="redirecionar()">Cancelar</button>
  <button onclick="AltFuncionario()">Registrar</button>
</div>
</body>
<script src="AltFunc.JS"></script>

</html>