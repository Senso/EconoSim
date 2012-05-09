
<h3>Factories</h3>

<table>
    <tr><th><strong>Name</strong></th></tr>
<?php
    foreach ($buildings as $key => $factory) {
        if ($factory->type == 'factory') {
            echo "<tr><td><a href='/building/info/" . $factory->id . "'>" . $factory->name . "</td></tr>";
        }
    }  
?>

</table>

<br />

<h3>Stores</h3>

<table>
    <tr><th><strong>Name</strong></th></tr>
<?php
    foreach ($buildings as $key => $store) {
        if ($store->id == 'store') {
            echo "<tr><td><a href='/building/info/" . $store->id . "'>" . $store->name . "</td></tr>";
        }
    }  
?>