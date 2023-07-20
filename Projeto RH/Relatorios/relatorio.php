<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>RH - Relatório</title>
  <link rel="stylesheet" href="relatorio.css">
</head>

<body>
  <header id="menu">
    <img src="../RH-Infinity-Logo.png">
    <div>
      <ul id="botaomenu">
        <li><a href="../Inicio/index.php">Início</a></li>
        <li><a href="../Configurações/ConfigMenu.html">Configurações</a></li>
        <li><a href="relatorio.php">Relatórios</a></li>
      </ul>
    </div>
  </header>

  <div id="janela">
    <div id="consulta">
      <h1>Consultar Relatório</h1>
      <form method="GET">
        <label for="funcionario">Funcionário:</label>
        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=infinityponto','root','');

        // Query SQL para buscar os nomes dos funcionários
        $sql = "SELECT ID, nome FROM funcionario WHERE DESATIVADO = '0'";

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
        <label for="data_inicio">Data Início:</label>
        <input type="date" name="data_inicio" id="data_inicio">

        <label for="data_fim">Data Fim:</label>
        <input type="date" name="data_fim" id="data_fim">

        <button type="submit" id="gerarRelatorio">Gerar Relatório</button>
      </form>

      <div>
        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=infinityponto', 'root', '');

        // Verificar se o formulário foi submetido
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Obter os valores dos filtros
            $funcionario = $_GET['funSelect'];
            $dataInicio = $_GET['data_inicio'];
            $dataFim = $_GET['data_fim'];

            // Preparar a consulta SQL com os filtros
            $sql = "SELECT F.ID, F.NOME, F.Salario, DATE_FORMAT(H.Entrada, '%H:%i') AS Entrada, DATE_FORMAT(H.Saida, '%H:%i') AS Saida, DATE_FORMAT(data, '%d/%m/%Y') AS Data FROM funcionario F LEFT JOIN horario H ON F.ID = H.ID_Func WHERE F.DESATIVADO = 0";
            $params = array();

            // Adicionar os filtros à consulta SQL e aos parâmetros
            if (!empty($funcionario)) {
                $sql .= " AND F.NOME = ?";
                $params[] = $funcionario;
            }

            if (!empty($dataInicio) && !empty($dataFim)) {
                $sql .= " AND H.Data BETWEEN ? AND ?";
                $params[] = $dataInicio;
                $params[] = $dataFim;
            }

            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $relatorio = $stmt->fetchAll();

            foreach ($relatorio as $linha) {
                echo 'Funcionário: ' . $linha['NOME'] . '<br>';
                echo 'Data: ' . $linha['Data'] . '<br>';
                echo 'Entrada: ' . $linha['Entrada'] . '<br>';
                echo 'Saída: ' . $linha['Saida'] . '<br>';

                // Cálculo do valor do salário
                $salario = $linha['Salario'];
                $horasTrabalhadas = calcularHorasTrabalhadas($linha['Entrada'], $linha['Saida']);
                $valorRecebido = $salario * $horasTrabalhadas;

                echo 'Salário: R$ ' . $valorRecebido . '<br><br>';
            }
        }

        // Função para calcular as horas trabalhadas
        function calcularHorasTrabalhadas($entrada, $saida) {
            $entradaTimestamp = strtotime($entrada);
            $saidaTimestamp = strtotime($saida);

            // Calcular a diferença em segundos
            $diferencaSegundos = $saidaTimestamp - $entradaTimestamp;

            // Converter para horas
            $horasTrabalhadas = $diferencaSegundos / 3600;

            return $horasTrabalhadas;
        }
        ?>
      </div>
    </div>
  </div>

  <div class="center">
    <button>Cancelar</button>
    <button id="gerarRelatorio" type="submit">Gerar Relatório</button>
  </div>
</body>

</html>
