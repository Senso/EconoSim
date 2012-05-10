
<h3>Construction</3>
<?php
    form_open('building/new');
    form_hidden('c_id' $c_id);
    form_dropdown('building_type', $b_types);
    form_submit();
?>

<h3>Factories</h3>

<table>
    <tr><th><strong>Name</strong></th></tr>
<?php
    if ($buildings) {
        foreach ($buildings as $key => $factory) {
            if ($factory->type == 'factory') {
                echo "<tr><td><a href='/building/info/" . $factory->id . "'>" . $factory->name . "</td></tr>";
            }
        }
    }
?>

</table>

<br />

<h3>Stores</h3>

<table>
    <tr><th><strong>Name</strong></th></tr>
<?php
    if ($buildings) {
        foreach ($buildings as $key => $store) {
            if ($store->id == 'store') {
                echo "<tr><td><a href='/building/info/" . $store->id . "'>" . $store->name . "</td></tr>";
            }
        }
    }
?>