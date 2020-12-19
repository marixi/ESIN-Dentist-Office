<?php
    $clients = getClients();

    if ($_SERVER['HTTP_REFERER'] == '/dentist.php') {
        $go = "/dentistAppointments.php";
    } else if ($_SERVER['HTTP_REFERER'] == '/dentalAuxiliary.php') {
        $go = "/dentalAuxiliary_appointments.php";
    }

?>    

    <!-- Section to search for specific clients in the appointments -->
    <form action="<?php echo $go ?>" id="search" method="post">
        <label> Client: </label>
        <select name="clientSearch" required="required">
        <option value="" selected disabled hidden> ------- search for a specific client ------- </option>
        <?php foreach ($clients as $client) { ?>
            <option value="<?php echo $client['id']?>"> <?php echo $client['name']?>, @<?php echo $client['username']; ?> </option>
        <?php } ?>
        </select>
        <input type="submit" value="Search">
    </form>
    <form action="action_deleteSearch.php" method="post">
        <input type="submit" value="Delete search">
    </form>
