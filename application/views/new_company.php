<html>
<head>
<title>New Company</title>
</head>
<body>

<?php
    if ($error) {
        echo '<strong><font color="red">$error</font></strong>';
    }
    else {
        echo validation_errors();
        echo form_open('company/create');
?>
    
        <h5>Company Name</h5>
        <input type="text" name="company_name" value="<?php echo set_value('company_name'); ?>" size="50" />
    
        <div><input type="submit" value="Submit" /></div>
    
        </form>

<?php
    }
?>

</body>
</html>