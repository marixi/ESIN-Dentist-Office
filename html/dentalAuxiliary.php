<?php

    require_once('database/init.php');
    require_once('database/dentalAuxiliary.php');
    require_once('database/auxiliariesAssigned.php');
    require_once('database/appointment.php');
    
    $id = $_SESSION['id'];

    $auxiliary = getAuxiliaryInfo($id);

    if (!isset($_SESSION['choice'])) {
        $_SESSION['choice'] = date('Y') . '-W' . date('W');
    }

    require_once('templates/dental_auxiliary_header_tpl.php'); 
    require_once('templates/dental_auxiliary_info_tpl.php'); 
    require_once('templates/schedule_tpl.php'); 
?>

    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li><a href='index.php'>Home</a></li>
            <li><a href='dentalAuxiliary.php'>Profile</a></li>
            <li>Schedule</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

</body>

</html>