<h2>Some kind of Capitalism Simulator?!</h2>

Hi, <strong><?php echo $username; ?></strong>! You are logged in now. <?php echo anchor('/auth/logout/', 'Logout'); ?>

<hr>

<?php
    if ($data['company']) {
        echo 'Your company is ' . $data['company'] . '.';
    }
    else {
        echo 'You do not have a company created yet.';
    }
?>

