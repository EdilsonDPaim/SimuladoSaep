<?php
// Inclui o arquivo de conexão com o banco de dados
include 'db.php';

// Verifica se o pedido foi excluído
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $sql = "DELETE FROM pedidos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: pedidos.php');
    exit;
}

// Verifica se o status do pedido foi alterado
if (isset($_GET['atualizar_status'])) {
    $id = $_GET['atualizar_status'];
    $sql = "UPDATE pedidos SET status = CASE 
                WHEN status = 'A fazer' THEN 'Em preparação' 
                WHEN status = 'Em preparação' THEN 'Pronto' 
                WHEN status = 'Pronto' THEN 'A fazer' 
            END WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header('Location: pedidos.php');
    exit;
}

// Consulta os pedidos e os dados dos clientes
$sql = "SELECT venda.*, compradores.nome, compradores.telefone, compradores.endereco
        FROM venda 
        JOIN compradores ON venda.id_comprador = compradores.id_venda";
$stmt = $conn->prepare($sql);
$stmt->execute();
$venda = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas - Padaria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Menu de Navegação -->
    <nav>
        <a href="index.php">Cadastro Comprador</a>
        <a href="venda.php">Registro de Vendas</a>
        <a href="cadastro.php">Cadastro do Produto</a>

    </nav>

    <h1>Vendas</h1>
  <!-- Pedidos prontos -->
        <div class="coluna">
            <h2>Vendas Prontas</h2>
            <?php foreach ($vendas as $venda): ?>
                <?php if ($venda['status'] == 'Pronto'): ?>
                    <div class="venda">
                        <p><strong>Cliente:</strong> <?php echo $pedido['nome_cliente']; ?></p>
                        <p><strong>Telefone:</strong> <?php echo $pedido['telefone_cliente']; ?></p>
                        <p><strong>Endereço:</strong> <?php echo $pedido['endereco_cliente']; ?></p>
                        <p><strong>Sabor:</strong> <?php echo $pedido['sabor_pizza']; ?></p>
                        <p><strong>Quantidade:</strong> <?php echo $pedido['quantidade_pizza']; ?></p>
                        <p><strong>Observação:</strong> <?php echo $pedido['observacao']; ?></p>
                        <p><strong>Status:</strong> <?php echo $pedido['status']; ?></p>
                        <a href="?atualizar_status=<?php echo $pedido['id']; ?>">Alterar Status</a>
                        <a href="?excluir=<?php echo $pedido['id']; ?>">Excluir Pedido</a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>