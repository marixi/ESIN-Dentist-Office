<?php
    
    require_once('database/init_db.php');
    require_once('database/dentist_db.php');
    require_once('database/dentalAuxiliary_db.php');
    require_once('database/person_db.php');

    $id = $_SESSION['id'];
  
    $auxiliaries = getAllAuxiliaries();

    include('templates/profile_header_tpl.php'); 
    include('templates/profile_info_tpl.php');

?>

    <!-- Section to manage the auxiliaries -->
    <h2 id = "team_mng"> Manage Team </h2>
    <section id="manage">
        <form action="manageTeam.php#team_mng" method="post">
            <label> Want to hire or fire an employee? </label>
            <section id="inputs">
                <input type="submit" value="Hire" name="hire">
                <input type="submit" value="Fire" name="fire">
            </section>
        </form>
        <?php if(isset($_SESSION['final_msg'])) { ?> <p id="final"> <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']); ?> </p> <?php } ?>
            <?php if(isset($_POST['hire']) || isset($_SESSION['name']) ) { ?>
                <br>
                <section id="hire"> 
                <form action="action_hireAuxiliary.php" method="post">
                    <br><label> <?php $label=str_pad("Name:",18," "); $label = str_replace(" ", "&nbsp;",$label); echo $label;?> </label>
                    <input type="text" name="name" value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; }?>" required></br>
                    <br> <label> <?php $label=str_pad("Address:",18," "); $label = str_replace(" ", "&nbsp;",$label); echo $label;?> </label>
                    <input type="text" name="address" value="<?php if(isset($_SESSION['address'])) { echo $_SESSION['address']; }?>" required> </br>
                    <br> <label> <?php $label=str_pad("Phone number:",18," "); $label = str_replace(" ", "&nbsp;",$label); echo $label;?> </label>
                    <input type="text" name="phone_number" value="<?php if(isset($_SESSION['phone_number'])) { echo $_SESSION['phone_number']; } else { ?>+351********* <?php } ?>" required> </br>
                    <br> <?php if(isset($_SESSION['error_num_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_num_msg']; ; unset($_SESSION['error_num_msg']) ?> </p> <?php } ?>
                    <label> <?php $label=str_pad("Username:",18," "); $label = str_replace(" ", "&nbsp;",$label); echo $label;?> </label>
                    <input type="text" name="username" value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; }?>" required> </br>
                    <br> <?php if(isset($_SESSION['error_user_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_user_msg']; unset($_SESSION['error_user_msg']); ?> </p> <?php } ?>
                    <label><?php $label=str_pad("Password:",18," "); $label = str_replace(" ", "&nbsp;",$label); echo $label;?> </label>
                    <input type="text" name="password" value="<?php if(isset($_SESSION['password'])) { echo $_SESSION['password']; } else { echo generateRandomPassword(10); } ?>" required> </br>
                    <?php if(isset($_SESSION['error_pass_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_pass_msg']; unset($_SESSION['error_pass_msg']); ?> </p> <?php } ?>
                    <p> This is a random password! The employee may change it in his profile page. </p>
                    <br> <label><?php $label=str_pad("Salary:",18," "); $label = str_replace(" ", "&nbsp;",$label); echo $label;?> </label>
                    <input type="number" name="salary" min="0" max="2000" value="<?php if(isset($_SESSION['salary'])) { echo $_SESSION['salary']; } else{ echo "1000";}?>" step="100"> </br>
                    <br> <label> <?php $label=str_pad("Date of Admission:",18," "); $label = str_replace(" ", "&nbsp;",$label); echo $label;?> </label>
                    <input type="text" name="date_of_admission" value=<?php if(isset($_SESSION['date_of_admission'])) { echo $_SESSION['date_of_admission']; } else {echo date('d').'-'.date('m').'-'.date('Y');} ?> > </br>
                    <br> <?php if(isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?> </p> <?php } ?>
                    <input id="submit_add" type="submit" value="Submit"> </br>      
                </form>
            </section>
                </br>
            <?php }
             if(isset($_SESSION['final_msg'])) { ?> <p id="final"> <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']); ?> </p> <?php }
             if (isset($_POST['fire'])) { ?>
                <section id="fire">
                <form action="action_fireAuxiliary.php" method="post">
                    <select name="who" required="required" id="select_rem">
                    <option hidden disabled selected value> ----- Select Employee to fire ----- </option>
                    <?php foreach ($auxiliaries as $auxiliary) { ?>
                        <option value="<?php echo $auxiliary['id']?>"> <?php echo $auxiliary['name']?>, @<?php echo $auxiliary['username']?> </option>
                    <?php } ?>
                    </select>

                    <?php if(isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?> </p> <?php } ?>
                    <br> <input id='submit_remove' type="submit" value="Submit">
                </form>
                </section>
                
            <?php }
            ?>
    </section>

    <?php include('templates/footer_tpl.php'); ?>    