
<br />
<strong>Building name:</strong> <?php echo $info->name ?> <br />
<strong>Built on:</strong> <?php echo $info->created ?> <br />
<br />
<Strong>Set Production:</strong>
<form action="/building/production" method="post" accept-charset="utf-8">
    <?php echo form_dropdown('choose_prod', $select); ?>
    <input type="submit" value="Submit" />
    
</form>
    
    
?>
