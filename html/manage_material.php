<?php

    require_once('database/init.php');
    require_once('database/material.php');
    require_once('database/service.php');
    require_once('database/specialty.php');

    $material = getAllMaterial();

    $service = getAllServices();

    $specialty = getAllSpecialties();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/priceTable.css" rel="stylesheet">
    <link href="css/material.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <title>Material Stock</title>
</head>

<body>
    <!-- Header -->
    <header>
        <a href='index.php' title="Home">
            <img src="images/logo.png" alt="Dentist Clinic Logo">
        </a>
        <nav>
            <ul>
                <li><a href='dentalAuxiliary.php' title="Profile"> Profile </a></li>
                <li><a href='/dentalAuxiliary.php#Schedule' title="Schedule"> Schedule </a></li>
                <li><a href=#manage_title title="update_Stock"> Manage Material </a></li>
                <li><a href='action_logout.php' title="Logout"> Logout </a></li>
            </ul>
        </nav>
    </header>

    <!-- Table to display the stock of material still available -->
    <h1 id="stock"> Available Stock </h1>
    <?php
    ?>

    <table>
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
        <label>Service performed to withdraw the predifined material from stock:</label><br>
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
    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="dentalAuxiliary.php">Profile</a></li>
            <li>Stock Management</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

</body>

</html>