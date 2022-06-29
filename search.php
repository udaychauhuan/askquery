<?php

session_start();

include("include/classloader.php");

//isset($_SESSION['askquery_userid']);

$login = new Login();
$user_data = $login->check_login($_SESSION['askquery_userid']);

if (isset($_GET['find'])) {


    $find = addslashes($_GET['find']);
    $sql = "select * from users where first_name like '%$find%' || last_name like '%$find%' limit 10 ";
    $db = new Database();
    $result = $db->read($sql);
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
        Askquery / search user
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
            <!-- search place holder -->
            <form method="get" action="search.php" class="d-flex" autocomplete="off">
                <input name="find" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search "></i></button>
            </form>
        </div>
        </div>
    </nav>
    <!-- main nav bar close -->
    <!-- profile manu nav area -->
    <div class="container card mb-4  my-5 col-lg-6 col-md-11 col-11 mx-auto">

        <?php

        echo "<h5 class='card-title mb-4 fw-light col-11 my-5 col-lg-4 mx-4 text-uppercase mb-3'>";

        $user = new User();
        $image = new Image();

        if (is_array($result) && !empty($result)) {

            foreach ($result as $row) {

                $FRIEND_ROW = $user->get_user($row['userid']);
                include("user.php");
            }
        } else {
            echo "no result found ! ..";
        }
        echo "</div>";
        ?>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="profile.php" class="text-decoration-none text-white">Back</a></button>
        </div>
    </div>
    <!-- delet /edit post area -->

    <?php


    echo "<footer>";
    echo "<p class='text-center py-5 bg-light fixed-bottom ' >design with love By © design with love By © uday pratap singh chauhan</p>";
    echo "</footer>";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
</body>

</html>