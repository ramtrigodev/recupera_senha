<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Recuperar Senha</title>
</head>
<body>

<div class="container mt-3">
    <h2>Recuperar Senha</h2>
    <?php
    if (isset($_GET['mensagem'])) {
        echo '<div class="alert alert-success" role="alert">' . $_GET['mensagem'] . '</div>';
    }
    ?>
    <form action="processar_recuperacao_senha.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control " id="email" name="email" required style="width: 400px;">
        </div> 
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

</body>
</html>
