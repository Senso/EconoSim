<h2>Some kind of Capitalism Simulator?!</h2>

Hi, <strong><?php echo $username; ?></strong>! You are logged in now. <?php echo anchor('/auth/logout/', 'Logout'); ?>

<hr>

<?php
    if ($company) {
        echo "Your company is <a href='/company/info/" . $company->id . "'>" . $company->name . "</a>.";
    }
    else {
        echo 'You do not have a company created yet. <a href="/company/create/">Create one</a>.';
    }
?>


