<?php

    if ($_SERVER['PHP_SELF'] == '/dentist.php' || $_SERVER['PHP_SELF'] == '/dentistAppointments.php' || $_SERVER['PHP_SELF'] == '/manageTeam.php') { 
        $person = getDentistInfo($_SESSION['id']);
    } else if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary.php' || $_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php' || $_SERVER['PHP_SELF'] == '/manage_material.php' || $_SERVER['PHP_SELF'] == '/manage_clients.php') {
        $person = getAuxiliaryInfo($_SESSION['id']);
    } else if ($_SERVER['PHP_SELF'] == '/client.php' || $_SERVER['PHP_SELF'] == '/clientRecord.php') {
        $person = getClientInfo($_SESSION['id']);
    }

?>    
    <!-- Title for the profile page -->

    <?php if ($_SERVER['PHP_SELF'] == '/dentist.php' || $_SERVER['PHP_SELF'] == '/dentistAppointments.php' || $_SERVER['PHP_SELF'] == '/manageTeam.php') { ?>
        <h1 id="profileTitle"> Dentist </h1>
    <?php } ?>
    <?php if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary.php' || $_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php' || $_SERVER['PHP_SELF'] == '/manage_material.php' || $_SERVER['PHP_SELF'] == '/manage_clients.php') { ?>
        <h1 id="profileTitle"> Assistant </h1>
    <?php } ?>
    <?php if ($_SERVER['PHP_SELF'] == '/client.php' || $_SERVER['PHP_SELF'] == '/clientRecord.php') { ?>
        <h1 id="profileTitle"> Client </h1>
    <?php } ?>

    <!-- Section to display the information about the person -->
    <section id="profileInfo">
        
        <!-- Profile image -->
        <?php if (file_exists('images/' . $person['id'] . '.jpg')) { ?>
            <img src="images/<?php echo $person['id'] ?>.jpg" alt="<?php echo $person['name'] ?>">
        <?php } else { ?>
            <form enctype="multipart/form-data" action="action_imageUpload.php" method="post">
                <input type="file" name="profile_image" accept="image/png, image/jpeg, image/jpg">
                <br> <input type="submit" value="Upload"> </br>
            </form>
        <?php } ?>
        <?php if (isset($_SESSION['error_image'])) { ?> <p id="err"> <?php echo $_SESSION['error_image']; unset($_SESSION['error_image']); ?> </p> <?php } ?>

        <!-- Profile information -->
        <div id="info">

            <!-- Non editable -->
            <?php if ($_SESSION['edit_on']==0 && !isset($_POST['edit'])) { ?>
                <form action="action_decideProfile.php" method="post" id="edit_profile">
                    <button type="submit" id="edit_button" name="edit" form="edit_profile"><i class="fa fa-edit"></i></button>
                </form>
                <p> <strong> Name: </strong> <?php echo $person['name'] ?> </p>
                <p> <strong> Address: </strong> <?php echo $person['address'] ?> </p>
                <p> <strong> Phone Number: </strong> <?php echo $person['phone_number'] ?> </p>
                <?php if ($_SERVER['PHP_SELF'] == '/dentist.php' || $_SERVER['PHP_SELF'] == '/dentistAppointments.php' || $_SERVER['PHP_SELF'] == '/manageTeam.php' || $_SERVER['PHP_SELF'] == '/dentalAuxiliary.php' || $_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php' || $_SERVER['PHP_SELF'] == '/manage_material.php' || $_SERVER['PHP_SELF'] == '/manage_clients.php') { ?>
                    <p> <strong> Date of Admission: </strong> <?php echo $person['date_of_admission'] ?> </p>
                <?php } ?>
                <?php if ($_SERVER['PHP_SELF'] == '/client.php' || $_SERVER['PHP_SELF'] == '/clientRecord.php') { ?>
                    <p> <strong> Birth Date: </strong> <?php echo $person['birth_date'] ?> </p>
                    <p> <strong> Tax Number: </strong> <?php echo $person['tax_number'] ?> </p>
                    <p> <strong> Insurance: </strong> <?php echo $person['insurance_code'] ?> </p>
                <?php } ?>
            
            <?php } else { ?> <!-- Editable -->

                <form enctype="multipart/form-data" action="action_edit_profile_info.php" method="post" id="editing">
                    <?php if (file_exists('images/' . $person['id'] . '.jpg')) { ?>                
                        <input type="file" name="image" accept="image/png, image/jpeg, image/jpg">
                        <?php if (isset($_SESSION['error_image'])) { ?> <p id="err"> <?php echo $_SESSION['error_image']; unset($_SESSION['error_image']); ?> </p> <?php } ?>
                    <?php } ?>
                    <p> <strong> Name: </strong>
                    <input type="text" name="name" value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; } 
                                                                     else { echo $person['name']; } ?>" required> </p>
                    <p> <strong> Address: </strong>  
                    <input type="text" name="address" value="<?php if(isset($_SESSION['address'])) { echo $_SESSION['address']; }
                                                                        else { echo $person['address']; } ?>" required> </p>
                    <p> <strong> Phone Number: </strong>   
                    <input type="text" name="phone_number" value="<?php if(isset($_SESSION['phone_number'])) { echo $_SESSION['phone_number']; } 
                                                                            else { echo $person['phone_number']; } ?>" required> </p>
                    <?php if (isset($_SESSION['error_num_msg'])) { ?> 
                         <p id="err"> <?php echo $_SESSION['error_num_msg']; unset($_SESSION['error_num_msg']); ?> </p> 
                    <?php } ?>
                    <?php if ($_SERVER['PHP_SELF'] == '/client.php' || $_SERVER['PHP_SELF'] == '/clientRecord.php') { ?>
                        <p> <strong> Birth Date: </strong>
                        <input type="text" name="birth_date" value="<?php if(isset($_SESSION['birth_date'])) { echo $_SESSION['birth_date']; }
                                                                            else { echo $person['birth_date']; } ?>" required></p>
                        <p> <strong> Tax Number: </strong>
                        <input type="text" name="tax_number" value="<?php if(isset($_SESSION['tax_number'])) { echo $_SESSION['tax_number']; }
                                                                            else { echo $person['tax_number']; } ?>"></p> 
                        <?php if (isset($_SESSION['error_tax_msg'])) { ?>
                            <p id="err"> <?php echo $_SESSION['error_tax_msg']; unset($_SESSION['error_tax_msg']); ?> </p>
                        <?php } ?>
                        <p> <strong> Insurance: </strong> 
                        <input type="text" name="insurance_code" value="<?php if(isset($_SESSION['insurance_code'])) { echo $_SESSION['insurance_code']; } 
                                                                                else { echo $person['insurance_code']; } ?>"></p>
                        <?php if (isset($_SESSION['error_ins_msg'])) { ?> 
                            <p id="err"> <?php echo $_SESSION['error_ins_msg']; unset($_SESSION['error_ins_msg']); ?> </p>                             <?php } ?>
                    <?php } ?>
                    <p> <strong> Username: </strong>  
                    <input type="text" name="username" value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; } 
                                                                    else { echo $person['username']; } ?>" required></p>
                    <?php if (isset($_SESSION['error_user_msg'])) { ?> 
                        <p id="err"> <?php echo $_SESSION['error_user_msg']; unset($_SESSION['error_user_msg']); ?> </p> 
                    <?php } ?>
                    <p> <strong> Password: </strong> 
                    <input type="text" name="password" value=""></p>
                    <p> If you don't want to change the password, leave it blank. </p>
                    <?php if (isset($_SESSION['error_pass_msg'])) { ?> 
                        <p id="err"> <?php echo $_SESSION['error_pass_msg']; unset($_SESSION['error_pass_msg']); ?> </p> 
                    <?php } ?>
                    <input id="submit" type="submit" value="Submit">
                </form>

            <?php } ?>
        </div>
    </section>

    <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']);?>
    <?php echo $_SESSION['msg']; unset($_SESSION['msg']);?>