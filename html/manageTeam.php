<?php
    
    require_once('database/init.php');
    require_once('database/dentist.php');
    require_once('database/dentalAuxiliary.php');

    $id = $_SESSION['id'];
 
    $dentist = getDentistInfo($id);
  
    $auxiliaries = getAllAuxiliaries();

    require_once('templates/dentist_header_info_tpl.php');
?>

    <!-- Section to manage the auxiliaries -->
    <h2> Manage Team </h2>
    <section id="manage">
        <form action="" method="post">
            <label> Want to hire or fire an employee? </label>
            <section id="inputs">
                <input type="submit" value="Hire" name="hire">
                <input type="submit" value="Fire" name="fire">
            </section>
        </form>
        <?php if(isset($_SESSION['final_msg'])) { ?> <p id="final"> <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']); ?> </p> <?php } ?>
            <?php if(isset($_POST['hire'])) { ?>
                <br>
                <section id="hire">
                <form action="action_hireAuxiliary.php" method="post">
                    <label> Name: </label>
                    <input type="text" name="name" value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; }?>" required>
                    <br> <label> Address: </label>
                    <input type="text" name="address" value="<?php if(isset($_SESSION['address'])) { echo $_SESSION['address']; }?>" required> </br>
                    <br> <label> Phone Number: </label>
                    <input type="text" name="phone_number" value="<?php if(isset($_SESSION['phone_number'])) { echo $_SESSION['phone_number']; } else { ?> +351********* <?php } ?>" required> </br>
                    <br> <?php if(isset($_SESSION['error_num_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_num_msg']; ; unset($_SESSION['error_num_msg']) ?> </p> <?php } ?>
                    <label> Username: </label>
                    <input type="text" name="username" value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; }?>" required> </br>
                    <br> <?php if(isset($_SESSION['error_user_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_user_msg']; unset($_SESSION['error_user_msg']); ?> </p> <?php } ?>
                    <label> Password: </label>
                    <input type="password" name="password" value="<?php if(isset($_SESSION['password'])) { echo $_SESSION['password']; }?>" required> </br>
                    <?php if(isset($_SESSION['error_pass_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_pass_msg']; unset($_SESSION['error_pass_msg']); ?> </p> <?php } ?>
                    <p> Give random password! The employee may change it in his login page. </p>
                    <br> <label> Salary: </label>
                    <input type="number" name="salary" min="0" max="2000" value="1000" step="100"> </br>
                    <br> <label> Date of Admission: </label>
                    <input type="text" name="date_of_admission" value=<?php echo date('d').'-'.date('m').'-'.date('Y'); ?> > </br>
                    <br> <?php if(isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?> </p> <?php } ?>
                    <input id="submit" type="submit" value="Submit"> </br>      
                </form>
            </section>
                </br>
            <?php }
             if(isset($_SESSION['final_msg'])) { ?> <p id="final"> <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']); ?> </p> <?php }
             if (isset($_POST['fire'])) { ?>
                <section id="fire">
                <form action="action_fireAuxiliary.php" method="post">
                    <label> Employee: </label>
                    <select name="who" required="required">
                    <?php foreach ($auxiliaries as $auxiliary) { ?>
                        <option value="<?php echo $auxiliary['id']?>"> <?php echo $auxiliary['name']?> </option>
                    <?php } ?>
                    <?php if(isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?> </p> <?php } ?>
                    <input id="submit" type="submit" value="Submit">
                </form>
                </section>
                
            <?php }
            ?>
    </section>

    <?php require_once('templates/footer_tpl.php'); ?>    