<?php
$dbh = new PDO('sqlite:sql/dentist_office.db');
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


$stmt = $dbh->prepare('SELECT * FROM material ORDER BY name');
$stmt->execute();

$stmt2 = $dbh->prepare('SELECT * FROM service ORDER BY specialty_type ');
$stmt2->execute();

$ser = array();

$spec_type = array();

while ($types = $stmt2->fetch()) {

    array_push($spec_type, $types['specialty_type']);

    $ser[$types['procedure_name']] = $types['specialty_type'];
}
$uni_spec_type = array_values(array_unique($spec_type));



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
        <?php $mat_names = array();
        while ($row = $stmt->fetch()) {

            array_push($mat_names, $row['name']); ?>
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
            <?php for ($i = 0; $i < count($uni_spec_type); $i++) {
                $a = 0 ?>
                <optgroup label="<?php echo $uni_spec_type[$i] ?>">
                    <?php foreach ($ser as $procedure => $type) { ?>
                        <?php if ($type == $uni_spec_type[$i]) { ?>
                            <option value="<?php echo $procedure ?>"> <?php echo $procedure; ?> </option>
                        <?php } ?>
                    <?php } ?>
                </optgroup>
            <?php } ?>
        </select>

        <input type="submit" value="Checkout service material">
    </form>


    <div id="management">

        <h2>Withdrawal</h2>
        <h2>Insert</h2>


        <form action="/action_manage_material.php" id="remove_from_stock" method="post">
            <p>Extra material to remove:</p>
            <select name="material_rem" id="xtra_mat">
                <option hidden disabled selected value> --- select material to remove --- </option>
                <?php $a = 0;
                while ($a < count($mat_names)) { ?>
                    <option value="<?php echo $mat_names[$a] ?>"> <?php echo $mat_names[$a] ?> </option>
                <?php $a++;
                } ?>
            </select>
            <input type="number" name="qtty_rem" id="qty_remove" min="0">

            <!-- <input type="submit" value="Remove" id="remove_mat"> -->
        </form>

        <button type="submit" value="Remove" id="remove_mat" form="remove_from_stock">Remove</button>

        <form action="/action_manage_material.php" id="add_to_stock" method="post">

            <p>New Material to insert:</p>
            <select name="add_material" id="add_material">
                <option hidden disabled selected value> ---- select material to add ---- </option>
                <?php $a = 0;
                while ($a < count($mat_names)) { ?>
                    <option value="<?php echo $mat_names[$a] ?>"> <?php echo $mat_names[$a] ?> </option>
                <?php $a++;
                } ?>
            </select>
            <input type="number" name="qtty_add" id="qty_add" min="0">

            <!-- <input type="submit" value="Add" id="add_mat"> -->
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