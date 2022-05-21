<?php

include_once('DbConnection.php');

class DBOperations extends DbConnection {

    public function check_existing_user($email){
        $sql = "SELECT * FROM users WHERE email = '{$email}' ";
        $email_check_query = mysqli_query($this->connection, $sql);
        $rowCount = mysqli_num_rows($email_check_query);
        return $rowCount;
    }

    public function number_of_rows_in_users_table(){
        $sql = "SELECT * FROM users";
        $rowCount = 0;
        $result = mysqli_query($this->connection, $sql);
        $rowCount = mysqli_num_rows($result);
        return $rowCount;
    }

    public function number_of_rows_in_pages_table(){
        $sql = "SELECT * FROM pages";
        $rowCount = 0;
        $result = mysqli_query($this->connection, $sql);
        $rowCount = mysqli_num_rows($result);
        return $rowCount;
    }

    public function number_of_rows_in_posts_table(){
        $sql = "SELECT * FROM posts";
        $rowCount = 0;
        $result = mysqli_query($this->connection, $sql);
        $rowCount = mysqli_num_rows($result);
        return $rowCount;
    }

}

class Entity extends DbConnection {

    public $name;
    public $followers;

    public function post_status($post_data){
        echo "i am post_status method";
        pr($post_data);
    }

}

class User extends Entity {

    public $first_name;
    public $last_name;
    public $email;
    public $password;

    public function register($firstname, $lastname, $email, $password, $totalRowcount){
        // clean the form data before sending to database
        $_first_name = mysqli_real_escape_string($this->connection, $firstname);
        $_last_name = mysqli_real_escape_string($this->connection, $lastname);
        $_email = mysqli_real_escape_string($this->connection, $email);
        $_password = mysqli_real_escape_string($this->connection, $password);
        // perform validation
        if(!preg_match("/^[a-zA-Z ]*$/", $_first_name)) {
            $f_NameErr = '<div class="alert alert-danger">
                    Only letters and white space allowed.
                </div>';
        }
        if(!preg_match("/^[a-zA-Z ]*$/", $_last_name)) {
            $l_NameErr = '<div class="alert alert-danger">
                    Only letters and white space allowed.
                </div>';
        }
        if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
            $_emailErr = '<div class="alert alert-danger">
                    Email format is invalid.
                </div>';
        }
        if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $_password)) {
            $_passwordErr = '<div class="alert alert-danger">
                     Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                </div>';
        }

        // Password hash
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        // Query
        $sql = "INSERT INTO users (id, firstname, lastname, email, password, is_active,
        date_time) VALUES ($totalRowcount+1,'{$firstname}', '{$lastname}', '{$email}', '{$password_hash}', '1', now())";

        // Create mysql query
        $sqlQuery = mysqli_query($this->connection, $sql);

        if(!$sqlQuery){
            die("MySQL query failed!" . mysqli_error($this->connection));
        }
        if($sqlQuery) {
            echo $firstname;
            echo "<br>";
            echo $lastname;
            echo "<br>";
            echo $email;
            echo "<br>";
            echo "User Registered";
            exit();
        }
    }

    public function login($email_signin, $password_signin){

        $user_email = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
        $pswd = mysqli_real_escape_string($this->connection, $password_signin);
        // Query if email exists in db
        $sql = "SELECT * From users WHERE email = '{$email_signin}' ";
        $query = mysqli_query($this->connection, $sql);
        $rowCount = mysqli_num_rows($query);
        // If query fails, show the reason
        if(!$query){
           die("SQL query failed: " . mysqli_error($this->connection));
        }
        if(!empty($email_signin) && !empty($password_signin)){
            if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $pswd)) {
                echo "Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.";
                exit();
            }
            // Check if email exist
            if($rowCount <= 0) {
                echo "User account does not exist..";
                exit();
            } else {
                // Fetch user data and store in php session
                while($row = mysqli_fetch_array($query)) {
                    $id            = $row['id'];
                    $firstname     = $row['firstname'];
                    $lastname      = $row['lastname'];
                    $email         = $row['email'];
                    $pass_word     = $row['password'];
                    $is_active     = $row['is_active'];

                }
                // Verify password
                $password = password_verify($password_signin, $pass_word);
                // Allow only verified user
                if($is_active == '1') {
                    if($email_signin == $email && $password_signin == $password) {
                       $_SESSION['id'] = $id;
                       $_SESSION['firstname'] = $firstname;
                       $_SESSION['lastname'] = $lastname;
                       $_SESSION['email'] = $email;
                       $_SESSION['is_loggedin'] = true;
                       header("Location: ./feed.php");

                    } else {
                        echo "WRONG PASSQWORD, please try again";
                        exit();
                    }
                }
            }
        } else {
            if(empty($email_signin)){
                echo "Email not provided.";
                exit();
            }

            if(empty($password_signin)){
                echo "Password not provided.";
                exit();
            }
        }
    }

    public function is_loggedid(){
        if ($_SESSION['is_loggedin'] == true && !empty($_SESSION['email'])) {
            return true;
        }
        return false;
    }

    public function post($post){

        $person_id  = $_SESSION['id'];

        $dbOpp = new DBOperations();
        $totalRowcount = $dbOpp->number_of_rows_in_posts_table();

        $sql = "INSERT INTO posts (id, created_by, created_by_id, post, date_time) VALUES ($totalRowcount+1, '1', '{$person_id}', '{$post}', now())";
        $sqlQuery = mysqli_query($this->connection, $sql);

        if(!$sqlQuery){
            die("MySQL query failed!" . mysqli_error($this->connection));
        }
        if($sqlQuery) {
            echo "Post Created";
            exit();
        }

    }
}

class page extends Entity {

    public function create($name){

        $person_id  = $_SESSION['id'];

        $dbOpp = new DBOperations();
        $totalRowcount = $dbOpp->number_of_rows_in_pages_table();


        $sql = "INSERT INTO pages (id, name, created_by, is_active, date_time) VALUES ($totalRowcount+1,'{$name}', '{$person_id}', '1',now())";
        $sqlQuery = mysqli_query($this->connection, $sql);
        if(!$sqlQuery){
            die("MySQL query failed!" . mysqli_error($this->connection));
        }
        if($sqlQuery) {
            echo "Page Created";
            exit();
        }

    }

}
