<h2><?php echo $user_info->username; ?></h2>

<?php
foreach ($comp_info as $key => $value) {
    echo "Company: " . $value->name . "<br />";
}

?>
