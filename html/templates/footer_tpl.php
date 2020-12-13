    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">

            <?php if ($_SERVER['PHP_SELF'] == '/index.php') { ?> 
                <li> Home </li> 
            <?php } ?>

            <?php if ($_SERVER['PHP_SELF'] == '/servicePrice.php') { ?> 
                <li><a href="index.php"> Home </a></li>
                <li> Price List </li> 
            <?php } ?>

            <?php if ($_SERVER['PHP_SELF'] == '/login.php') { ?> 
                <li><a href="index.php"> Home </a></li>
                <li> Login </li> 
            <?php } ?>

            <?php if ($_SERVER['PHP_SELF'] == '/dentist.php') { ?> 
                <li><a href='index.php'> Home </a></li>
                <li><a href='dentist.php'> Profile </a></li>
                <li> Schedule </li>
            <?php } ?>

            <?php if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php') { ?> 
                <li><a href='index.php'> Home </a></li>
                <li><a href='dentist.php'> Profile </a></li>
                <li> Appointments </li>
            <?php } ?>

            <?php if ($_SERVER['PHP_SELF'] == '/manageTeam.php') { ?> 
                <li><a href='index.php'> Home </a></li>
                <li><a href='dentist.php'> Profile </a></li>
                <li> Manage Team </li>
            <?php } ?>

            <?php if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary.php') { ?> 
                <li><a href='index.php'> Home </a></li>
                <li><a href='dentalAuxiliary.php'> Profile </a></li>
                <li> Schedule </li>
            <?php } ?>

            <?php if ($_SERVER['PHP_SELF'] == '/manage_material.php') { ?> 
                <li><a href='index.php'> Home </a></li>
                <li><a href='dentalAuxiliary.php'> Profile </a></li>
                <li> Material Management </li>
            <?php } ?>

            <?php if ($_SERVER['PHP_SELF'] == '/material_per_service.php') { ?> 
                <li><a href='index.php'> Home </a></li>
                <li><a href='dentalAuxiliary.php'> Profile </a></li>
                <li><a href="manage_material.php"> Material Management </a></li>
                <li> Material per Service </li>
            <?php } ?>

            <?php if ($_SERVER['PHP_SELF'] == '/client.php') { ?> 
                <li><a href='index.php'> Home </a></li>
                <li><a href='client.php'> Profile </a></li>
                <li> Book Appointment </li>
            <?php } ?>

            <?php if ($_SERVER['PHP_SELF'] == '/clientRecord.php') { ?> 
                <li><a href='index.php'> Home </a></li>
                <li><a href='client.php'> Profile </a></li>
                <li> Record </li>
            <?php } ?>

        </ul>
        <p>&copy; Denticare Clinic, 2020</p>
    </footer>

</body>

</html>