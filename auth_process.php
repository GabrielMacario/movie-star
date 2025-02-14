<?php

    require_once('models/User.php');
    require_once('models/Message.php');
    require_once('dao/UserDAO.php');
    require_once('globals.php');
    require_once('db.php');

    $message = new Message($BASE_URL);

    $userDao = new UserDAO($conn, $BASE_URL);

    // Verifica o tipo de formulario 

    $type = filter_input(INPUT_POST, 'type');

    // Verificação do tipo de formulario

    if ($type === 'register') {

        $name = filter_input(INPUT_POST, 'name');
        $lastname = filter_input(INPUT_POST, 'lastname');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $confirmpassword = filter_input(INPUT_POST, 'confirmpassword');

        // verificar oq falta

        $missingFields = [];

        if (!$name) {
            $missingFields[] = "Nome";
        }
        if (!$lastname) {
            $missingFields[] = "Sobrenome";
        }
        if (!$email) {
            $missingFields[] = "E-mail";
        }
        if (!$password) {
            $missingFields[] = "Senha";
        }
        
        if (!empty($missingFields)) {
            $fields = implode(", ", $missingFields);
            $message->setMessage("Os seguintes campos estão faltando: $fields.", 'error', 'back');
        }

        // Verificações

        if($name && $lastname && $email && $password) {


            if ($password === $confirmpassword) {

                if ($userDao->findByEmail($email) === false) {
                    
                    $user = new User();

                    //criação de token e senha

                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);

                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;

                    $auth = true;

                    $userDao->create($user, $auth);

                } else {

                    $message->setMessage("Usuário já cadastrado, tente outro e-mail.", 'error', 'back');

                }
                
            } else {

                $message->setMessage("As senhas devem ser iguais.", 'error', 'back');

            }
            
        }

        // verificação de dados minimos
       
    } elseif ($type === 'login') {

        # code...

    }
