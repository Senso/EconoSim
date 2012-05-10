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
        <li><a href="/">Home</a></li>
        <li><a href="/company/info/<?php echo $comp_id; ?>">Company</a></li>
        <li><a href="/company/buildings/">Buildings</a></li>
        <li><a href="/market/">Market</a></li>
        <li><a href="#">R&D</a></li>
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

