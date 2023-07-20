<?php
$pdo = new PDO('mysql:host=localhost;dbname=infinityponto', 'root', '');

$funcionarioId = $_POST['funExc'];

// Atualizar o valor da coluna "desativado" para "S" (ou 1) para indicar desativação
$sql = "UPDATE funcionario SET desativado = 1 WHERE ID = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$funcionarioId]);

if ($stmt->rowCount() > 0) {
    header('Location: ExcFunc.php?sucesso=1');
    exit;
} else {
    header('Location: ExcFunc.php?sucesso=0');
    exit;
}

?>
