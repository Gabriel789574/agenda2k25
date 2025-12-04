<?php
  session_start(); 

  // Verifica se o usuário está autenticado
  if (isset($_SESSION['loginUser']) && $_SESSION['senhaUser'] === true) {
      header("Location: paginas/home.php");
  }
?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cadastro De Cliente 2.0 | Log in</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

  <style>
    body.area-login {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      height: 100vh;
      font-family: 'Source Sans Pro', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #e0e0e0;
    }
    .icone-logo {
  width: 120px;   /* aumenta o círculo */
  height: 120px;  /* aumenta o círculo */
  background-color: #074563; /* nova cor aplicada */
  border-radius: 50%;
  margin: 0 auto 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 6px 15px rgba(0,0,0,0.4);
}


.icone-logo i {
  font-size: 100px; /* aumenta o tamanho do ícone */
  color:rgb(238, 236, 236);  /* opcional: dá destaque em azul claro */
}
.caixa-login {
  width: 420px;
  background: #074563; /* nova cor aplicada */
  border-radius: 18px;
  box-shadow: 0 12px 35px rgba(0,0,0,0.6);
  padding: 40px 30px;
  text-align: center;
}

    .login-logo a {
      color: #2c9dff;
      font-weight: 700;
      text-decoration: none;
      font-size: 22px;
    }

    .login-logo a:hover {
      text-decoration: underline;
    }

    .grupo-input {
      display: flex;
      align-items: center;
      margin-bottom: 18px;
      border: 1px solid #444;
      border-radius: 10px;
      background-color: #2a2a2a;
      overflow: hidden;
    }

    .grupo-input input {
      flex: 1;
      border: none;
      background: transparent;
      padding: 12px 15px;
      color: #f5f5f5;
      outline: none;
    }

    .grupo-input input::placeholder {
      color: #aaa;
    }

    .grupo-icon {
      background-color: #2c5364;
      padding: 0 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
    }

    .botao-login {
      background-color: #2c5364;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      color: #fff;
      padding: 12px;
      width: 100%;
      cursor: pointer;
      transition: all 0.3s;
    }

    .botao-login:hover {
      background-color: #203a43;
      transform: translateY(-2px);
      box-shadow: 0 5px 12px rgba(0,0,0,0.4);
    }

    .link-cadastro {
      margin-top: 20px;
    }

    .link-cadastro a {
      color: #2c9dff;
      font-weight: 600;
      text-decoration: none;
    }

    .link-cadastro a:hover {
      text-decoration: underline;
    }

    .alert {
      border-radius: 10px;
      margin-top: 15px;
      font-size: 14px;
    }
  </style>
</head>
<body class="area-login">
  <div class="caixa-login">
    <div class="login-logo">
    <div class="icone-logo">
  <i class="fas fa-user-circle"></i>
</div>
<h2>Cadastro de Clientes</h2>    </div>

    <p class="msg-login">Para acessar entre com E-mail e Senha</p>

    <form action="" method="post">
      <div class="grupo-input">
        <input type="email" name="email" placeholder="Digite seu E-mail...">
        <div class="grupo-icon"><i class="fas fa-envelope"></i></div>
      </div>

      <div class="grupo-input">
        <input type="password" name="senha" placeholder="Digite sua Senha...">
        <div class="grupo-icon"><i class="fas fa-lock"></i></div>
      </div>

      <button type="submit" name="login" class="botao-login">Acessar a Agenda</button>
    </form>

    <?php
      include_once('config/conexao.php');
      if (isset($_GET['acao'])) {
          $acao = $_GET['acao'];
          if ($acao == 'negado') {
              echo '<div class="alert alert-danger"><strong>Erro ao Acessar o sistema!</strong> Efetue o login ;(</div>';
          } elseif ($acao == 'sair') {
              echo '<div class="alert alert-warning"><strong>Você acabou de sair da Agenda Eletrônica!</strong> :(</div>';
          }
      }

      if (isset($_POST['login'])) {
          $login = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
          $senha = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

          if ($login && $senha) {
              $select = "SELECT * FROM tb_user WHERE email_user = :emailLogin";
              try {
                  $resultLogin = $conect->prepare($select);
                  $resultLogin->bindParam(':emailLogin', $login, PDO::PARAM_STR);
                  $resultLogin->execute();

                  if ($resultLogin->rowCount() > 0) {
                      $user = $resultLogin->fetch(PDO::FETCH_ASSOC);
                      if (password_verify($senha, $user['senha_user'])) {
                          $_SESSION['loginUser'] = $login;
                          $_SESSION['senhaUser'] = $user['id_user'];
                          echo '<div class="alert alert-success"><strong>Logado com sucesso!</strong> Você será redirecionado :)</div>';
                          header("Refresh: 5; url=paginas/home.php?acao=bemvindo");
                      } else {
                          echo '<div class="alert alert-danger"><strong>Erro!</strong> Senha incorreta.</div>';
                          header("Refresh: 7; url=index.php");
                      }
                  } else {
                      echo '<div class="alert alert-danger"><strong>Erro!</strong> E-mail não encontrado.</div>';
                      header("Refresh: 7; url=index.php");
                  }
              } catch (PDOException $e) {
                  error_log("ERRO DE LOGIN DO PDO: " . $e->getMessage());
                  echo '<div class="alert alert-danger"><strong>Erro!</strong> Ocorreu um erro. Tente novamente mais tarde.</div>';
              }
          } else {
              echo '<div class="alert alert-danger"><strong>Erro!</strong> Todos os campos são obrigatórios.</div>';
          }
      }
    ?>

    <div class="link-cadastro">
      <a href="cad_user.php">Ainda não possui cadastro? Cadastre-se aqui.</a>
    </div>
  </div>
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
