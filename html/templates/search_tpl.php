<?php

    session_start();

    if ($_SERVER['HTTP_REFERER'] == '/dentist.php') {
        $go = "/dentistAppointments.php";
    } else if ($_SERVER['HTTP_REFERER'] == '/dentalAuxiliary.php') {
        $go = "/dentalAuxiliary_appointments.php";
    }

    $clients = getClients();

?>  

    <!-- Section to search for specific clients in the appointments -->
    <form action="action_makeSearch.php" id="search" method="post">
        <label> Client: </label>
        <select name="clientSearch" required="required">
        <?php if(!isset($_SESSION['clientSearch'])) { ?>
            <option value="" selected disabled hidden> Client Name, @username </option>
            <?php foreach ($clients as $client) { ?>
                <option value="<?php echo $client['id']?>"> <?php echo $client['name']?>, @<?php echo $client['username']; ?> </option>
            <?php } ?>
        <?php } else {
            foreach ($clients as $client) {
                if ($client['id'] == $_SESSION['clientSearch']) { ?>
                    <option value="<?php echo $client['id']?>" selected> <?php echo $client['name']?>, @<?php echo $client['username']; ?> </option>
                <?php } else { ?>
                    <option value="<?php echo $client['id']?>"> <?php echo $client['name']?>, @<?php echo $client['username']; ?> </option>
                <?php }
            } 
        } ?>
        </select>
        <button type="submit"> <i class="fa fa-search" id="searchIcon"></i> </button>
    </form>

    <?php if(isset($_SESSION['clientSearch'])){ ?>
        <form action="action_deleteSearch.php" method="post">
            <button type="submit" id="trash"> <i class="fa fa-trash"></i> </button>
        </form>
    <?php } ?>