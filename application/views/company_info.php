<html>
<head>
<title>Company Info</title>
</head>
<body>

<?php
    print_r($owner_info);
?>

Name: <?php echo $info->name; ?> <br />
Owner: <a href='/user/info/<?php echo $info->owner;?>'><?php echo $owner_info->username; ?></a> <br />
Created: <?php echo $info->creation_date; ?> <br />


</body>
</html>