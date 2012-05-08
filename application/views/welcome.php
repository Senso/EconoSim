<h2>Some kind of Capitalism Simulator?!</h2>

Hi, <strong><?php echo $username; ?></strong>! You are logged in now. <?php echo anchor('/auth/logout/', 'Logout'); ?>

<hr>

<?php
    if ($company) {
        echo 'Your company is ' . $company . '.';
    }
    else {
        echo 'You do not have a company created yet. <a href="/company/new/">Create one</a>.';
    }
?>

