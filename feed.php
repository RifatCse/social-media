<?php

include('api/page.php');
include('api/post.php');
$person = new User();

if($person->is_loggedid() == false){
    header("Location: ./index.php");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Feed</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 25rem">
                <div class="card-body">
                    <!-- <h5 class="card-title text-center mb-4">User Profile</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $_SESSION['firstname']; ?>
                        <?php echo $_SESSION['lastname']; ?></h6>
                        <p class="card-text">Email address: <?php echo $_SESSION['email']; ?></p>
                        <p class="card-text">Is loggedin: <?php echo $_SESSION['is_loggedin']; ?></p> -->

                        <h3>Home page</h3>
                        <br><br>

                        <!-- page create form S -->
                        <div class="">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Create a page</label><br>
                                    <label>Page Name</label>
                                    <input type="text" class="form-control" name="page_name" id="page_name" />
                                </div>
                                <button type="submit" name="create_page" id="create_page" class="btn btn-outline-primary btn-lg btn-block">Create</button>
                            </form>
                        </div>
                        <br><br>
                        <!-- page create form E -->

                        <!-- create post create form S -->
                        <div class="">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>What's on your mind ?</label>
                                    <input type="text" class="form-control" name="post_data" id="post_by_person" />
                                </div>
                                <button type="submit" name="post_by_person" id="post_by_person" class="btn btn-outline-primary btn-lg btn-block">Post</button>
                            </form>
                        </div>
                        <br>
                        <!-- create post create form S -->

                    <br><br>
                    <a class="btn btn-danger btn-block" href="logout.php">Log out</a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
