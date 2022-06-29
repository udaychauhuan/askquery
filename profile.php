<?php

session_start();

include("include/classloader.php");
//isset($_SESSION['askquery_userid']);


$login = new Login();
$user_data = $login->check_login($_SESSION['askquery_userid']);

$User = $user_data;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    # code...

    $profile = new Profile();
    $profile_data = $profile->get_profile($_GET['id']);


    if (is_array($profile_data)) {

        $user_data = $profile_data[0];
    }
}
//posting start from here
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # code...

    $login = new Login();
    $user_data = $login->check_login($_SESSION['askquery_userid']);

    $User = $user_data;

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        # code...

        $profile = new Profile();
        $profile_data = $profile->get_profile($_GET['id']);


        if (is_array($profile_data)) {

            $user_data = $profile_data[0];
        }
    }

    //posting start from here
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        # code...
        $post = new Post();
        $id = $_SESSION['askquery_userid'];
        $result = $post->create_post($id, $_POST, $_FILES);

        if ($result == "") {
            # code...
            header("location: profile .php");
            die;
        } else {
            echo '<div class="alert alert-danger alert-dismissible text-center text-capitalize " style= " font-size:20px; " role="alert">';
            echo $result;
            echo '</div>';
        }
    }
}

//collect post info
$post = new Post();
$id = $user_data['userid'];
$posts = $post->get_post($id);

// collect friend
//  $user = new User();
//  $friends = $user->get_friends($id);
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
    <!-- style css -->
    <link rel="stylesheet" href="css/style_profile.css">

    <title>AsKquery / profile</title>
    <style>
        /* post edit and delet button  */
        .dropbtn {
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block !important;
        }

        .blog_left__div .left_div__reply {
            color: var(--btn-font-color);
            border-width: .2rem;
            font-size: var(--btn-font);
            transition: var(--eff);
            padding: .8rem 2rem;
            background-color: var(--btn-color);
            border-color: var(--btn-color);
            font-family: var(--title);
        }

        .replies {
            margin: 2rem 0;
            padding: 1rem 0;
            transition: var(--eff);
            display: none;
        }

        .thapa_show {
            margin: 20px 0;
            transition: var(--eff);
            display: block;
        }
    </style>
</head>

<body style="background-color: #e0e0eb;">
    <!-- main nav bar -->
    <nav class="navbar  navbar-expand-lg navbar-light bg-light shadow-lg fixed-top">
        <img src="<?php echo $sitelogo ?>" alt="" height="45px" width="45px" class="img-fluid mx-5 ">
        </a>
        <button class="navbar-toggler mx-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mx-4   " id="navbarSupportedContent" style="font-size: 20px;">
            <ul class="navbar-nav mr-auto me-auto mb-2 mb-lg-0 " style="margin-right:35rem;">
                <li class="nav-item">
                    <a class="nav-link fs-2 " aria-current="page" href="index.php">BlogPort <span><i class="fa fa-newspaper-o"></i></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-2" href="#">QueryPort <span><i class="fa fa-lightbulb"></i></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active fs-2" aria-current="page" href="profile.php"> Profile<span> <i class="fa fa-user"></i></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-2" aria-current="page" href="about.php">About Us</a>
                </li>
            </ul>
            <li class="nav-item dropdown d-flex ">
                <a class="nav-link dropdown-toggle" href="profile.php" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php

                    $image = "assets/female_pic.jpg";

                    if ($User['gender'] == "male") {
                        # code...
                        $image = "assets/male_pic.jpg";
                    }
                    if (file_exists($User['profile_image'])) {
                        # code...
                        $image = $User['profile_image'];
                    }
                    ?> <img src="<?php echo $image ?>" height="40px" width="40px" style=" border-radius: 50%;">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                    <li><a class="dropdown-item fs-4 " href="#">Action</a></li>
                    <li><a class="dropdown-item fs-4 " href="logout.php">Log out <span class="mx-4 "> <i class="fas fa-sign-out-alt"></i></span></a></li>
                </ul>
            </li>
            <!-- search place holder -->
            <form method="get" action="search.php" class="d-flex" autocomplete="off" style="width:230px; height:35px;">
                <input name="find" class="form-control me-2 fs-4" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search fs-4 "></i></button>
            </form>
        </div>
        </div>
    </nav>
    <!-- main nav bar close -->
    <main>
        <!-- section white-background -->
        <section class="bg-white mn_div mx-3 my-5 shadow mb-4">
            <div class="container">
                <!-- image-section     -->
                <section>
                    <!-- covere-image -->
                    <?php

                    $image = "assets/cover.jpg";

                    if (file_exists($user_data['cover_image'])) {
                        # code...
                        $image = $user_data['cover_image'];
                    }
                    ?> <img src="<?php echo $image ?>" class=" img-fluid shadow-lg rounded " style=" width:100%; max-height:22rem;">
                    <!-- profile-image -->
                    <div class="d-flex justify-content-center">
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
                        ?> <img src="<?php echo $image ?>" class="rounded-circle   position-absolute" style="height:120px;width:120px; margin-top:-60px; border:solid white 1px;  box-shadow: 4px 4px 5px #a3a3c2;">
                    </div>
                </section>
                <!-- image-section     -->
                <!-- user data-section  -->
                <section class="text-center border-bottom" style="margin-top: 50px !important ;">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                            <!-- change image option -->
                            <nav aria-label="breadcrumb" class="d-flex justify-content-center my-3">
                                <ol class="breadcrumb">
                                    <?php

                                    $User = new User();

                                    if ($User->i_own_user($user_data['userid'], $_SESSION['askquery_userid'])) {
                                        echo "
                                    <li class='breadcrumb-item fs-5'><a href='change_profile_cover.php?change=profile' class='text-reset text-decoration-none'>change profile</a></li>
                                    <li class='breadcrumb-item fs-5'><a href='change_profile_cover.php?change=cover' class='text-reset text-decoration-none'>change cover</a></li>";
                                    }
                                    ?> </ol>
                            </nav>
                            <!-- user-name -->
                            <h3 class="fs-1" style="margin-top: -20px;">
                                <strong><?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?></strong>
                            </h3>
                            <!-- discription about the user -->
                            <p class="text-muted fs-3"><?php echo $user_data['user_bio'] ?> </p>
                        </div>
                    </div>
                </section>
                <!-- user data-section  -->
                <!-- section-manu-buttone -->
                <section class="container py-2 manu">
                    <div class="row">
                        <div class="col ">
                            <!-- left button -->
                            <div class="left">
                                <a href="profile.php"><button type="button" class="btn btn-light text-primary fs-4">Posts</button></a>
                                <a href="profile_partition.php?section=photos" class="text-reset"><button type="button" class="btn btn-light text-muted fs-4">Photos</button></a>
                                <a href="profile_partition.php?section=followers" class="text-reset"><button type="button" class="btn btn-light text-muted fs-4">Follower <span class=" text-muted fs-6 fw-light"> <?php echo $user_data['likes'] ?></span></button></a>
                                <div class="btn-group dropend le fs-3">
                                    <button type="button" class="btn btn-light dropdown-toggle  text-muted fs-4" data-bs-toggle="dropdown" aria-expanded="false"> More </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item fs-4" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item fs-4" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item fs-4" href="#">Menu item</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- left button -->
                        </div>
                        <!-- right button -->
                        <div class=" right col-md-auto ">
                            <a href="like.php?type=user&id=<?php echo $user_data['userid'] ?>">
                                <?php


                                $msg = "";
                                $btn_color = false;

                                $unfollowe = "<i class='fas fa-user-plus p-1'></i>";
                                $followed = "<i class='fa fa-user-check p-1'></i>";
                                // // to check who is user

                                $i_liked = false;
                                if (isset($_SESSION['askquery_userid'])) {
                                    $db = new  Database();
                                    $sql = "select likes from likes  where type = 'user' && content_id = '$user_data[userid]' limit 1 ";
                                    $result = $db->read($sql);
                                    if (is_array($result)) {
                                        $likes  = json_decode($result[0]['likes'], true);
                                        $userid1 = array_column($likes, "userid");
                                        if (in_array($_SESSION['askquery_userid'], $userid1)) {
                                            $i_liked = true;
                                        }
                                    }
                                }

                                if ($user_data['likes'] > 0) {
                                    # following start
                                    if ($i_liked) {
                                        # i start follow
                                        $msg = $followed . "<span class='bg-gray text-white p-1'>" . " following "  . "</span>";
                                        $btn_color = true;
                                    } else {
                                        #  im not follow
                                        $msg = $unfollowe . "<span class='bg-gray text-white p-1'>" . "follow" . "</span>";
                                        $btn_color = false;
                                    }
                                } else {
                                    # followwing not start
                                    $msg = $unfollowe . "<span class='bg-gray text-white p-1'>" . "follow" . "</span>";
                                    $btn_color = false;
                                }

                                ?>
                                <button type="button" class="<?php echo ($btn_color) ? "btn btn-primary mr-2 fs-4" : "btn btn-secondary mr-2 fs-3" ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Start follow" value="like">
                                    <?php echo $msg ?>
                                </button>
                            </a>
                        </div>
                        <div class=" right2 col col-lg-2">
                            <?php

                            $User = new User();

                            if ($User->i_own_user($user_data['userid'], $_SESSION['askquery_userid'])) {
                                echo "<button type='button' class='btn btn-secondary fs-4' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit profile'><a class='text-reset text-decoration-none' href='chang_user_detail.php?change=Id_detail&id=$user_data[userid]'><i class='fa fa-pen-nib'></i></a></button>";
                            } else {
                                echo "<button type='button' class='btn btn-secondary mx-2 fs-4' data-bs-toggle='tooltip' data-bs-placement='top' title='send'><i class='fa fa-comments'></i></button>";
                            }
                            ?> </div>
                        <!-- right button -->
                    </div>
                </section>
                <!-- section-manu-buttone -->
            </div>
        </section>
        <!-- section white-background -->
        <!-- section gray-background -->
        <section>
            <div class="container-fluid ">
                <div class="row ">
                    <!-- to get the space form left and right -->
                    <div class="col-xl-10  col-lg-10 col-md-12 col-11 mx-auto my-5">
                        <div class="row gy-5 mx-sm-auto">
                            <!-- left side of the profie  -->
                            <div class="col-lg-3 col-md-7 col-11  justify-content-end m-lg-0 m-auto ">
                                <div class="row gy-5 py-5">

                                    <!-- credentioal cards -->
                                    <?php include("cards/credentioal_card.php") ?>

                                    <!-- image cards -->
                                    <?php include("cards/image_card.php") ?>

                                    <!-- following cards -->
                                    <?php include("cards/following_card.php") ?>

                                </div>
                            </div>
                            <!-- right side of the profie  -->
                            <div class="col-lg-7 col-md-11 col-11 mx-auto">
                                <div class="row gy-5 ">
                                    <!-- posting form  -->
                                    <!-- Button trigger modal -->
                                    <?php

                                    // <!-- user-image -->

                                    $image = "assets/female_pic.jpg";

                                    if ($user_data['gender'] == "male") {
                                        # code...
                                        $image = "assets/male_pic.jpg";
                                    }
                                    if (file_exists($user_data['profile_image'])) {
                                        # code...
                                        $image = $user_data['profile_image'];
                                    }


                                    $User = new User();

                                    if ($User->i_own_user($user_data['userid'], $_SESSION['askquery_userid'])) {

                                        echo "<div class=' col-12 card p-4 shadow'>
                                              <!-- Button trigger modal -->
                                                
                                                <div class='d-flex'>
                                                <img src= '$image' style='height: 50px; width: 50px;'
                                                    class='rounded-circle shadow-lg' alt=''>
                                                </div>
                                        
                                               <!-- Button trigger modal -->
                                               <button type'button'
                                                  class='btn btn-light text-capitalize shadow fs-1 fw-bold lh-base text-black-50'
                                                  data-bs-toggle='modal' data-bs-target='#exampleModal'
                                                  style='margin-top: -50px; margin-left: 60px; border-radius: 20px; background-color: #d9d9d9 !important;'>
                                                       What's your post today ?. 
                                                </button>
                                              <p class='border-top mx-5 my-3 fs-4 text-capitalize fw-light'> you can post from here .
                                             </p>
                                            </div>";
                                    }
                                    ?>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <!-- drop  post  -->
                                            <form method="post" action="profile.php" enctype="multipart/form-data" class="col-12 card p-4 shadow blog_left__div my-5 ">
                                                <h2 class="fs-2">your post ?.</h2>
                                                <br>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-3" id="basic-addon1">Post
                                                        titl</span>
                                                    <input name="post_title" type="text" class="form-control fs-3" placeholder="Post title" aria-label="With textarea aria-describedby=" basic-addon1">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input name="file" type="file" class="form-control fs-3" id="inputGroupFile02">
                                                    <label class="input-group-text fs-3" for="inputGroupFile02">Upload</label>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input name="post_dis" type="text" class="form-control fs-3" placeholder="title discription" aria-label="With textarea" aria-describedby="basic-addon2">
                                                    <span class="input-group-text fs-3" id="basic-addon2">title
                                                        discription</span>
                                                </div>
                                                <div class="input-group">
                                                    <textarea name="post" class="form-control fs-3" placeholder="your post..." aria-label="With textarea" style="min-height:156px!important;"></textarea>
                                                </div>
                                                <br>
                                                <button type="submit" id="post_button" value="post" class="btn btn-outline-success fs-2">Share post</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- posting form  -->
                                <!-- our  posts -->
                                <?php

                                if ($posts) {

                                    foreach ($posts as $ROW) {
                                        # code...
                                        $user = new User();
                                        $ROW_USER = $user->get_user($ROW["userid"]);
                                        include("post.php");
                                    }
                                } else {
                                    include('demo_post.php');
                                }
                                $pg = pagination_link();
                                ?>

                                <!-- our  posts -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- navigation page -->


        <!-- page pegination buttones -->
        <nav aria-label="Page navigation example " class="d-flex justify-content-center ">
            <ul class="pagination ">
                <li class="page-item mx-5 "><a class="page-link text-muted fs-3" href="<?= $pg['prev_page'] ?>"><i class="fa fa-arrow-left fs-5"></i> Previous </a></li>
                <li class="page-item mx-5 "><a class="page-link text-muted fs-3" href="<?= $pg['next_page'] ?>">Next <i class="fa fa-arrow-right fs-5"></i></a></li>
            </ul>
        </nav>
        <!-- page pegination buttones -->

        <!-- section gray-background -->
    </main>

    <footer>
        <p class="text-center py-3 bg-light">design with love By © uday pratap singh chauhan</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>


</body>

</html>