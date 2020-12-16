    <!-- Section to display the information about the dental auxiliary -->
    <h1 id="profileTitle"> Assistant </h1>
    <section id="profileInfo">
        <img src="images/<?php echo $auxiliary['username'] ?>.jpg" alt="Aux. <?php echo $auxiliary['name'] ?>">
        <div id="info">
            <?php if ($_SESSION['edit_on'] == 0 && !isset($_POST['edit'])) { ?>

                <form action="action_decideProfile.php" method="post" id="edit_profile">
                    <button type="submit" id="edit_button" name="edit" form="edit_profile">
                        <i class="fa fa-edit"></i></button>
                </form>
                <p> <strong> Name: </strong> <?php echo $auxiliary['name'] ?> </p>
                <p> <strong> Address: </strong> <?php echo $auxiliary['address'] ?> </p>
                <p> <strong> Phone Number: </strong> <?php echo $auxiliary['phone_number'] ?> </p>
                <p> <strong> Date of Admission: </strong> <?php echo $auxiliary['date_of_admission'] ?> </p>

            <?php } else { //$_SESSION['edit_on']=1; 
            ?>
                <form action="action_edit_profile_info.php" method="post">

                    <p> <strong> Name: </strong> </p> <input type="text" name="name" value="<?php if (isset($_SESSION['name'])) {
                                                                                        echo $_SESSION['name'];
                                                                                    } else {
                                                                                        echo $auxiliary['name'];
                                                                                    } ?>" required>
                    <p> <strong> Address: </strong> </p> <input type="text" name="address" value="<?php if (isset($_SESSION['address'])) {
                                                                                            echo $_SESSION['address'];
                                                                                        } else {
                                                                                            echo $auxiliary['address'];
                                                                                        } ?>" required>
                    <p> <strong> Phone Number: </strong> </p> <input type="text" name="phone_number" value="<?php if (isset($_SESSION['phone_number'])) {
                                                                                                        echo $_SESSION['phone_number'];
                                                                                                    } else {
                                                                                                        echo $auxiliary['phone_number'];
                                                                                                    } ?>" required>
                    <?php if (isset($_SESSION['error_num_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_num_msg'];;
                                                                                    unset($_SESSION['error_num_msg']) ?> </p> <?php } ?>
                    <p> <strong> Username: </strong> </p> <input type="text" name="username" value="<?php if (isset($_SESSION['username'])) {
                                                                                                echo $_SESSION['username'];
                                                                                            } else {
                                                                                                echo $auxiliary['username'];
                                                                                            } ?>" required>
                    <?php if (isset($_SESSION['error_user_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_user_msg'];
                                                                                    unset($_SESSION['error_user_msg']); ?> </p> <?php } ?>
                    <p> <strong> Password: </strong> </p> <input type="text" name="password" value="">
                    <p> If you don't want to change the password, leave it blank. </p>
                    <?php if (isset($_SESSION['error_pass_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_pass_msg'];
                                                                                    unset($_SESSION['error_pass_msg']); ?> </p> <?php } ?>


                    <input id="submit" type="submit" value="Submit">
                </form>
            <?php } ?>
        </div>
    </section>
    <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']);?>