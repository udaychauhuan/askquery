<?php

session_start();

include("include/classloader.php");

//isset($_SESSION['askquery_userid']);

$login = new Login();
$user_data = $login->check_login($_SESSION['askquery_userid']);
$Error = "";
$post = new Post();

if (isset($_GET['id'])) {
    # code...
    $ROW = $post->get_one_post($_GET['id']);

    if (!$ROW) {
        # code...
        $Error = "No such post was found !";
    }
} else {

    $Error = "No such post was found !";
}

//posting start from here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- fontawsome cdn  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
    <!-- lightbox cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <title>
        <?php
        $titl = "";
        $chg = "";
        $change = "comment";

        if (isset($_GET['change'])) {
            $change = $_GET['change'];
        }
        if ($change == "comment") {
            # code...
            $chg = "comment's";
        }
        $titl = "Askquery / " . $chg .  " post ";
        ?>
        <?php echo $titl ?>
    </title>
    <style>
    </style>
</head>

<body style="background-color: #e0e0eb;">
    <!-- main nav bar -->
    <nav class=" navbar  navbar-expand-lg navbar-light bg-light shadow-lg">
        <a class="navbar-brand" href="#">
            <!-- site logo  -->
            <img src="<?php echo $sitelogo ?>" alt="Askquery_logo" class="img-fluid mx-5 " height="45px" width="45px" style=" border-radius: 50%;">
        </a>
        <button class=" navbar-toggler mx-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mx-4   " id="navbarSupportedContent" style="font-size: 20px;">
            <ul class="navbar-nav mr-auto me-auto mb-2 mb-lg-0 " style="margin-right:35rem;">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="index.php">BlogPort <span><i class="fa fa-newspaper-o"></i></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">QueryPort <span><i class="fa fa-lightbulb"></i></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="profile.php"> Profile<span> <i class="fa fa-user"></i></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="about.php">About Us</a>
                </li>
            </ul>
            <li class="nav-item dropdown d-flex ">
                <!-- user profile image -->
                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php

                    $image = "assets/female_pic.jpg";

                    if ($user_data['gender'] == "male") {
                        # code...
                        $image = "assets/male_pic.jpg";
                    }
                    if (file_exists($user_data['profile_image'])) {
                        # code...
                        $image = $user_data['profile_image'];
                    }
                    ?> <img src="<?php echo $image ?>" height="40px" width="40px" style=" border-radius: 50%;">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item " href="logout.php">Log out <span class="mx-4 "> <i class="fas fa-sign-out-alt"></i></span></a></li>
                </ul>
            </li>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search "></i></button>
            </form>
        </div>
        </div>
    </nav>
    <!-- main nav bar close -->
    <!-- comment post area -->
    <div class="container card mb-4  my-5 col-lg-5 col-md-11 col-11 mx-auto">
        <form action="" method="post" id="comment_form">
            <?php

            if ($Error != "") {
                # code...
                echo $Error;
            }
            $change = "comment";
            $tit = "";
            if (isset($_GET['change'])) {
                $change = $_GET['change'];
            }

            if ($change == "comment") {
                $tit = "comment's ";
            }
            if (isset($_GET['change']) && is_array($ROW)) {
                $change = $_GET['change'];
                if ($ROW  &&  $change == "comment") {
                    # code...
                    echo '<div class ="text-start text-capitalize fs-3 font-monospace">';
                    echo   $tit . "Post";
                    echo '</div>';

                    echo  '<hr>';

                    $user = new User();
                    $ROW_USER = $user->get_user($ROW['userid']);

                    include("post_Delete.php");


                    echo  "<div class='mb-3 my-2'>";
                    echo  "<div class='form-floating'>
                           <textarea name='comment' class='form-control' placeholder='Leave a comment here' id='floatingTextarea2' style='height: 80px'></textarea>
                           <label for='floatingTextarea2'>Comments</label>
                           </div>";
                    echo '</div>';
                }
            }

            ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="profile.php" class="text-decoration-none text-white">cancel </a></button>
                <input type="hidden" name="comment_user" value="<?php echo $ROW['userid'] ?>">
                <input type="hidden" name="postid" value="<?php echo $ROW['postid'] ?>">
                <button type="submit" value="post" class="btn btn-primary ">
                    comment
                </button>
            </div>
        </form>
        <!-- in case of error -->
        <span class="comment_message"></span>
        <br>
        <!-- comments starts from here  -->
        <div class="display_comments"></div>


        <!-- comment form -->
        <div class="replies" id="reply2">
            <div class="d-flex justify-content-start flex-row align-items-center card reply_card py-3 ">
                <div class=" reply_img mx-2 align-self-center ">
                    <!-- user profile -->
                    <img src="https://img.icons8.com/doodle/48/000000/user-male-skin-type-5.png" />
                </div>
                <div class="reply_text__left mb-2">
                    <p class="blog_title ">
                        <span class="font-weight-bold">
                            <!-- user name  -->

                        </span> Aug 11, 2020, 7:20 PM
                    </p>
                    <p>
                        <!-- comment text -->
                        <?php
                        $comments = $post->get_comments($ROW['postid']);
                        if (is_array($comments)) {
                            # code...
                            foreach ($$comments as $comment) {
                                # code...
                                include("comment.php");
                            }
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <!-- comment form -->


    </div>














    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
</body>

</html>