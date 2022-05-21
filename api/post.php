<?php
    $new_user = new User();

    if(isset($_POST['post_by_person'])) {
        $post  = $_POST['post_data'];

        $new_user->post($post);

        exit();
    }
?>
