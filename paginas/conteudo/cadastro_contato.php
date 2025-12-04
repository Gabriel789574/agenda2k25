<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); min-height: 100vh;">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-4">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="text-center text-white">
              <i class="fas fa-address-book mr-2"></i>Cadastro de Contatos
            </h1>
            <p class="text-center text-white-50">Gerencie sua lista de contatos de forma simples e eficiente</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content pb-4">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-dark shadow-lg border-0">
              <div class="card-header text-center py-3" style="background: linear-gradient(45deg, #34495e, #2c3e50); border: none;">
                <h3 class="card-title mb-0 text-white">
                  <i class="fas fa-user-plus mr-2"></i>Cadastrar Contato
                </h3>
              </div>

              <!-- form start -->
              <form role="form" action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="card-body p-4" style="background: #1a2530;">
                  
                  <!-- Nome -->
                  <div class="form-group">
                    <label for="nome" class="form-label fw-bold text-white">
                      <i class="fas fa-user mr-2 text-info"></i>Nome Completo
                    </label>
                    <input type="text" class="form-control bg-dark text-white border-dark" 
                           name="nome" id="nome" required 
                           placeholder="Digite o nome do contato"
                           style="border-bottom: 2px solid #3498db;">
                    <div class="invalid-feedback text-warning">Por favor, informe o nome do contato.</div>
                  </div>

                  <!-- Telefone -->
                  <div class="form-group">
                    <label for="telefone" class="form-label fw-bold text-white">
                      <i class="fas fa-phone mr-2 text-info"></i>Telefone
                    </label>
                    <input type="text" class="form-control bg-dark text-white border-dark" 
                           name="telefone" id="telefone" required 
                           placeholder="(00) 00000-0000"
                           style="border-bottom: 2px solid #3498db;">
                    <div class="invalid-feedback text-warning">Por favor, informe o telefone.</div>
                  </div>

                  <!-- Email -->
                  <div class="form-group">
                    <label for="email" class="form-label fw-bold text-white">
                      <i class="fas fa-envelope mr-2 text-info"></i>Endereço de E-mail
                    </label>
                    <input type="email" class="form-control bg-dark text-white border-dark" 
                           name="email" id="email" required 
                           placeholder="Digite o e-mail"
                           style="border-bottom: 2px solid #3498db;">
                    <div class="invalid-feedback text-warning">Por favor, informe um e-mail válido.</div>
                  </div>
                  
                  <!-- Foto -->
                  <div class="form-group">
                    <label for="foto" class="form-label fw-bold text-white">
                      <i class="fas fa-camera mr-2 text-info"></i>Foto do Contato
                    </label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input bg-dark text-white" 
                               name="foto" id="foto" accept="image/*">
                        <label class="custom-file-label bg-dark text-white border-dark" 
                               for="foto" style="border-bottom: 2px solid #3498db;">
                          Selecione uma imagem
                        </label>
                      </div>
                    </div>
                    <small class="form-text text-muted">Formatos: PNG, JPG, JPEG, GIF (Máx: 2MB)</small>
                  </div>

                  <!-- ID User Hidden -->
                  <div class="form-group">
                    <?php
                    // Obter ID do usuário da sessão
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    $id_user = isset($_SESSION['senhaUser']) ? $_SESSION['senhaUser'] : 1;
                    ?>
                    <input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user; ?>">
                  </div>

                  <!-- Termos -->
                  <div class="form-check mt-4">
                    <input type="checkbox" class="form-check-input bg-dark" id="termos" required>
                    <label class="form-check-label text-white" for="termos">
                      <i class="fas fa-check-circle mr-2 text-success"></i>Autorizo o cadastro deste contato
                    </label>
                    <div class="invalid-feedback text-warning">Você deve autorizar o cadastro.</div>
                  </div>
                </div>

                <!-- Botão Cadastrar -->
                <div class="card-footer text-center py-3" style="background: #1a2530; border-top: 1px solid #34495e;">
                  <button type="submit" name="botao" class="btn btn-info btn-lg px-5 shadow-sm" 
                          style="background: linear-gradient(45deg, #3498db, #2980b9); border: none;">
                    <i class="fas fa-save mr-2"></i>Cadastrar Contato
                  </button>
                </div>
              </form>

              <!-- PHP para processamento -->
              <?php
                include('../config/conexao.php');

                if (isset($_POST['botao'])) {
                    $nome = $_POST['nome'];
                    $telefone = $_POST['telefone'];
                    $email = $_POST['email'];
                    $id_usuario = $_POST['id_user'];

                    $formatP = array("png", "jpg", "jpeg", "JPG", "gif");
                    $pasta = "../img/cont/";
                    
                    // Criar diretório se não existir
                    if (!is_dir($pasta)) {
                        mkdir($pasta, 0755, true);
                    }

                    // Processar upload da imagem
                    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                    
                        if (in_array($extensao, $formatP)) {
                            $temporario = $_FILES['foto']['tmp_name'];
                            $novoNome = uniqid() . ".$extensao";
                        
                            if (move_uploaded_file($temporario, $pasta . $novoNome)) {
                                $foto = $novoNome;
                            } else {
                                echo '<div class="alert alert-warning alert-dismissible fade show mx-3 mt-3">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>Não foi possível fazer o upload da imagem. Usando avatar padrão.
                                      </div>';
                                $foto = 'avatar_padrao.png';
                            }
                        } else {
                            echo '<div class="alert alert-warning alert-dismissible fade show mx-3 mt-3">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>Formato de imagem inválido. Usando avatar padrão.
                                  </div>';
                            $foto = 'avatar_padrao.png';
                        }
                    } else {
                        $foto = 'avatar_padrao.png';
                    }

                    // VERIFICAR SE O USUÁRIO EXISTE (usando a tabela correta tb_user)
                    try {
                        $check_user = $conect->prepare("SELECT id_user FROM tb_user WHERE id_user = :id_user");
                        $check_user->bindParam(':id_user', $id_usuario, PDO::PARAM_INT);
                        $check_user->execute();
                        
                        if ($check_user->rowCount() == 0) {
                            echo '<div class="alert alert-danger alert-dismissible fade show mx-3 mt-3">
                                    <i class="fas fa-times-circle mr-2"></i>Erro: Usuário não encontrado!
                                  </div>';
                            exit;
                        }
                    } catch (PDOException $e) {
                        echo '<div class="alert alert-danger alert-dismissible fade show mx-3 mt-3">
                                <i class="fas fa-times-circle mr-2"></i>Erro ao verificar usuário: ' . $e->getMessage() . '
                              </div>';
                        exit;
                    }
                  
                    // Inserir contato na tabela tb_contatos
                    $cadastro = "INSERT INTO tb_contatos (nome_contatos, fone_contatos, email_contatos, foto_contatos, id_user) VALUES (:nome, :telefone, :email, :foto, :id_user)";
                  
                    try {
                        $result = $conect->prepare($cadastro);
                        $result->bindParam(':nome', $nome, PDO::PARAM_STR);
                        $result->bindParam(':telefone', $telefone, PDO::PARAM_STR);
                        $result->bindParam(':email', $email, PDO::PARAM_STR);
                        $result->bindParam(':foto', $foto, PDO::PARAM_STR);
                        $result->bindParam(':id_user', $id_usuario, PDO::PARAM_INT);
                    
                        $result->execute();
                    
                        $contar = $result->rowCount();
                        if ($contar > 0) {
                            echo '<div class="alert alert-success alert-dismissible fade show mx-3 mt-3">
                                    <i class="fas fa-check-circle mr-2"></i>Contato cadastrado com sucesso!
                                    <button type="button" class="close text-white" data-dismiss="alert">&times;</button>
                                  </div>';
                            echo '<script>setTimeout(function(){ window.location.href = "home.php"; }, 2000);</script>';
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show mx-3 mt-3">
                                    <i class="fas fa-times-circle mr-2"></i>Erro ao cadastrar contato!
                                    <button type="button" class="close text-white" data-dismiss="alert">&times;</button>
                                  </div>';
                        }
                    } catch (PDOException $e) {
                        echo '<div class="alert alert-danger alert-dismissible fade show mx-3 mt-3">
                                <i class="fas fa-database mr-2"></i>Erro: ' . $e->getMessage() . '
                                <button type="button" class="close text-white" data-dismiss="alert">&times;</button>
                              </div>';
                    }
                }
              ?>
            </div>
          </div>
            
          <!-- Right Column - Contatos Recentes -->
          <div class="col-md-8">
            <div class="card card-dark shadow-lg border-0">
              <div class="card-header py-3 text-white" style="background: linear-gradient(45deg, #34495e, #2c3e50); border: none;">
                <h3 class="card-title mb-0">
                  <i class="fas fa-users mr-2"></i>Contatos Recentes
                </h3>
              </div>
              <div class="card-body p-0" style="background: #1a2530;">
                <div class="table-responsive">
                  <table class="table table-dark table-hover mb-0">
                    <thead style="background: #2c3e50;">
                      <tr>
                        <th style="width: 50px" class="text-center">#</th>
                        <th style="width: 80px">Foto</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th style="width: 120px" class="text-center">Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Consulta corrigida para usar a tabela tb_contatos
                      $select = "SELECT * FROM tb_contatos WHERE id_user = :id_user ORDER BY id_contatos DESC LIMIT 6";
                      
                      try {
                          $result = $conect->prepare($select);
                          $cont = 1; 
                          $result->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                          $result->execute();
                          $contar = $result->rowCount();
                          
                          if ($contar > 0) {
                              while ($show = $result->FETCH(PDO::FETCH_OBJ)) {
                      ?>  
                      <tr style="border-bottom: 1px solid #34495e;">
                        <td class="text-center fw-bold text-info"><?php echo $cont++; ?></td>
                        <td>
                          <?php 
                          $imagem_path = "../img/cont/" . $show->foto_contatos;
                          if (file_exists($imagem_path) && $show->foto_contatos != 'avatar_padrao.png') {
                              echo '<img src="'.$imagem_path.'" alt="Foto do contato" class="rounded-circle shadow" style="width:45px; height:45px; object-fit:cover; border: 2px solid #3498db;">';
                          } else {
                              echo '<div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center shadow" style="width:45px; height:45px;">
                                      <i class="fas fa-user text-light"></i>
                                    </div>';
                          }
                          ?>
                        </td>
                        <td>
                          <div class="fw-bold text-white"><?php echo htmlspecialchars($show->nome_contatos); ?></div>
                        </td>
                        <td>
                          <span class="text-info"><?php echo htmlspecialchars($show->fone_contatos); ?></span>
                        </td>
                        <td>
                          <span class="text-muted"><?php echo htmlspecialchars($show->email_contatos); ?></span>
                        </td>
                        <td class="text-center">
                          <div class="btn-group btn-group-sm">
                            <a href="home.php?acao=editar&id=<?php echo $show->id_contatos; ?>" 
                               class="btn btn-outline-info" title="Editar Contato">
                              <i class="fas fa-edit"></i>
                            </a>
                            <a href="conteudo/del-contato.php?idDel=<?php echo $show->id_contatos; ?>" 
                               onclick="return confirm('Deseja remover o contato \'<?php echo addslashes($show->nome_contatos); ?>\'?')" 
                               class="btn btn-outline-danger" title="Remover Contato">
                              <i class="fas fa-trash"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <?php
                              }
                          } else {
                              echo '<tr>
                                      <td colspan="6" class="text-center py-4">
                                        <div class="text-muted">
                                          <i class="fas fa-user-slash fa-2x mb-3"></i>
                                          <br>
                                          Nenhum contato cadastrado ainda.
                                        </div>
                                      </td>
                                    </tr>';
                          }
                      } catch (PDOException $e) {
                          echo '<tr>
                                  <td colspan="6" class="text-center py-4 text-danger">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>Erro ao carregar contatos.
                                  </td>
                                </tr>';
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Card Estatísticas -->
            <div class="card card-dark shadow-lg border-0 mt-4">
              <div class="card-header py-3 text-white" style="background: linear-gradient(45deg, #34495e, #2c3e50); border: none;">
                <h3 class="card-title mb-0">
                  <i class="fas fa-chart-pie mr-2"></i>Estatísticas
                </h3>
              </div>
              <div class="card-body" style="background: #1a2530;">
                <div class="row text-center">
                  <div class="col-md-6 mb-3">
                    <div class="stat-card p-3 rounded" style="background: linear-gradient(45deg, #3498db, #2980b9);">
                      <i class="fas fa-users fa-2x text-white mb-2"></i>
                      <h4 class="text-white mb-1">
                        <?php 
                        try {
                            $count_contatos = $conect->prepare("SELECT COUNT(*) as total FROM tb_contatos WHERE id_user = :id_user");
                            $count_contatos->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                            $count_contatos->execute();
                            $resultado = $count_contatos->fetch(PDO::FETCH_ASSOC);
                            echo $resultado['total'];
                        } catch (PDOException $e) {
                            echo '0';
                        }
                        ?>
                      </h4>
                      <p class="text-white-50 mb-0">Total de Contatos</p>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="stat-card p-3 rounded" style="background: linear-gradient(45deg, #3498db, #2980b9);">
                      <i class="fas fa-user-plus fa-2x text-white mb-2"></i>
                      <h4 class="text-white mb-1">
                        <?php 
                        try {
                            $count_recentes = $conect->prepare("SELECT COUNT(*) as recentes FROM tb_contatos WHERE id_user = :id_user");
                            $count_recentes->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                            $count_recentes->execute();
                            $resultado_recentes = $count_recentes->fetch(PDO::FETCH_ASSOC);
                            echo $resultado_recentes['recentes'];
                        } catch (PDOException $e) {
                            echo '0';
                        }
                        ?>
                      </h4>
                      <p class="text-white-50 mb-0">Meus Contatos</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card Estatísticas Expandido -->
            <div class="card card-dark shadow-lg border-0 mt-4">
              <div class="card-header py-3 text-white" style="background: linear-gradient(45deg, #34495e, #2c3e50); border: none;">
                <h3 class="card-title mb-0">
                  <i class="fas fa-chart-bar mr-2"></i>Detalhes dos Contatos
                </h3>
              </div>
              <div class="card-body" style="background: #1a2530;">
                <div class="row text-center">
                  <div class="col-md-4 mb-3">
                    <div class="stat-card p-3 rounded" style="background: linear-gradient(45deg, #27ae60, #2ecc71);">
                      <i class="fas fa-envelope fa-2x text-white mb-2"></i>
                      <h4 class="text-white mb-1">
                        <?php 
                        try {
                            $count_com_email = $conect->prepare("SELECT COUNT(*) as com_email FROM tb_contatos WHERE id_user = :id_user AND email_contatos != ''");
                            $count_com_email->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                            $count_com_email->execute();
                            $resultado_email = $count_com_email->fetch(PDO::FETCH_ASSOC);
                            echo $resultado_email['com_email'];
                        } catch (PDOException $e) {
                            echo '0';
                        }
                        ?>
                      </h4>
                      <p class="text-white-50 mb-0">Com E-mail</p>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="stat-card p-3 rounded" style="background: linear-gradient(45deg, #e67e22, #d35400);">
                      <i class="fas fa-camera fa-2x text-white mb-2"></i>
                      <h4 class="text-white mb-1">
                        <?php 
                        try {
                            $count_com_foto = $conect->prepare("SELECT COUNT(*) as com_foto FROM tb_contatos WHERE id_user = :id_user AND foto_contatos != 'avatar_padrao.png' AND foto_contatos IS NOT NULL");
                            $count_com_foto->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                            $count_com_foto->execute();
                            $resultado_foto = $count_com_foto->fetch(PDO::FETCH_ASSOC);
                            echo $resultado_foto['com_foto'];
                        } catch (PDOException $e) {
                            echo '0';
                        }
                        ?>
                      </h4>
                      <p class="text-white-50 mb-0">Com Foto</p>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <div class="stat-card p-3 rounded" style="background: linear-gradient(45deg, #e74c3c, #c0392b);">
                      <i class="fas fa-user-times fa-2x text-white mb-2"></i>
                      <h4 class="text-white mb-1">
                        <?php 
                        try {
                            $count_sem_foto = $conect->prepare("SELECT COUNT(*) as sem_foto FROM tb_contatos WHERE id_user = :id_user AND (foto_contatos IS NULL OR foto_contatos = 'avatar_padrao.png')");
                            $count_sem_foto->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                            $count_sem_foto->execute();
                            $resultado_sem_foto = $count_sem_foto->fetch(PDO::FETCH_ASSOC);
                            echo $resultado_sem_foto['sem_foto'];
                        } catch (PDOException $e) {
                            echo '0';
                        }
                        ?>
                      </h4>
                      <p class="text-white-50 mb-0">Sem Foto</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <style>
    .form-control:focus {
      border-color: #3498db;
      box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
      background: #2c3e50;
      color: white;
    }
    
    .custom-file-input:focus ~ .custom-file-label {
      border-color: #3498db;
      box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }
    
    .stat-card {
      transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
    }
    
    .table-hover tbody tr:hover {
      background-color: rgba(52, 152, 219, 0.1) !important;
    }
    
    .bg-dark {
      background-color: #2c3e50 !important;
    }
    
    .card-dark {
      background: #1a2530;
      color: white;
    }
    
    .alert {
      border-radius: 8px;
      border: none;
      margin: 10px;
    }
  </style>

  <script>
    // Validação do formulário
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();

    // Preview do nome do arquivo selecionado
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
      var fileName = document.getElementById("foto").files[0].name;
      var nextSibling = e.target.nextElementSibling;
      nextSibling.innerText = fileName;
    });

    // Máscara para telefone
    document.getElementById('telefone').addEventListener('input', function(e) {
      var value = e.target.value.replace(/\D/g, '');
      if (value.length <= 11) {
        if (value.length <= 10) {
          value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        } else {
          value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        }
        e.target.value = value;
      }
    });

    // Auto-dismiss alerts após 5 segundos
    setTimeout(function() {
      var alerts = document.querySelectorAll('.alert');
      alerts.forEach(function(alert) {
        var bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
      });
    }, 5000);
  </script>