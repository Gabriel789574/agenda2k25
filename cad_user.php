<?php
  ob_start();
  session_start();
  include_once('config/conexao.php'); 
  
  $mensagem_status = ''; 
  
  if (isset($_POST['botao'])) {
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); 

      $novoNome = 'avatar-padrao.png'; 
      $processamento_ok = true;

      if (!empty($_FILES['foto']['name'])) {
          $formatosPermitidos = array("png", "jpg", "jpeg", "gif"); 
          $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION); 

          if (in_array(strtolower($extensao), $formatosPermitidos)) {
              $pasta = "img/user/"; 
              $temporario = $_FILES['foto']['tmp_name']; 
              $novoNome = uniqid() . ".$extensao"; 

              if (!move_uploaded_file($temporario, $pasta . $novoNome)) {
                  $mensagem_status = '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> Erro!</h5>
                      Não foi possível fazer o upload do arquivo.
                  </div>';
                  $processamento_ok = false;
              }
          } else {
              $mensagem_status = '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Formato Inválido!</h5>
                  Formato de arquivo não permitido (Use PNG, JPG, JPEG, GIF).
              </div>';
              $processamento_ok = false;
          }
      }

      if ($processamento_ok) {
          if (!isset($conect) || $conect === null) {
               $mensagem_status = '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> Erro de Conexão!</h5>
                      O serviço de banco de dados está indisponível.
                  </div>';
          } else {
              $cadastro = "INSERT INTO tb_user (foto_user, nome_user, email_user, senha_user) VALUES (:foto, :nome, :email, :senha)";

              try {
                  $result = $conect->prepare($cadastro);
                  $result->bindParam(':nome', $nome, PDO::PARAM_STR);
                  $result->bindParam(':email', $email, PDO::PARAM_STR);
                  $result->bindParam(':senha', $senha, PDO::PARAM_STR);
                  $result->bindParam(':foto', $novoNome, PDO::PARAM_STR);
                  $result->execute();
                  $contar = $result->rowCount();

                  if ($contar > 0) {
                      $mensagem_status = '<div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h5><i class="icon fas fa-check"></i> OK!</h5>
                          Cadastro realizado com sucesso! Redirecionando para o Login...
                      </div>';
                      header("Refresh: 5; url=index.php"); 
                      exit(); 
                  } else {
                      $mensagem_status = '<div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h5><i class="icon fas fa-times"></i> Erro!</h5>
                          Dados não inseridos. Tente novamente.
                      </div>';
                  }
              } catch (PDOException $e) {
                  error_log("ERRO DE PDO NO CADASTRO: " . $e->getMessage());
                  $mensagem_status = '<div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> Erro!</h5>
                      Ocorreu um erro ao tentar inserir os dados no banco.
                  </div>';
              }
          }
      }
  }
  ob_end_flush(); 
?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cadastro de Usuário</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

  
  <!-- Logo Neon Interno -->
<div class="logo-neon">
  <span class="logo-text">Cadastro de Novo Usuário</span>
  <small class="logo-sub"></small>
</div>

<style>
/* Container do logo */
.logo-neon {
  font-family: 'Source Sans Pro', sans-serif;
  text-align: center;
  margin-bottom: 20px;
}

/* Texto principal do logo */
.logo-neon .logo-text {
  font-size: 36px;
  font-weight: 900;
  color: #00aaff; /* azul neon */
  text-transform: uppercase;
  letter-spacing: 2px;
  text-shadow: 
    0 0 5px #00aaff, 
    0 0 10px #00aaff, 
    0 0 20px #00aaff, 
    0 0 40px #00aaff;
  animation: neon-glow 1.5s infinite alternate;
}

/* Subtítulo do logo */
.logo-neon .logo-sub {
  display: block;
  font-size: 14px;
  color: #0099ff;
  letter-spacing: 1px;
  margin-top: -5px;
  text-shadow: 0 0 5px #0099ff;
}

/* Animação glow pulsante */
@keyframes neon-glow {
  0% {
    text-shadow: 0 0 5px #00aaff, 0 0 10px #00aaff, 0 0 20px #00aaff, 0 0 40px #00aaff;
  }
  50% {
    text-shadow: 0 0 10px #00aaff, 0 0 20px #00aaff, 0 0 30px #00aaff, 0 0 60px #00aaff;
  }
  100% {
    text-shadow: 0 0 5px #00aaff, 0 0 10px #00aaff, 0 0 20px #00aaff, 0 0 40px #00aaff;
  }
}
</style>

  <style>
    :root {
        --cor-primaria: #00aaff;
        --cor-primaria-hover: #0099ff;
        --cor-fundo: #1b2a38;
        --cor-card: #223544;
        --cor-texto-principal: #e0f7fa;
        --cor-texto-secundario:rgb(5, 8, 9);
        --cor-input: #2a3b4e;
        --cor-alert-success: #004d40;
        --cor-alert-danger: #330000;
    }


    body.login-page {
        background: linear-gradient(135deg, #1b2a38, #162230);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        font-family: 'Source Sans Pro', sans-serif;
    }

    .login-box { width: 420px; margin: 0; }

    .card {
        border: none;
        border-radius: 15px;
        padding: 10px;
        background: var(--cor-card);
        color: var(--cor-texto-principal);
        animation: glow 2s infinite;
    }

    @keyframes glow {
        0% { box-shadow: 0 0 10px rgba(0, 170, 255, 0.4); }
        50% { box-shadow: 0 0 25px rgba(0, 170, 255, 0.8); }
        100% { box-shadow: 0 0 10px rgba(0, 170, 255, 0.4); }
    }

    .input-group.mb-3 {
        border: 1px solid var(--cor-primaria);
        border-radius: 8px;
        background: var(--cor-input);
        overflow: hidden;
        transition: all 0.5s ease;
    }
    .input-group.mb-3:focus-within {
        box-shadow: 0 0 15px var(--cor-primaria);
        border-color: var(--cor-primaria-hover);
    }
    .form-control {
        height: 48px;
        font-size: 16px;
        border: none;
        padding-left: 15px;
        background: var(--cor-input);
        color: var(--cor-texto-principal);
    }
    .input-group-text {
        background-color: #162230;
        border: none;
        color: var(--cor-primaria);
    }

    .btn-primary.btn-block {
        background-color: var(--cor-primaria);
        border-color: var(--cor-primaria);
        border-radius: 8px;
        font-weight: 700;
        height: 50px;
        font-size: 18px;
        margin-top: 15px;
        color: #000;
        transition: all 0.5s ease;
        animation: glow 2s infinite;
    }
    .btn-primary.btn-block:hover {
        background-color: var(--cor-primaria-hover);
        border-color: var(--cor-primaria-hover);
        transform: scale(1.02);
        box-shadow: 0 0 20px var(--cor-primaria-hover);
    }

    .custom-file {
        border: 1px solid var(--cor-primaria);
        border-radius: 8px;
        overflow: hidden;
        background: var(--cor-input);
        box-shadow: 0 0 10px rgba(0, 170, 255, 0.3);
        transition: all 0.5s ease;
    }
    .custom-file-label::after {
        background-color: #162230;
        color: var(--cor-primaria);
        font-weight: 600;
    }

    .login-logo, .login-logo a { color: var(--cor-texto-principal); }
    .login-logo small { color: var(--cor-primaria); }
    .login-box-msg { color: var(--cor-texto-secundario); }
    a.text-center { color: var(--cor-primaria); }

    .alert-success {
        background-color: var(--cor-alert-success);
        color: #00aaff;
        border-color: #0099ff;
        border-radius: 8px;
    }
    .alert-danger {
        background-color: var(--cor-alert-danger);
        color: #ff4d4d;
        border-color: #ff1a1a;
        border-radius: 8px;
    }
    .alert h5 { font-size: 16px; font-weight: 700; }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="cad_user.php"><b></b></a>
    <small>Preencha os dados abaixo</small>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Preencha os dados abaixo para criar sua conta e acessar a agenda.</p>

      <?php if (!empty($mensagem_status)) { echo '<div class="mb-3">' . $mensagem_status . '</div>'; } ?>

      <form action="" method="post" enctype="multipart/form-data">
        
        <div class="form-group">
          <label for="foto">Foto do usuário (Opcional)</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="foto" id="foto">
              <label class="custom-file-label" for="foto">Selecione o arquivo de imagem</label>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="text" name="nome" class="form-control" placeholder="Nome Completo..." required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span> 
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="E-mail Válido..." required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="password" name="senha" class="form-control" placeholder="Crie sua Senha..." required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-12">
            <button type="submit" name="botao" class="btn btn-primary btn-block">Finalizar Cadastro</button>
          </div>
        </div>
      </form>
      
      <p style="text-align: center; margin-top: 15px;">
        <a href="index.php" class="text-center">Já tem uma conta? Voltar para o Login!</a>
      </p>
    </div>
    </div>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function () {
        $('#foto').on('change', function () {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName || 'Selecione o arquivo de imagem');
        });
    });
</script>
</body>
</html>
<!-- Fundo Galáxia Cinematográfico sem manchas e sem chamas -->
<div class="galaxy-bg"></div>

<style>
/* Fundo galáxia base */
.galaxy-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(ellipse at bottom, #0d0d2c 0%, #000000 100%);
    overflow: hidden;
    z-index: -1;
}

/* Estrelas visíveis */
.galaxy-bg::before {
    content: '';
    position: absolute;
    width: 300%;
    height: 300%;
    background: transparent;
    box-shadow:
        50px 100px #fff, 200px 400px #fff, 400px 250px #fff,
        600px 150px #fff, 800px 350px #fff, 1000px 200px #fff,
        1200px 400px #fff, 1400px 300px #fff, 1600px 500px #fff,
        1800px 100px #fff, 2000px 350px #fff, 2200px 450px #fff,
        2400px 150px #fff;
    animation: stars-move 150s linear infinite;
    filter: brightness(2);
}

@keyframes stars-move {
    0% { transform: translate(0,0); }
    100% { transform: translate(-1200px,-600px); }
}

/* Camadas de nebulosa */
.galaxy-bg::after {
    content: '';
    position: absolute;
    width: 300%;
    height: 300%;
    background: radial-gradient(circle at 30% 30%, rgba(102, 0, 255,0.2), transparent 40%),
                radial-gradient(circle at 70% 50%, rgba(0, 255, 204,0.2), transparent 40%),
                radial-gradient(circle at 50% 80%, rgba(255, 102, 255,0.2), transparent 50%);
    animation: nebulaMove 200s linear infinite;
}

@keyframes nebulaMove {
    0% { transform: translate(0,0); }
    100% { transform: translate(-800px,-400px); }
}

/* Meteoros maiores e mais frequentes */
.meteor {
    position: absolute;
    width: 4px; 
    height: 180px; 
    background: linear-gradient(45deg, #ffffff, transparent);
    opacity: 0.95;
    transform: rotate(45deg);
    animation: meteor-move 1s linear forwards;
    border-radius: 2px;
}

@keyframes meteor-move {
    0% { transform: translate(0,0) rotate(45deg); opacity: 1; }
    100% { transform: translate(-900px, 900px) rotate(45deg); opacity: 0; }
}

/* Partículas caindo */
.particle {
    position: absolute;
    width: 3px;
    height: 12px;
    background: #00aaff;
    opacity: 0.8;
    animation: fall 6s linear infinite;
}

@keyframes fall {
    0% { transform: translateY(-10px); }
    100% { transform: translateY(100vh); }
}
</style>

<script>
// Meteoros aleatórios
function createMeteor() {
    const container = document.querySelector('.galaxy-bg');
    const meteor = document.createElement('div');
    meteor.classList.add('meteor');
    meteor.style.left = Math.random() * window.innerWidth + 'px';
    meteor.style.top = Math.random() * window.innerHeight/2 + 'px';
    meteor.style.animationDuration = (0.8 + Math.random() * 1.2) + 's';
    container.appendChild(meteor);
    setTimeout(() => meteor.remove(), 2000);
}
setInterval(createMeteor, 800); // mais frequente

// Partículas caindo
function createParticle() {
    const container = document.querySelector('.galaxy-bg');
    const particle = document.createElement('div');
    particle.classList.add('particle');
    particle.style.left = Math.random() * window.innerWidth + 'px';
    particle.style.top = Math.random() * -10 + 'px';
    particle.style.animationDuration = (3 + Math.random() * 5) + 's';
    container.appendChild(particle);
    setTimeout(() => particle.remove(), 8000);
}
setInterval(createParticle, 150);
</script>
