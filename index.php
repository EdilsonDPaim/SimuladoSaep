<?php
// Inclui o arquivo de conexão com o banco de dados
include 'db.php';
//W4GTWG
// Verifica se o formulário foi enviado para registrar o pedido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_comprador = $_POST['id_comprador'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    // Insere o pedido no banco de dados
    $sql = "INSERT INTO padaria (id_comprador, nome, telefone, endereco)
            VALUES (:id_comprador, :nome, :telefone, :endereco)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_comprador', $id_comprador);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':endereco', $endereco);

    $stmt->execute();

    // Redireciona para a página de visualização de pedidos
    header('Location: venda.php');
    exit;
}

// Consulta todos os clientes cadastrados
$sql = "SELECT * FROM comprador";
$stmt = $conn->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastra Comprador - Padaria</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Função para preencher os campos de telefone e endereço automaticamente ao selecionar o cliente
        function preencherDadosComprador() {
            var id_comprador = document.getElementById("id_comprador").value;
            var nome = document.getElementById("nome");
            var telefone = document.getElementById("telefone");
            var endereco = document.getElementById("endereco");

            <?php foreach ($compradores as $comprador): ?>
                if (id_comprador == <?php echo $comprador['id_comprador']; ?>) {
                    nome.value = "<?php echo $comprador['nome']; ?>";
                    telefone.value = "<?php echo $comprador['telefone']; ?>";
                    endereco.value = "<?php echo $comprador['endereco']; ?>";
                }
            <?php endforeach; ?>
        }
    </script>
</head>
<body>
    <!-- Menu de Navegação -->
    <nav>
        <a href="index.php">Cadastro Comprador</a>
        <a href="registro.php">Registro de Vendas</a>
        <a href="cadastro.php">Cadastro do Produto</a>
    </nav>

    <h1>Registrar Cadastro</h1>
    <form action="index.php" method="POST">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required><br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required><br>


        <button type="submit">Cadastra Comprador </button>
    </form>
</body>
</html>