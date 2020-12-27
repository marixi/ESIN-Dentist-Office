    <!-- Section to book appointments -->
    <h2 id="bookAppTitle"> Book Appointment </h2>
    <?php if(isset($_SESSION['final_msg'])) { ?>
        <p> <?php echo $_SESSION['final_msg'] ?> </p>
        <?php unset($_SESSION['final_msg']); 
    } else { ?>
        <p> Use the form bellow to book an appointment. </p>
        <p> In need of an urgent appointment for today? <a href='\index.php#contacts' title="Call Us"> Call us! </a> </p>
        <section id="bookApp">
            <form action="action_checkDate.php" method="post">
                <label> Date: </label>
                <input type="date" name="date" min="<?php echo date("Y-m-d", strtotime("+1 day"));?>" <?php if(isset($_SESSION['date'])) { ?> value="<?php echo $_SESSION['date']; }?>" required="required">
                <input type="submit" value="Set">
                <?php if(isset($_SESSION['date']) && !isset($_SESSION['err_msg'])) { ?> <i style="font-size:24px" class="fa" id="tick">&#xf00c;</i> <?php } ?>
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
                            <?php if(isset($_SESSION['time']) && !isset($_SESSION['err_client_msg'])) { ?> <i style="font-size:24px" class="fa" id="tick">&#xf00c;</i> </img> <?php } ?>
                        <?php }
                    ?>
                </form>
            <?php }

            if (isset($_SESSION['time'])) { ?>
                <form action="action_bookAppointment.php" method="post">
                <?php if (isset($_SESSION['err_client_msg'])) { ?>
                    <p> <?php echo $_SESSION['err_client_msg'] ?> </p>
                <?php } else { ?>
                    <label> Specialty: </label>
                    <select name="specialty" required="required">
                        <?php foreach ($specialties as $specialty) { ?>
                            <option value="<?php echo $specialty['type']?>"> <?php echo $specialty['type']?> </option>
                        <?php } ?>
                    </select>
                    <br> <label> Dentist: </label>
                    <?php foreach ($dentists as $dentist) {
                        if (isset($_SESSION['dentistUnavailable']) && $dentist['id'] != $_SESSION['dentistUnavailable'] && $dentist['id'] != $_SESSION['id']) { ?>
                                <br> </br> <input type="radio" name="dentist" value="<?php echo $dentist['id']?>" required="required"> Dr. <?php echo $dentist['name']?> </input>
                            <?php }
                        else if (!isset($_SESSION['dentistUnavailable']) && $dentist['id'] != $_SESSION['id']) { ?>
                            <br> </br> <input type="radio" name="dentist" value="<?php echo $dentist['id']?>" required="required"> Dr. <?php echo $dentist['name']?> </input>
                        <?php }
                    } ?>
                    </br>
                    <input type="submit" id="final" value="Submit">
                <?php } ?>
                </form>
            <?php }
        } ?>     
    </section>