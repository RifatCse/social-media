<?php

    // Database connection
    // include('config/db.php');
    include('classes/class.php');

    // Error & success messages
    global $success_msg, $email_exist, $f_NameErr, $l_NameErr, $_emailErr, $_passwordErr;
    global $fNameEmptyErr, $lNameEmptyErr, $emailEmptyErr, $passwordEmptyErr, $email_verify_err, $email_verify_success;

    $person = new User();
    $dbOpp = new DBOperations();

    // Set empty form vars for validation mapping
    $_first_name = $_last_name = $_email = $_password = "";
    if(isset($_POST["submit"])) {
        $firstname     = $_POST["firstname"];
        $lastname      = $_POST["lastname"];
        $email         = $_POST["email"];
        $password      = $_POST["password"];
        // check if email already exist

        $rowCount = $dbOpp->check_existing_user($email);

        // check how mqny rows in databse
        $totalRowcount = $dbOpp->number_of_rows_in_users_table();

        // PHP validation
        // Verify if form values are not empty
        if(!empty($firstname) && !empty($email) && !empty($password)){

            // check if user email already exist
            if($rowCount > 0) {
                $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with email already exist!
                    </div>
                ';
            } else {
                $person->register($firstname, $lastname, $email, $password, $totalRowcount);
            }
        } else {
            if(empty($firstname)){
                $fNameEmptyErr = '<div class="alert alert-danger">
                    First name can not be blank.
                </div>';
            }
            if(empty($lastname)){
                $lNameEmptyErr = '<div class="alert alert-danger">
                    Last name can not be blank.
                </div>';
            }
            if(empty($email)){
                $emailEmptyErr = '<div class="alert alert-danger">
                    Email can not be blank.
                </div>';
            }
            if(empty($password)){
                $passwordEmptyErr = '<div class="alert alert-danger">
                    Password can not be blank.
                </div>';
            }
        }
    }
?>
