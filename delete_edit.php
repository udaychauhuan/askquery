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

//if something was posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $change = "";
    if (isset($_GET['change'])) {
        $change = $_GET['change'];
    }
    if ($change == "delete") {
        $post->delete_post($_POST['postid']);
    } else {
        $post->edit_post($_POST, $_FILES);
    }
    header("location:profile.php");
    die;
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
    <title> post
        <?php
        $titl = "";
        $chg = "";
        $change = "profile";

        if (isset($_GET['change'])) {
            $change = $_GET['change'];
        }
        if ($change == "delete") {
            # code...
            $chg = "Delete";
        } else {
            $chg = "Edit";
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
    <!-- delet / edit post area -->
    <div class="container card mb-4  my-5 col-lg-5 col-md-11 col-11 mx-auto">
        <form action="" method="post">
            <?php

            if ($Error != "") {
                # code...
                echo $Error;
            }
            $change = "delete";
            $tit = "";
            if (isset($_GET['change'])) {
                $change = $_GET['change'];
            }

            if ($change == "delete") {
                $tit = "Delete";
            } else {
                $tit = "Edit";
            }

            if (isset($_GET['change']) && is_array($ROW)) {
                $change = $_GET['change'];
                if ($ROW  &&  $change == "delete") {
                    # code...
                    echo '<div class ="text-start text-capitalize fs-3 font-monospace">';
                    echo   $tit . "Post";
                    echo '</div>';

                    echo  '<div class="input-group mb-3 my-3 ">';
                    echo  'are your sure you want to ' . $tit . ' this post ?!...';
                    echo  '</div>';

                    echo  '<hr>';

                    $user = new User();
                    $ROW_USER = $user->get_user($ROW['userid']);

                    include("post_Delete.php");
                } else {

                    echo '<div class ="text-start text-capitalize fs-3 font-monospace">';
                    echo   $tit . "Post";
                    echo '</div>';

                    echo  '<div class="input-group mb-3 my-3 ">';
                    echo  'are your sure you want to ' . $tit . ' this post ?!...';
                    echo  '</div>';

                    echo  '<hr>';

                    echo "<div class='input-group my-4 mb-3'>
                          <span class='input-group-text' id='basic-addon1'> Post titl</span>
                          <input name='post_title' value ='$ROW[post_title]' type='text' class='form-control' placeholder='Post title'
                             aria-label='With textarea aria-describedby=' basic-addon1'>
                      </div>
                     
                      <div class='input-group mb-3'>
                          <input name='post_dis' value ='$ROW[post_dis]' type='text' class='form-control' placeholder='title discription' aria-label='With textarea'
                          aria-describedby='basic-addon2'>
                          <span class='input-group-text' id='basic-addon2'>title
                          discription</span>
                      </div>
                      <div class='input-group'>
                         <textarea name='post' class='form-control' placeholder='$ROW[post]' aria-label='With textarea'
                         style='min-height:156px!important;'></textarea>
                       </div>";
                }
            }

            ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="profile.php" class="text-decoration-none text-white">cancel </a></button>

                <input type="hidden" name="postid" value='<?php echo $ROW['postid'] ?>'>
                <button type="submit" value="post" class="btn btn-primary">

                    <?php
                    $change = "delete";
                    $btn = "";
                    //to check get mood
                    if (isset($_GET['change'])) {
                        $change = $_GET['change'];
                    }
                    if ($change == "delete") {
                        $btn = "Delete";
                    } else {
                        $btn = "Edit";
                    }
                    ?>
                    <?php echo $btn ?>
                </button>
            </div>
        </form>
    </div>
    <!-- delet /edit post area -->

    <?php

    if ($Error != "") {
        # code...
        echo "<footer>";
        echo "<p class='text-center py-5 bg-light fixed-bottom ' >design with love By © chauhan-tech</p>";
        echo "</footer>";
    } else {
        echo "<footer>";
        echo "<p class='text-center py-5 bg-light  '>design with love By © chauhan-tech</p>";
        echo "</footer>";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
</body>

</html>