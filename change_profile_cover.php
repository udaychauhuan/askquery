<?php

session_start();

include("include/classloader.php");;

//isset($_SESSION['askquery_userid']);

$login = new Login();
$user_data = $login->check_login($_SESSION['askquery_userid']);
//posting start from here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_FILES['file']['name'])  &&  $_FILES['file']['name'] != "") {
        # code...
        if ($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/png") {

            $allowed_size = (1024 * 1024) * 3;

            if ($_FILES['file']['size'] < $allowed_size) {

                // if every thing is fine
                $image_class = new Image();

                //create a folder
                $folder = "upload/" . $user_data['userid'] . "/";

                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $filename = $folder . $image_class->generate_filename(15) . ".jpg";
                move_uploaded_file($_FILES['file']['tmp_name'], $filename);


                if (file_exists($filename)) {

                    $userid = $user_data['userid'];
                    $change = "profile";
                    //to check get mood
                    if (isset($_GET['change'])) {
                        $change = $_GET['change'];
                    }

                    //delet duplicate image

                    if ($change == "profile") {
                        # delet  profile image
                        if (file_exists($user_data['profile_image'])) {
                            unlink($user_data['profile_image']);
                        }
                    } else {
                        # delet cover image
                        if (file_exists($user_data['cover_image'])) {
                            unlink($user_data['cover_image']);
                        }
                    }

                    if ($change == "profile") {
                        # change profile
                        $query = " update users set profile_image ='$filename' where userid = '$userid' limit 1";
                    } else {
                        # change cover
                        $query = " update users set cover_image ='$filename' where userid = '$userid' limit 1";
                    }

                    $db = new Database();
                    $db->save($query);

                    header("location: profile.php");
                    die;
                }
            } else {
                # code...
                echo '<div class="alert alert-danger alert-dismissible text-center text-capitalize " style= " font-size:20px; " role="alert">';
                echo "only size of image is 3 MB or lower is allowed !";
                echo '</div>';
            }
        } else {
            # code...
            echo '<div class="alert alert-danger alert-dismissible text-center text-capitalize " style= " font-size:20px; " role="alert">';
            echo "only 'jpeg' or 'png' formate of a image is allowed !";
            echo '</div>';
        }
    } else {
        # code...
        echo '<div class="alert alert-danger alert-dismissible text-center text-capitalize " style= " font-size:20px; " role="alert">';
        echo "please add a valid image !";
        echo '</div>';
    }
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
        $change = "profile";

        if (isset($_GET['change'])) {
            $change = $_GET['change'];
        }
        if ($change == "profile") {
            # code...
            $chg = "profile";
        } else {
            $chg = "cover";
        }

        $titl = "Askquery /" . "change" . " " . $chg;
        ?>
        <?php echo $titl ?>
    </title>
    <style>
    </style>
</head>

<body style="background-color: #e0e0eb;">
    <!-- main nav bar -->
    <nav class="navbar  navbar-expand-lg navbar-light bg-light shadow-lg">
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
                    ?>
                    <img src="<?php echo $image ?>" height="40px" width="40px" style=" border-radius: 50%;">
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
    <main>
        <!-- section white-background -->
        <section class="bg-white mn_div shadow mb-4">
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
                    ?>
                    <img src="<?php echo $image ?>" class=" img-fluid shadow-lg rounded " style="margin-top:-45px; width:100%; max-height:18rem;">

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
                        ?>

                        <img src="<?php echo $image ?>" class="rounded-circle   position-absolute" style="height:120px;width:120px; margin-top:-60px; border:solid white 1px;  box-shadow: 4px 4px 5px #a3a3c2;">
                    </div>
                </section>
                <!-- image-section     -->
                <!-- user data-section  -->
                <section class="text-center border-bottom" style="margin-top: 100px !important ;">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                            <!-- change image option -->
                            <!-- user-name -->
                            <h3 style="margin-top: -25px;">
                                <strong><?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?></strong>
                            </h3>
                            <!-- discription about the user -->
                            <p class="text-muted"><?php echo $user_data['user_bio'] ?> </p>
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
                                <a href="profile.php" class=" text-reset"><button type="button" class="btn btn-light ">Posts</button></a>
                                <button type="button" class="btn btn-light text-reset">About</button>
                                <a href="profile_partition.php?section=photos" class="text-reset"><button type="button" class="btn btn-light text-reset">Photos</button></a>
                                <a href="profile_partition.php?section=followers" class="text-reset"><button type="button" class="btn btn-light text-reset">Follower <span class="text-muted fs-6 fw-light"> <?php echo $user_data['likes'] ?></span></button></a>
                                <div class="btn-group dropend le">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> More </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
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
                                // to check who is user

                                $i_liked = false;
                                if (isset($_SESSION['askquery_userid'])) {
                                    $db = new  Database();
                                    $sql = "select likes from likes  where type = 'user' && content_id = '$user_data[userid]' limit 1 ";
                                    $result = $db->read($sql);
                                    if (is_array($result)) {
                                        $likes  = json_decode($result[0]['likes'], true);
                                        $userid = array_column($likes, "userid");
                                        if (in_array($_SESSION['askquery_userid'], $userid)) {
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
                                <button type="button" class="<?php echo ($btn_color) ? "btn btn-primary mr-2" : "btn btn-secondary mr-2" ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Start follow" value="like">
                                    <?php echo $msg ?>
                                </button>
                            </a>
                        </div>
                        <div class=" right2 col col-lg-2">
                            <?php
                            $User = new User();
                            if ($User->i_own_user($user_data['userid'], $_SESSION['askquery_userid'])) {
                                echo "<button type='button' class='btn btn-secondary' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit profile'><i class='fa fa-pen-nib'></i></button>";
                            } else {
                                echo "<button type='button' class='btn btn-secondary mx-2' data-bs-toggle='tooltip' data-bs-placement='top' title='send'><i class='fa fa-comments'></i></button>";
                            }
                            ?>
                        </div>
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
                                    <!-- user-information    -->
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4 fw-light text-uppercase "><STRong>Credentials
                                                    info.</STRong>
                                            </h5>
                                            <ul class="list-unstyled text-muted ">
                                                <li><i class="fa fa-suitcase  mb-3"> <span class="mx-2 fs-6 fw-light">Working at</span> <a href="" class="text-reset text-decoration-none"><strong><?php echo htmlspecialchars($user_data['work']) ?></strong>
                                                        </a> </i></li>
                                                <li><i class="fa fa-user-graduate mb-3 "> <span class="mx-2 fs-6 fw-light">Study at</span><a href="" class="text-reset text-decoration-none"><strong><?php echo htmlspecialchars($user_data['study']) ?></strong>
                                                        </a> </i></li>
                                                <li><i class="fa fa-home mb-3"><span class="mx-2 fs-6 fw-light">Lives
                                                            in</span><a href="" class="text-reset text-decoration-none"><strong><?php echo htmlspecialchars($user_data['lives']) ?></strong>
                                                        </a> </i></li>
                                                <li><i class="fa fa-birthday-cake mb-3 "> <span class="mx-2 fs-6 fw-light">Date of birth</span> <a href="#" class="text-reset text-decoration-none"><strong><?php echo htmlspecialchars($user_data['dob']) ?></strong>
                                                        </a> </i>
                                                </li>
                                                <li><i class="fa fa-rss  mb-3 "> <span class="mx-2 fs-6 fw-light">followed by</span><a href="" class="
                                                        text-reset text-decoration-none"><strong> <span> <?php echo $user_data['likes'] ?></span>
                                                            </strong></a> people </i>
                                                </li>
                                            </ul>
                                            <div class="d-grid gap-2">
                                                <?php

                                                $User = new User();

                                                if ($User->i_own_user($user_data['userid'], $_SESSION['askquery_userid'])) {
                                                    echo "<button class='btn btn-secondary text-uppercase mb-3' type='button'><a class='text-reset text-decoration-none' href='chang_user_detail.php?change=userdetail'> Edit Details</a></button>";
                                                }
                                                ?> </div>
                                        </div>
                                    </div>
                                    <!-- image section -->
                                    <div class="card shadow" id="image_sec">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4 fw-light text-uppercase ">
                                                <STRong>Images</STRong>
                                            </h5>
                                            <div class="photo-gallery">
                                                <div class="photo-gallery">
                                                    <?php
                                                    $db = new Database();
                                                    $sql = "select image, postid from posts where has_image = 1 && userid = '$user_data[userid]' order by id desc limit 9";
                                                    $images = $db->read($sql);

                                                    if (is_array($images)) {

                                                        foreach ($images as $image_row) {


                                                            echo "<div class='col-sm-6 col-md-4 col-lg-4 mb-1 item'><a href='$image_row[image]' data-lightbox='photos'><img class='img-fluid img-thumbnail ' src='$image_row[image]' style='background-repeat:no-repeat;background-size:cover; width:100px;height:100px;' ></a></div>";
                                                        }
                                                    } else {
                                                        echo '<div class=" alert-dismissible text-center text-capitalize " style=" font-size:20px; " role="alert">';
                                                        echo "No images were found !..";
                                                        echo '</div>';
                                                    }
                                                    ?>

                                                </div>

                                            </div>
                                            <div class="d-flex">
                                                <a href="#" class="text-capitalize fw-light lh-base text-reset text-decoration-none">show
                                                    all images </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- image section -->
                                    <!-- follower section -->
                                    <!-- <div class="card shadow" id="image_sec">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4 fw-light text-uppercase mb-3 ">
                                                <Strong>Following</Strong>
                                            </h5> <?php

                                                    if ($friends) {

                                                        foreach ($friends as $FRIEND_ROW) {
                                                            # code...

                                                            include("user.php");
                                                        }
                                                    }
                                                    ?> <div class="">
                                                <a href="#" class="text-capitalize fw-light lh-base text-reset text-decoration-none">
                                                    show all followed </a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- follower section -->
                                </div>
                            </div>
                            <!-- right side of the profie  -->
                            <div class="col-lg-7 col-md-11 col-11 mx-auto">
                                <div class="row gy-5 ">
                                    <div class=" col-12 card p-4 shadow">
                                        <h5 class="modal-title mb-3" id="exampleModalLabel">
                                            <!-- display massage for change  -->
                                            <?php
                                            $msg = "";
                                            $chg = "";
                                            $change = "profile";
                                            //to check get mood
                                            if (isset($_GET['change'])) {
                                                $change = $_GET['change'];
                                            }
                                            if ($change == "profile") {
                                                # code...
                                                $chg = "profile";
                                            } else {
                                                $chg = "cover";
                                            }

                                            $msg = "change your " . "" . $chg;
                                            ?>
                                            <?php echo $msg ?>
                                        </h5>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="input-group mb-3">
                                                <input name="file" type="file" class="form-control" id="inputGroupFile02">
                                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="profile.php" class="text-decoration-none text-white">cancel </a></button>
                                                <button type="submit" value="post" class="btn btn-primary">change</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- navigation page -->
        <!-- <nav aria-label="Page navigation example page_nav" style=" display: flex; align-items: center; width:50% ;margin-left:auto;margin-right:auto; margin-top:-30px;">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav> -->
        <!-- navigation page -->
        <!-- section gray-background -->
    </main>

    <footer>
        <p class="text-center py-5 bg-light">design with love By © uday pratap singh chauhan</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
</body>

</html>