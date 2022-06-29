<?php

session_start();

include("include/classloader.php");

//isset($_SESSION['askquery_userid']);

$login = new Login();
$user_data = $login->check_login($_SESSION['askquery_userid']);

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

    <!-- css link    -->
    <link rel="stylesheet" href="css/style_index.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <title>AsKquery</title>
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

<body>

    <!-- header -->

    <!-- white background -->
    <section class="bg-white shadow  mb-2 bg-body rounded ">

        <!-- top most links -->
        <ul class="nav nav-pills nav-fill shadow-none">
            <li class="nav-item  ">
                <a class="nav-link " href="index.php">
                    <h1 style="font-size: 50px;">AsK<span class="badge rounded-pill bg-primary">Qurey?</span></h1>
                </a>
            </li>

            <li class="nav-item ">

            </li>
            <ul class="nav nav-pills nav-fill ">
                <!-- Login and Signup button -->
                <li class="nav-item ">
                    <h4> <a style="font-size: 30px;" class="nav-link" href="login.php">Login</a></h4>
                </li>
                <li class="nav-item ">
                    <h4><a style="font-size: 30px;" class="nav-link" href="signup.php">signup</a></h4>
                </li>
            </ul>
        </ul>

        <!-- main nav bar -->
        <nav class="navbar  navbar-expand-lg navbar-dark bg-dark shadow-lg ">
            <a class="navbar-brand" href="#">
                <img src="<?php echo $sitelogo ?>" alt="" height="45px" width="45px" class="img-fluid mx-5 ">
            </a>

            <button class="navbar-toggler mx-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mx-4   " id="navbarSupportedContent" style="font-size: 20px;">
                <ul class="navbar-nav mr-auto me-auto mb-2 mb-lg-0 " style="margin-right:35rem; ">
                    <li class="nav-item">
                        <a class="nav-link active fs-1" aria-current="page" href="index.php">BlogPort <span><i class="fa fa-newspaper-o"></i></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-1" href="#">QueryPort <span><i class="fa fa-lightbulb"></i></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-1" aria-current="page" href="profile.php"> Profile<span> <i class="fa fa-user"></i></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fs-1" aria-current="page" href="about.php">About Us</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-3" href="profile.php">
                            <?php

                            //$image = "assets/placeholder3.jpg";
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
                            <img src="<?php echo $image ?>" height="40px" width="40px" style="border-radius: 50%;" alt="">

                        </a>
                    </li>
                </ul>
                <!-- search bar -->
                <form class="d-flex" autocomplete="off">
                    <input class="form-control me-2 fs-3" type="search" placeholder="Search" aria-label="Search" style="width:200px; height:35px;">
                    <button class="btn btn-outline-primary " type="submit"><i class="fa fa-search text-white fs-4"></i></button>
                </form>
            </div>
            </div>
        </nav>
        <!-- main nav bar close -->
    </section>


    <hr>
    <div class="main_header">
        <div class="d-flex justify-content-center align-items-center flex-column ">
            <h1 class="main_heading">ASKQUERY</h1>
            <p class="main_heading__para">welcome to the <span class="badge bg-secondary">world of bloggs</span></p>
        </div>
    </div>


    <main>
        <!-- gray section -->
        <section style="background-color: #e0e0eb;">
            <hr>

            <div class="container-fluid ">
                <div class="row ">
                    <!-- to get the space form left and right -->
                    <div class="col-xl-10  col-lg-10 col-md-12 col-11 mx-auto my-5">
                        <div class="row gx-5 mx-sm-auto">

                            <!-- left side of the blog  -->


                            <div class="col-lg-7 col-md-11 col-11 mx-auto">
                                <div class="row gy-5 ">

                                    <!-- our fisrt post -->

                                    <?php
                                    //for page pagination
                                    $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $page_number = ($page_number < 1) ? 1 : $page_number;
                                    $limit = 4;
                                    $offset = ($page_number - 1) * $limit;
                                    //pagination
                                    $pg = pagination_link();

                                    $db = new Database();
                                    $user = new User();
                                    $image = new Image();
                                    $post = new Post();

                                    $follower_id = false;

                                    $followers = $user->get_following($_SESSION['askquery_userid'], "user");
                                    if (is_array($followers)) {

                                        $follower_id = array_column($followers, "userid");
                                        $follower_id = implode("','", $follower_id);
                                    }
                                    if ($follower_id) {
                                        $my_id = $_SESSION['askquery_userid'];
                                        $sql = "select * from posts where userid = '$my_id' || userid  in('" . $follower_id . "') order by id desc limit $limit offset $offset";
                                        $posts = $db->read($sql);
                                    } else {
                                        $posts = false;
                                    }

                                    if (isset($posts) && $posts) {
                                        foreach ($posts as $ROW) {
                                            # code...
                                            $user = new User();
                                            $ROW_USER = $user->get_user($ROW["userid"]);
                                            include("post.php");
                                        }
                                    } else {
                                        include('demo_post.php');
                                    }

                                    ?>
                                </div>
                            </div>
                            <!--  *******************************************************
                **********************************************************.
                right side of the div
                *******************************************************
                **********************************************************
                -->
                            <div class="col-lg-3 col-md-7 col-11  justify-content-end m-lg-0 m-auto my-4 ">
                                <div class="row gy-5 left_div__blog">
                                    <!-- about me -->
                                    <div class="col-12  about_me_div shadow">
                                        <p>Vinod Thapa</p>
                                        <p>Just me, myself and I, exploring the universe of uknownment. I have a heart
                                            of love and a
                                            interest of lorem ipsum and mauris neque quam blog. I want to share my world
                                            with you.
                                        </p>
                                    </div>
                                    <!-- popular post -->
                                    <div class=" popular_post ">
                                        <div class="right_div__title py-4 pl-2 ">
                                            <h2>Popular Posts</h2>
                                        </div>
                                        <div class="right_sub__div shadow">
                                            <div class="row ">
                                                <div class="col-3  popular_post__img1 py-2 pl-2">
                                                </div>
                                                <div class="col-9">
                                                    <h3>Bill Gates</h3>
                                                    <p class="text-capitalize">CEO Microsoft</p>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-3  popular_post__img2 py-2 pl-2">
                                                </div>
                                                <div class="col-9">
                                                    <h3>Mark Zuckerberg </h3>
                                                    <p class="text-capitalize">Programmer</p>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-3  popular_post__img3 py-2 pl-2">
                                                </div>
                                                <div class="col-9">
                                                    <h3>Jeff Bezos</h3>
                                                    <p class="text-capitalize">Amazon</p>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-3  popular_post__img4 py-2 pl-2">
                                                </div>
                                                <div class="col-9">
                                                    <h3>Steve Jobs</h3>
                                                    <p class="text-capitalize">Apple</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- advertise -->
                                    <div class=" right_div_post">
                                        <div class="right_div__title py-4 pl-2 ">
                                            <h2>Advertise</h2>
                                        </div>
                                        <div class="right_sub__div ">
                                            <div class="adevetise_img bg-light shadow">
                                                <p>Ads goes here</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- tags -->
                                    <div class=" right_div_post">
                                        <div class="right_div__title py-4 pl-2 ">
                                            <h2>Tags</h2>
                                        </div>
                                        <div class="tags_main right_sub__div">
                                            <a href="https://youtu.be/5p8e2ZkbOFU" target="_thapa" class="badge shadow text-capitalize"> html </a>
                                            <a href="#" class="badge shadow text-capitalize"> css </a>
                                            <a href="#" class="badge shadow text-capitalize"> js </a>
                                            <a href="#" class="badge shadow text-capitalize"> react </a>
                                            <a href="#" class="badge shadow text-capitalize"> vue </a>
                                            <a href="#" class="badge shadow text-capitalize"> php </a>
                                            <a href="#" class="badge shadow text-capitalize"> python </a>
                                            <a href="#" class="badge shadow text-capitalize"> kotlin </a>
                                            <a href="#" class="badge shadow text-capitalize"> c++ </a>
                                            <a href="#" class="badge shadow text-capitalize"> java </a>
                                        </div>
                                    </div>
                                    <!-- Inspiration -->
                                    <div class=" right_div_post">
                                        <div class="right_div__title py-4 pl-2 ">
                                            <h2>Inspiration</h2>
                                        </div>
                                        <div class="right_sub__div">
                                            <div class="row gx-3">
                                                <div class="col-6">
                                                    <figure>
                                                        <img src="https://images.pexels.com/photos/196659/pexels-photo-196659.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260" class="img-fluid shadow">
                                                    </figure>
                                                </div>
                                                <div class="col-6">
                                                    <figure>
                                                        <img src="https://images.pexels.com/photos/34140/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" class="img-fluid shadow">
                                                    </figure>
                                                </div>
                                                <div class="col-6">
                                                    <figure>
                                                        <img src="https://images.pexels.com/photos/38547/office-freelancer-computer-business-38547.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" class="img-fluid shadow">
                                                    </figure>
                                                </div>
                                                <div class="col-6">
                                                    <figure>
                                                        <img src="https://images.pexels.com/photos/196659/pexels-photo-196659.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260" class="img-fluid shadow">
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Follow Me -->
                                    <div class=" right_div_post">
                                        <div class="right_div__title py-4 pl-2 ">
                                            <h2>Follow Me</h2>
                                        </div>
                                        <div class="right_sub__div d-flex justify-content-around">
                                            <a href="#"> <i class="fab fa-facebook-square fa-3x"></i></a>
                                            <a href="https://www.instagram.com/vinodthapa55/" target="_thapa"> <i class="fab fa-3x fa-instagram"></i></a>
                                            <a href="#"> <i class="fab fa-3x fa-github-square"></i> </a>
                                            <a href="#"> <i class="fab fa-3x fa-twitter-square"></i></a>
                                            <a href="#"> <i class="fab fa-3x fa-youtube-square"></i> </a>
                                            <a href="#"> <i class="fab fa-3x fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <!-- Subscribe -->
                                    <div class=" right_div_post">
                                        <div class="right_div__title py-4 pl-2 ">
                                            <h2>Subscribe</h2>
                                        </div>
                                        <div class="right_sub__div">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Enter your e-mail below and get notified on the latest blog posts.</label>
                                                    <input type="email" class="form-control mt-2" id="exampleFormControlInput1" placeholder="name@example.com">
                                                </div>
                                                <div class="col-12">
                                                    <button class="subs_btn d-block" type="submit">Subscribe</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>



    </main>
    <!-- page pegination buttones -->
    <nav aria-label="Page navigation example p-3 " class="d-flex justify-content-center fs-3 " style="background-color: #e0e0eb; padding:20px;">
        <ul class="pagination ">
            <li class="page-item mx-5 "><a class="page-link text-muted fs-3" href="<?= $pg['prev_page'] ?>"><i class="fa fa-arrow-left fs-5"></i> Previous</a></li>
            <li class="page-item mx-5 "><a class="page-link text-muted fs-3" href="<?= $pg['next_page'] ?>">Next <i class="fa fa-arrow-right fs-5"></i></a></li>
        </ul>
    </nav>
    <!-- page pegination buttones -->

    <!-- footer -->
    <footer>
        <p class="text-center py-3 bg-light">design with love By © uday pratap singh chauhan</p>
    </footer>


    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>