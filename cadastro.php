<?php
// Inclui o arquivo de conexão com o banco de dados
include 'db.php';

// Verifica se o formulário foi enviado para cadastrar uma pizza
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $informacoes = $_POST['informacoes'];
    $nome_produto = $_POST['nome_produto'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];



    // Insere a pizza no banco de dados
    $sql = "INSERT INTO produto (informacoes,nome_produto,descricao,preco) VALUES (:informacoes,:nome_produto,:descricao,:preco)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':informacoes', $informacoes);
    $stmt->bindParam(':nome_produto', $nome_produto);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':preco', $preco);

    $stmt->execute();

    // Redireciona para a página de cadastro de pizza
    header('Location: cadastro.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produtos - Padaria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Menu de Navegação -->
    <nav>
        <a href="index.php">Cadastro Comprador</a>
        <a href="registro.php">Registro de Vendas</a>
        <a href="cadastro.php">Cadastro do Produto</a>
    </nav>

    <h1>Cadastrar Produto</h1>
    <form action="cadastro.php" method="POST">
       
        <label for="informacoes">Informações do produto</label>
        <input type="text" id="informacoes" name="informacoes" required><br>

        <label for="nome_produto">Nome Produto:</label>
        <input type="text" id="nome_produto" name="nome_produto" required><br>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" required><br>

        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" required><br>



        <button type="submit">Cadastrar Produto</button>
    </form>
</body>
</html>