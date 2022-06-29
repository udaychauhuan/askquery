<?php

$image = "assets/female_pic.jpg";
if ($FRIEND_ROW['gender'] == "male") {
    # code...
    $image = "assets/male_pic.jpg";
}
if (file_exists($FRIEND_ROW['profile_image'])) {
    # code...
    $image = $FRIEND_ROW['profile_image'];
}

?>
<!-- first user -->
<div class="row" id="friends">
    <div class="col-3 py-2 ">
        <!-- user profile image -->
        <img src="<?php echo $image ?>" style="height: 50px; width: 50px;" class="rounded-circle" alt="">
    </div>
    <div class="col-9 fs-6 ">
        <a href="profile.php?id=<?php echo $FRIEND_ROW['userid'] ?>" class="text-reset text-decoration-none">
            <!-- user name -->
            <h3 class="fs-4"><?php echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name']  ?></h3>
            <!-- Discription -->
            <p class="text-capitalize fs-4"><?php echo $FRIEND_ROW['work'] ?></p>
        </a>
    </div>

</div>