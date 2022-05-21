<?php

    include('classes/class.php');

    $new_page = new page();

    if(isset($_POST['create_page'])) {
        $page_name  = $_POST['page_name'];

        $new_page->create($page_name);

        exit();

        // $person->login($email_signin, $password_signin);
    }
?>
