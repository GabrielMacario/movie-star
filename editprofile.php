<?php
  require_once("templates/header.php");

  require_once("models/User.php");
  require_once("dao/UserDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

  $fullName = $user->getFullName($userData);

  if ($userData->image == '') {
    $userData->image = 'user.png';
  }

?>

    <div id="main-container" class="container-fluid">
      <div class="col-md-12">
        <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="type" value="update">
          <div class="row">
            <div class="col-md-4">
              <h1><?= $fullName ?></h1>
              <p class="page-description">Altere seus dados no formulário abaixo:</p>
              <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Digite o seu nome" value="<?= $userData->name ?>">
              </div>
              <div class="form-group">
                <label for="lastname">Sobrenome:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Digite o seu sobrenome" value="<?= $userData->lastname ?>">
              </div>
              <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="text" readonly name="email" id="email" class="form-control disabled" placeholder="Digite o seu email" value="<?= $userData->email ?>">
              </div>
              <input type="submit" value="Alterar" class="btn form-btn">
            </div>
            <div class="col-md-4">
              <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
              <div class="form-group">
                <label for="image">Foto:</label>
                <input type="file" name="image" id="image" class="form-control-file" placeholder="Digite o seu nome" value="<?= $userData->name ?>">
              </div>
              <div class="form-group">
                <label for="bio">Sobre você:</label>
                <textarea class='form-control' name="bio" id="bio" rows='5' placeholder="Conte quem é você, o que faz e onde trabalha..."><?= $userData->bio ?></textarea>
              </div>
            </div>
          </div>
        </form>
        <div class="row" id="change-password-container">
          <div class="col-md-4">
            <h2>Alterar a senha</h2>
            <p class="page-description">Digite a nova senha e confirme para alterar sua senha:</p>
            <form action="<?= $BASE_URL ?>user_process.php" method="post">
              <input type="hidden" name="type" value="changepassword">
              <div class="form-group">
                <label for="password">Senha:</label>
                <input type="text" name="password" id="password" class="form-control" placeholder="Digite a sua nova senha">
              </div>
              <div class="form-group">
                <label for="confirmpassword">Confirmação de senha:</label>
                <input type="text" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Confirme a sua nova senha">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

<?php

require_once("templates/footer.php");

?>