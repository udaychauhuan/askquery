<?php

session_start();

include("include/classloader.php");

//isset($_SESSION['askquery_userid']);

$login = new Login();
$user_data = $login->check_login($_SESSION['askquery_userid']);
$Error = "";

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
        $section = "photos";

        if (isset($_GET['section'])) {
            $section = $_GET['section'];
        }
        if ($section == "photos") {
            # code...
            $chg = "photos";
        } elseif($section == "followings")  {
            $chg = "following";
        } elseif ($section == "followers") {
            $chg = "followers";
        }

        $titl = "Askquery / " . $chg .  " section ";
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
    <!-- profile manu nav area -->
    <div class="container card mb-4  my-5 col-lg-6 col-md-11 col-11 mx-auto">

        <?php
        
        if ($Error != "") {
            # code...
            echo $Error;
        }
        $section = "photos";
        $tit = "";
        if (isset($_GET['section'])) {
            $section = $_GET['section'];
        }

        if ($section == "photos") {
            $tit = "photos";
        } elseif ($section == "followers") {
            $tit = "followers";
        } else {
            $tit = "followings";
        }

        if (isset($_GET['section'])) {

            if ($section == "photos") {
                # code...
                echo '<div class ="text-start text-capitalize fs-3 font-monospace">';
                echo   $tit . "  section ";
                echo "<hr>";
                echo "</div>";
                echo "<div class='container card mb-4 d-inline  col-lg-12 p-5 col-md-11 col-11 mx-auto'>";
                $db = new Database();
                $sql = "select image, postid from posts where has_image = 1 && userid = '$user_data[userid]' order by id desc limit 30";
                $images = $db->read($sql);

                if (is_array($images)) {

                    foreach ($images as $image_row) {


                        echo "<a href='$image_row[image]' class='p-3 d-inline-block' data-lightbox='photos'><img class='img-fluid ' src='$image_row[image]' style='background-repeat:no-repeat;background-size:cover; width:120px;height:120px;' ></a>";
                    }
                } else {
                    echo '<div class=" alert-dismissible text-center text-capitalize " style= " font-size:20px; " role="alert">';
                    echo "No images were found !..";
                    echo '</div>';
                }
                echo "</div>";

            } elseif(isset($_GET['section']) && $section == "followers") {

                echo '<div class ="text-start text-capitalize fs-3 font-monospace">';
                echo   $tit . " section ";
                echo '</div>';
                echo  "<hr>";
                echo   "<h5 class='card-title mb-4 fw-light mx-3 col-11 col-lg-4 text-uppercase mb-3'>";
                $image = new Image();
                $user = new User();
                $post = new Post();

                $follower = $post->get_like($user_data['userid'],"user");
                if (is_array($follower) && !empty($follower)) {

                    foreach ($follower as $followers) {
                        $FRIEND_ROW = $user->get_user($followers['userid']);
                        include("user.php");
                    }
                }else {
                    echo '<div class=" alert-dismissible text-center text-capitalize " style= " font-size:20px; " role="alert">';
                    echo "no follower were found !..";
                    echo '</div>';
                }
                 echo "</div>"; 
            } elseif(isset($_GET['section']) && $section == "followings")
            {
                echo '<div class ="text-start text-capitalize fs-3 font-monospace">';
                echo   $tit . " section ";
                echo '</div>';
                echo  "<hr>";
                echo   "<h5 class='card-title mb-4 fw-light col-11 col-lg-4 mx-4 text-uppercase mb-3'>";
                $image = new Image();
                $user = new User();
                $post = new Post();

                $following = $user->get_followings($user_data['userid'], "user");
                if (is_array($following) && !empty($following)) {

                    foreach ($following as $followings) {
                        $FRIEND_ROW = $user->get_user($followings['userid'],"user");
                        include("user.php");
                    }
                } else {
                    echo '<div class=" alert-dismissible text-center text-capitalize " style= " font-size:20px; " role="alert">';
                    echo "you haven't follow any one !..";
                    echo '</div>';
                }
                 echo "</div>";      
            } 
        }
        ?>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="profile.php" class="text-decoration-none text-white">Back</a></button>
        </div>
    </div>
    <!-- delet /edit post area -->

    <?php

    if ($Error == "") {
        # code...
        echo "<footer>";
        echo "<p class='text-center py-3 bg-light fixed-bottom ' > design with love By © uday pratap singh chauhan</p>";
        echo "</footer>";
    } else {
        echo "<footer>";
        echo "<p class='text-center py-3 bg-light fixed-bottom'> design with love By © uday pratap singh chauhan</p>";
        echo "</footer>";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
</body>

</html>