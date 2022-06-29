<div class=" popular_post ">
    <div class="right_div__title py-4 pl-2 ">
        <h2 class="text-uppercase fs-2">Credentials
            info.</h2>
    </div>
    <div class="right_sub__div shadow">
        <ul class="list-unstyled text-muted ">
            <li><i class="fa fa-suitcase  mb-3  fs-4"> <span class="mx-2 fs-6 fw-light fs-4">Working at</span> <a href="" class="text-reset text-decoration-none fs-3"><strong><?php echo htmlspecialchars($user_data['work']) ?></strong>
                    </a> </i></li>
            <li><i class="fa fa-user-graduate mb-3 fs-4 "> <span class="mx-2 fs-6 fw-light fs-4">Study at</span><a href="" class="text-reset text-decoration-none fs-3"><strong><?php echo htmlspecialchars($user_data['study']) ?></strong>
                    </a> </i></li>
            <li><i class="fa fa-home mb-3 fs-4"><span class="mx-2 fs-6 fw-light fs-4">Lives
                        in</span><a href="" class="text-reset text-decoration-none fs-3"><strong><?php echo htmlspecialchars($user_data['lives']) ?></strong>
                    </a> </i></li>
            <li><i class="fa fa-birthday-cake mb-3 fs-4"> <span class="mx-2 fs-6 fw-light fs-4">Date of birth</span> <a href="#" class="text-reset text-decoration-none fs-3"><strong><?php echo htmlspecialchars($user_data['dob']) ?></strong>
                    </a> </i>
            </li>
            <li><i class="fa fa-rss  mb-3 fs-4 "> <span class="mx-2 fs-6 fw-light fs-4">followed by</span><a href="" class=" text-reset text-decoration-none fs-3"><strong> <span> <?php echo $user_data['likes'] ?></span>
                        </strong></a> people </i>
            </li>
        </ul>
        <div class="d-grid gap-2">
            <?php

            $User = new User();

            if ($User->i_own_user($user_data['userid'], $_SESSION['askquery_userid'])) {
                echo "<button class='btn btn-secondary text-uppercase' type='button'><a class='text-reset text-decoration-none fs-4' href='chang_user_detail.php?change=user_detail&id=$user_data[userid]' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit user details'> Edit Details</a></button>";
            }
            ?>

        </div>
    </div>
</div>