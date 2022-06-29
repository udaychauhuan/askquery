<?php
$image = "assets/male_pic.jpg";

if ($ROW_USER['gender'] == "male") {
    # code...
    $image = "assets/female_pic.jpg";
}
if (file_exists($ROW_USER['profile_image'])) {
    # code...
    $image = $ROW_USER['profile_image'];
}
?>

<div class="col-12  p-3 card post ">

    <!-- user-image -->
    <div class="d-flex ">
        <img src="<?php echo $image ?>" style="height: 60px; width: 60px;" class="rounded-circle shadow" alt="">
    </div>

    <!-- <a href="" class="test-reset text-muted text-decoration-none ">Edit</a> / <a href="" class="test-reset text-decoration-none text-muted">Delete</a> -->
    </p>
    <!-- user-image -->


    <div class="d-flex justify-content-center align-items-center flex-column mx-5  pb-1" style="margin-top: -14px;">

        <h2 class="text-uppercase th ">
            <!-- post title -->
            <?php echo htmlspecialchars($ROW['post_title']) ?>
            <!-- post title -->

        </h2>

        <p class="blog_title td">
            <span class="font-weight-bold ">
                <!-- title discription -->
                <?php echo htmlspecialchars($ROW['post_dis']) ?>
                <!-- title discription -->


            </span>
            <!-- post date  -->
            <span class="fw-light">
                <?php echo $ROW['date'] ?>
            </span>

            <!-- post date  -->

        </p>
    </div>
    <figure class="right_side_img mb-4 d-flex justify-content-center shadow">
        <!-- post image -->
        <?php
        $post_image = " ";
        if (file_exists($ROW['image'])) {
            $post_image = $ROW['image'];
        }
        ?>
        <img src="<?php echo $post_image  ?>" class="img-fluid shadow-lg" style="max-height: 500px ! important; max-width: 100% ! important;">
        <!-- post image -->
    </figure>
    <p class="mb-3">
        <span class="font-weight-bold text-uppercase fw-bold mx-1">
            <!-- user name -->
            <?php echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['last_name']) ?>
            <!-- user name -->
        </span>
        <!-- mian post -->
        <?php echo htmlspecialchars($ROW['post']) ?>
        <!-- mian post -->
    </p>

</div>