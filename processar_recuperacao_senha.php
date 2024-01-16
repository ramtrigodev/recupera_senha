<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'conexao.php';
require './lib/vendor/autoload.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    
    $sql = "SELECT * FROM usuarioss WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $novaSenhaTemporaria = substr(md5(uniqid(rand(), true)), 0, 8);
        $novaSenhaHash = md5($novaSenhaTemporaria);

        
        $sqlUpdate = "UPDATE usuarioss SET senha = '$novaSenhaHash' WHERE email = '$email'";
        if ($conn->query($sqlUpdate) === TRUE) {
            $mail = new PHPMailer(true);

            $mail->IsSMTP();
            $mail->SMTPDebug = false;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'email-ssl.com.br';
            $mail->Port = 465;
            $mail->Username = 'ramtrigo@rtrigo.com.br';
            $mail->Password = '';
            $mail->SetFrom('ramtrigo@rtrigo.com.br', 'Envio de Senha');
            $mail->addAddress('ramtrigo@hotmail.com', 'teste de recuperacao');
            $mensagem = "Sua nova senha temporária é: $novaSenhaTemporaria";
            $mail->Subject = "Recuperação de Senha";
            $mail->msgHTML($mensagem);

            try {
                $mail->send();
                $Message = "Email Enviado";
            } catch (Exception $e) {
                echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
            }
        } else {
            echo "Erro ao atualizar senha: " . $conn->error;
        }
    } else {

        $alertMessage = "Email não encontrado.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Recuperação de Senha</title>
    <!-- Adicione os links para os estilos do Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</head>

<body>
    
    <div class="container mt-5">
    <?php if (!empty($Message)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $Message; ?>
            </div>
        <?php } ?>
        <?php if (!empty($alertMessage)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $alertMessage; ?>
            </div>
        <?php } ?>

    </div>
    <script>
        setTimeout(function() {

          window.location.href = "recuperar_senha.php";
        }, 2000); // 10 segundos
    </script>
</body>
    
</html>

    