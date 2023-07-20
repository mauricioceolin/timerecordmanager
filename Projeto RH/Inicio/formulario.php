<?php

$pdo = new PDO('mysql:host=localhost;dbname=infinityponto','root','');

class Dados {
    public $funcionario;
    public $data;
    public $entrada;
    public $saida;

    public function __construct() {
        $this->funcionario = $_POST['funSelect'];
        $this->data = $_POST['data'];
        $this->entrada = $_POST['entrada'];
        $this->saida = $_POST['saida'];
    }
}

$dados = new Dados();

// Consulta SQL para obter o ID do funcionário
$sqlFuncionario = "SELECT ID FROM funcionario WHERE nome = ?";
$stmtFuncionario = $pdo->prepare($sqlFuncionario);
$stmtFuncionario->execute([$dados->funcionario]);

// Verificar se há um resultado retornado
if ($stmtFuncionario->rowCount() > 0) {
    $rowFuncionario = $stmtFuncionario->fetch(PDO::FETCH_ASSOC);
    $idFuncionario = $rowFuncionario['ID'];

    // Inserir os dados na tabela horario
    $sql = "INSERT INTO horario (ID_Func, data, entrada, saida) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idFuncionario, $dados->data, $dados->entrada, $dados->saida]);
    header('Location: index.php?sucesso=1');
    exit;
} else {
    echo 'Funcionário não encontrado.';
}
?>
