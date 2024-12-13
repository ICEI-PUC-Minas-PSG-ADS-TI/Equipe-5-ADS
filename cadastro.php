    <?php
include 'db.php';
session_start();

    if (isset($_POST['cadastrar'])) {
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';

        $check_sql = "SELECT * FROM clientes WHERE cpf = '$cpf' OR email = '$email'";
        $check_result = mysqli_query($con, $check_sql);
    
        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>
                alert('Nome ou e-mail já cadastrados, tente novamente.');
                window.location.href = 'cadastro.php';
            </script>";
            exit();
        }

        $sql = "INSERT INTO clientes (nome, email, senha, cpf) VALUES ('$nome', '$email', '$senha', '$cpf')";
                    
        if ($con->query($sql) === TRUE) {
            $_SESSION['success'] = "Cadastro feito com sucesso";
            unset($_SESSION['error']);
        } 
        else {
            $_SESSION['error'] = "Erro ao fazer cadastro: " . $con->error;
            unset($_SESSION['success']);
            exit();
        }  
    }

    elseif (isset($_POST['entrar'])) {
        $loginemail = isset($_POST['loginemail']) ? $_POST['loginemail'] : '';
        $loginsenha = isset($_POST['loginsenha']) ? $_POST['loginsenha'] : '';

        $sql = "SELECT senha FROM clientes WHERE email = '$loginemail'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        
            if ($row['senha'] === $loginsenha) {
                $sql_nome = "SELECT nome FROM clientes WHERE email = '$loginemail'";
                $result_nome = mysqli_query($con, $sql_nome);
                $row_nome = mysqli_fetch_assoc($result_nome);

                session_start();
                $_SESSION['nome_usuario'] = $row_nome['nome'];

                echo "<script>
                    alert('Login realizado com sucesso!');
                    window.location.href = 'homepage.php';
                </script>";
                exit();
            } else {
                echo "<script>
                    alert('Senha incorreta');
                    window.location.href = 'cadastro.php';
                </script>";
                exit();
            }
        } else {
            echo "<script>
                alert('E-mail não encontrado no sistema');
                window.location.href = 'cadastro.php';
            </script>";
            exit();
        }
        
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EcoLife</title>
    <link rel="stylesheet" href="LoginCadastro.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body class="bg-image">
<div class="logo">
    <img src="Imagens/EcoLife-logo.png" alt="ecolife-logo" class="EcoLife" draggable="false">
  </div>
        <div class="login-container shadow p-3 rounded">
        <?php if (isset($_SESSION['success'])) : ?>
    <div id="successAlert" class="alert alert-success mt-2" role="alert">
        <i class="bi-check fs-4"></i> <?php echo $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php elseif (isset($_SESSION['error'])) : ?>
    <div id="errorAlert" class="alert alert-danger mt-2" role="alert">
        <i class="bi-exclamation fs-4"></i> <?php echo $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
            <div class="tab-container">
                <button class="tab active" onclick="showForm('login')">Login</button>
                <button class="tab" id="btnCadastrar" onclick="showForm('cadastro')">Cadastro</button>
            </div>
            <form method="POST" id="login" class="form active">
                <label for="loginEmail">Email:</label>
                <input type="email" id="loginEmail" name="loginemail" required>
                <label for="loginPassword">Senha:</label>
                <input type="password" id="loginPassword" name="loginsenha" required>
                <button type="submit" name="entrar">Entrar</button>
            </form>
            <form method="POST" id="cadastro" class="form" name="cadastro">
                <label for="cadastroNome">Nome:</label>
                <input type="text" id="cadastroNome" name="nome" required>
                <label for="cadastroEmail">Email:</label>
                <input type="email" id="cadastroEmail" name="email" required>
                <label for="cadastroCpf">CPF:</label>
                <input type="text" id="cadastroCpf" name="cpf" required>
                <label for="cadastroPassword">Senha:</label>
                <input type="password" id="confirmPassword" name="senha" required>
                <button type="submit" name="cadastrar">Cadastrar</button>
            </form>
        </div>
    </div>

    <script>
        function showForm(formId) {
            document.querySelectorAll('.form').forEach(form => {
                form.classList.remove('active');
            });
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.getElementById(formId).classList.add('active');
            document.querySelector(`.tab[onclick="showForm('${formId}')"]`).classList.add('active');
        }
        if (btnCadastrar) {
            btnCadastrar.addEventListener('click', () => {
                if (errorAlert) {
                    errorAlert.style.display = 'none'; 
                }
            });
        }
    </script>
            <script src="index.js"></script>
</body>
</html>