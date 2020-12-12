<?php

    require_once('database/init.php');
    require_once('database/quantity.php');

    $quantity_list = getAllQuantities();
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/mat_per_service.css" rel="stylesheet">
    <title>Material per Service</title>
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
                <li><a href=#Schedule title="Schedule"> Schedule </a></li>
                <li><a href='manage_material.php' title="Material"> Manage Material </a></li>
                <li><a href='action_logout.php' title="Logout"> Logout </a></li>
            </ul>
        </nav>
    </header>

    <h1>Material needed for each specific service </h1>

    <ul id='serv_material'>
        <?php 
            $j = 0;
            for ($i = 0; $i < count($quantity_list); $i++) {
                if ($quantity_list[$i]['service_name'] != $quantity_list[$i + 1]['service_name']) {  ?>
                    <li id='service_list'>
                        <div id="shadow_box">
                            <h3> <?php echo $quantity_list[$i]['service_name'] ?> </h3>
                            <ul>
                                <?php for (; $j <= $i; $j++) { ?>
                                    <li id="qtty_list"> <?php echo str_pad($quantity_list[$j]['material_name'],30,".") ?><?php echo $quantity_list[$j]['quantity_needed'] ?> </li>
                                    <li id="qtty_list"> <?php echo str_pad($quantity_list['material_name'],30,".") ?><?php echo $quantity_list['quantity_needed'] ?> </li>
                                <?php }
                                $j = $i + 1; ?>
                            </ul>
                        </div>
                    </li>
                <?php } 
            } ?>
    </ul>

     <!-- Footer -->
     <footer>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="dentalAuxiliary.php">Profile</a></li>
            <li><a href="manage_material.php">Material Management</a></li>
            <li>Material per Service</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>


</body>

</html>