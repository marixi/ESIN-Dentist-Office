<?php 

    require_once('database/init_db.php');
    require_once('database/material_db.php');
    require_once('database/quantity_db.php');

    if (isset($_POST['service'])) {
        $service = $_POST['service'];
        $quantities = getQuantitiesOfService($service);
        foreach ($quantities as $row) {
            update_material('remove', $row['material_name'], $row['quantity_needed']);
        }
    } else if (isset($_POST['material_rem']) && isset($_POST['qtty_rem'])) {
        $xtra_rem = $_POST['material_rem'];
        $qtty_rem = $_POST['qtty_rem'];
        update_material('remove', $xtra_rem, $qtty_rem);

    } else if (isset($_POST['add_material']) && isset($_POST['qtty_add'])) {
        $new_mat = $_POST['add_material'];
        $qtty_add = $_POST['qtty_add'];
        update_material('add', $new_mat, $qtty_add);
    }

    header('Location: manage_material.php');

?>