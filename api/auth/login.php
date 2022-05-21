<?php

    include('classes/class.php');

    $person = new User();

    if(isset($_POST['login'])) {
        $email_signin        = $_POST['email_signin'];
        $password_signin     = $_POST['password_signin'];

        $person->login($email_signin, $password_signin);
    }
?>
