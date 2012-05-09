
<h2><?php echo $user_info->username; ?></h2>

<?php
foreach ($comp_info as $key => $value) {
    echo "Company: <a href='/company/info/" . $value->id . "'>" . $value->name . "</a> <br />";
}

?>

