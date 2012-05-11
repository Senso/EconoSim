<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" media="all" href="/css/main.css" />
</head>

<body>

<div id='header'>
    <ul id="list-nav">
        <li><a href="/">About</a></li>
        <li><a href="/">Help</a></li>
        <li><a href="/">Forum</a></li>
    </ul>
</div>

<br />

<div id='errors'>
    <strong>
    <font color='red'>
    <?php
        if (isset($errors)) {
            echo htmlentities($errors);
        }
    ?>
    </font>
    </strong>
</div>

