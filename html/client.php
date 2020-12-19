<?php
    
    require_once('database/init_db.php');
    require_once('database/client_db.php');
    require_once('database/specialty_db.php');
    require_once('database/dentist_db.php');
    require_once('database/appointment_db.php');

    $id = $_SESSION['id'];

    $specialties = getAllSpecialties();

    $dentists = getDentists();

    $max = getLastAppointment();

    include('templates/profile_header_tpl.php');
    include('templates/profile_info_tpl.php');

?>

    <h2> Book Appointment </h2>
    <?php if(isset($_SESSION['msg'])) { ?>
    <p> <?php echo $_SESSION['msg'] ?> See it in <a href='/clientRecord.php#appointment<?php echo $max['maxId'] ?>' title="Appointment Booked" > here. </a> </p>
    <p> <a href='client.php' title="Another One"> Book another one? </a> </p>
    <?php unset($_SESSION['msg']); } 
    else { ?>
    <p> Use the form bellow to book an appointment. </p>
    <p> In need of an urgen appointment for today? <a href='\index.php#contacts' title="Call Us"> Call us! </a> </p>
    <section id="bookApp">
        <form action="action_checkDate.php" method="post">
            <label> Date: </label>
            <input type="date" name="date" min="<?php echo date("Y-m-d", strtotime("+1 day"));?>" <?php if(isset($_SESSION['date'])) { ?> value="<?php echo $_SESSION['date']; }?>" required="required">
            <input type="submit" value="Set">
            <?php if(isset($_SESSION['date']) && !isset($_SESSION['err_msg'])) { ?> <img src="images/tick.png" alt="Accepted"?> </img> <?php } ?>
        </form> 

        <?php if(isset($_SESSION['date'])) { ?>
            <form action="action_setTime.php" method="post">
                <?php 
                    if (isset($_SESSION['err_msg'])) { ?>
                        <p> <?php echo $_SESSION['err_msg'] ?> </p>
                    <?php }
                    else { ?>
                        <label> Time: </label>
                        <select name="time" required="required">
                        <?php $dayOfWeek = date('l', strtotime($_SESSION['date']));
                        
                        function checkAvailableHours($date, $time, $value) {
                            $day = substr($date, 8, 2);
                            $month = substr($date, 5, 2);
                            $year = substr($date, 0, 4);

                            global $dbh;
                            $stmt = $dbh->prepare('SELECT date, time, dentist_id FROM appointment WHERE date = ? AND time = ?');
                            $stmt->execute(array($day.'-'.$month.'-'.$year, $time));
                            $nonAvailable = $stmt->fetchAll();

                            if (count($nonAvailable) == 0) {
                                if (isset($_SESSION['time']) && $value == $_SESSION['time']) { ?>
                                    <option value="<?php echo $value ?>" selected="selected"> <?php echo $time ?> </option>
                                <?php } else { ?>
                                    <option value="<?php echo $value ?>"> <?php echo $time ?> </option>    
                                <?php }
                            }
                            else if (count($nonAvailable) == 1) {
                                $_SESSION['dentistUnavailable'] = ($nonAvailable['0'])['dentist_id'];
                                if (isset($_SESSION['time']) && $value == $_SESSION['time']) { ?>
                                    <option value="<?php echo $value ?>" selected="selected"> <?php echo $time ?> </option>
                                <?php } else { ?>
                                    <option value="<?php echo $value ?>"> <?php echo $time ?> </option>    
                                <?php }
                            }
                        }

                        $arrayWeek = array('09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00');
                        $arrayWeekend = array('09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00');

                        switch($dayOfWeek) {
                            case "Monday": case "Tuesday": case "Wednesday": case "Thursday": case "Friday":
                                $value = 9;
                                foreach ($arrayWeek as $hour) {
                                    checkAvailableHours($_SESSION['date'], $hour, $value);
                                    $value = $value+1;
                                }
                                break;
                            case "Saturday":
                                $value = 9;
                                foreach ($arrayWeekend as $hour) {
                                    checkAvailableHours($_SESSION['date'], $hour, $value);
                                    $value = $value+1;
                                }
                                break;
                        } ?>
                        </select>
                        <input type="submit" value="Set">
                        <?php if(isset($_SESSION['time']) && !isset($_SESSION['err_msg'])) { ?> <img src="images/tick.png" alt="Accepted"?> </img> <?php } ?>
                    <?php }
                ?>
            </form>
        <?php }

        if (isset($_SESSION['time'])) { ?>
            <form action="action_bookAppointment.php" method="post">
                <label> Specialty: </label>
                <select name="specialty" required="required">
                <?php foreach ($specialties as $specialty) { ?>
                    <option value="<?php echo $specialty['type']?>"> <?php echo $specialty['type']?> </option>
                <?php } ?>
                </select>
                <br> <label> Dentist: </label>
                <?php foreach ($dentists as $dentist) {
                    if (isset($_SESSION['dentistUnavailable']) && $dentist['id'] != $_SESSION['dentistUnavailable']) { ?>
                            <input type="radio" name="dentist" value="<?php echo $dentist['id']?>" required="required"> Dr. <?php echo $dentist['name']?> </input>
                        <?php }
                    else if (!isset($_SESSION['dentistUnavailable'])) { ?>
                        <input type="radio" name="dentist" value="<?php echo $dentist['id']?>" required="required"> Dr. <?php echo $dentist['name']?> </input>
                    <?php }
                } ?>
                </br>
                <input type="submit" id="final" value="Submit">
            </form>
        <?php }
        } ?>     
    </section>

    <?php include('templates/footer_tpl.php'); ?>