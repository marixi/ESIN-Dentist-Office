<?php

    require_once('database/init.php');
    require_once('database/material.php');
    require_once('database/service.php');
    require_once('database/specialty.php');

    $material = getAllMaterial();

    $service = getAllServices();

    $specialty = getAllSpecialties();

    require_once('templates/dental_auxiliary_header_tpl.html'); 
?>

    <!-- Table to display the stock of material still available -->
    <h1 id="stock"> Available Stock </h1>

    <table id="table">
        <tr>
            <th scope="col"> Material Name </th>
            <th scope="col"> Quantity </th>
        </tr>
        <?php 
            foreach ($material as $row) { ?>
                <tr>
                    <td> <?php echo $row['name'] ?></td>
                    <td> <?php echo $row['quantity_in_stock'] ?> </td>
                </tr>
            <?php } ?>
    </table>

    <h1 id="manage_title"> Manage Material </h1>

    <form action="/action_manage_material.php" id="service_applied" method="post">
        <label> Service performed to withdraw the predifined material from stock: </label><br>
        <select name="service" id="service_mat" value="Services">
            <option hidden disabled selected value>------------ select a service ------------ </option>
            <?php 
                foreach($specialty as $uni_spec_type) { ?>
                    <optgroup label="<?php echo $uni_spec_type['type'] ?>">
                    <?php foreach ($service as $procedure) {
                        if ($procedure['specialty_type'] == $uni_spec_type['type']) { ?>
                            <option value="<?php echo $procedure['procedure_name'] ?>"> <?php echo $procedure['procedure_name']; ?> </option>
                        <?php }
                    }
                } ?>
        </select>
        <input type="submit" value="Checkout service material">
    </form>
    
    <p id='mat_per_serv'>To check the materials that each service takes, <a href="material_per_service.php"> click here.</a> </p>

    <?php if (isset($_SESSION['mat_error'])) ?> <p id="err"> <?php { echo $_SESSION['mat_error']; UNSET($_SESSION['mat_error']); } ?>
    
    <div id="management">

        <h2>Withdrawal</h2>
        <h2>Insert</h2>

        <form action="/action_manage_material.php" id="remove_from_stock" method="post">
            <p>Extra material to remove:</p>
            <select name="material_rem" id="xtra_mat">
                <option hidden disabled selected value> --- select material to remove --- </option>
                <?php foreach ($material as $row) { ?>
                    <option value="<?php echo $row['name'] ?>"> <?php echo $row['name'] ?> </option>
                <?php } ?>
            </select>
            <input type="number" name="qtty_rem" id="qty_remove" min="0">
        </form>

        <button type="submit" value="Remove" id="remove_mat" form="remove_from_stock">Remove</button>

        <form action="/action_manage_material.php" id="add_to_stock" method="post">

            <p>New Material to insert:</p>
            <select name="add_material" id="add_material">
                <option hidden disabled selected value> ---- select material to add ---- </option>
                <?php foreach ($material as $row) { ?>
                    <option value="<?php echo $row['name'] ?>"> <?php echo $row['name'] ?> </option>
                <?php } ?>
            </select>
            <input type="number" name="qtty_add" id="qty_add" min="0">

        </form>

        <button type="submit" value="Add" id="add_mat" form="add_to_stock">Add</button>

    </div>
    
    <?php require_once('templates/footer_tpl.php'); ?>