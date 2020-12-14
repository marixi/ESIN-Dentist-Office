<?php
    
    require_once('database/init.php');
    // require_once('database/dentalAuxiliary.php');
    require_once('database/client.php');

    $id = $_SESSION['id'];

    $clients = getClients();
    require_once('templates/dental_auxiliary_header_tpl.html');
?>

    <!-- Section to manage the clients -->
    <h2 id = "client_mng"> Manage Clients </h2>
    <section id="manage">
        <form action="manage_clients.php#client_mng" method="post">
            <label> Select whether you want to add or remove a client </label>
            <section id="inputs">
                <input type="submit" value="Add" name="add_client">
                <input type="submit" value="Remove" name="remove_client">
            </section>
        </form>
        <?php if(isset($_SESSION['final_msg'])) { ?> <p id="final"> <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']); ?> </p> <?php } ?>
            <?php if(isset($_POST['add_client']) || isset($_SESSION['name'])) { ?>
                <br>
                <section id="add_client">
                <form action="action_add_client.php" method="post">
                    <label> Name: </label>
                    <input type="text" name="name" value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; }?>" required>
                    <br> <label> Address: </label>
                    <input type="text" name="address" value="<?php if(isset($_SESSION['address'])) { echo $_SESSION['address']; }?>" required> </br>
                    <br> <label> Phone Number: </label>
                    <input type="text" name="phone_number" value="<?php if(isset($_SESSION['phone_number'])) { echo $_SESSION['phone_number']; } else { ?>+351********* <?php } ?>" required> </br>
                    <br> <?php if(isset($_SESSION['error_num_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_num_msg']; ; unset($_SESSION['error_num_msg']) ?> </p> <?php } ?>
                    <br> <label> Date of Birth: </label>
                    <input type="text" name="date_of_birth" value=<?php if(isset($_SESSION['date_of_birth'])) { echo $_SESSION['date_of_birth']; } else {echo date('d').'-'.date('m').'-'.date('Y');} ?> > </br>
                    <br> <?php if(isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?> </p> <?php } ?>
                    <br> <label> Tax Number: </label>
                    <input type="number" name="tax_number" value="<?php if(isset($_SESSION['tax_number'])) { echo $_SESSION['tax_number']; }?>" > </br>
                    <br> <?php if(isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?> </p> <?php } ?>
                    <label> Insurance Code: </label>
                    <input type="text" name="insurance_code" value="<?php if(isset($_SESSION['insurance_code'])) { echo $_SESSION['insurance_code']; }?>">
                    <br> <label> Username: </label>
                    <input type="text" name="username" value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; }?>" required> </br>
                    <br> <?php if(isset($_SESSION['error_user_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_user_msg']; unset($_SESSION['error_user_msg']); ?> </p> <?php } ?>
                    <label> Password: </label>
                    <input type="password" name="password" value="<?php if(isset($_SESSION['password'])) { echo $_SESSION['password']; }?>" required> </br>
                    <?php if(isset($_SESSION['error_pass_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_pass_msg']; unset($_SESSION['error_pass_msg']); ?> </p> <?php } ?>
                    <p> Give random password! The client may change it in his login page. </p>
                    <input id="submit" type="submit" value="Submit"> </br>      
                </form>
            </section>
                </br>
            <?php }
             if(isset($_SESSION['final_msg'])) { ?> <p id="final"> <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']); ?> </p> <?php }
             if (isset($_POST['remove_client'])) { ?>
                <section id="remove_client">
                <form action="action_remove_client.php" method="post">
                    <label> Client: </label>
                    <select name="who" required="required">
                    <?php foreach ($clients as $client) { ?>
                        <option value="<?php echo $client['id']?>"> <?php echo $client['name']?> </option>
                    <?php } ?>
                    </select>
                    <?php if(isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?> </p> <?php } ?>
                    <input id="submit" type="submit" value="Submit">
                </form>
                </section>
                
            <?php }
            ?>
    </section>

    <?php require_once('templates/footer_tpl.php'); ?>