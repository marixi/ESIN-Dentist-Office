<!-- Section to manage the clients -->
<h2 id="client_mng"> Client Management </h2>
<section id="manage">
    <form action="manage_clients.php#client_mng" method="post">
        <label> Select whether you want to register or remove a client </label>
        <section id="inputs">
            <input type="submit" value="Register" name="add_client">
            <input type="submit" value="Remove" name="remove_client">
        </section>
    </form>
    <?php if (isset($_SESSION['final_msg'])) { ?> <p id="final"> <?php echo $_SESSION['final_msg'];
                                                                    unset($_SESSION['final_msg']); ?> </p> <?php } ?>
    <?php if (isset($_POST['add_client']) || $_SESSION['keepOpen'] == 1) { ?>

        <?php if (!isset($_SESSION['new_client'])) { ?>
            <form action="action_add_client_aux.php" mehtod="post" id="here_form">
                <p> Add employee as a client? Press here
                <input type="submit" name="not_new" id="here" value="&#xf007;" class="fa fa-input"></input>
                </p>
            </form>
        <?php } else { ?>
            <form action="action_add_client_aux.php" mehtod="post" id="here_form">
                <p> Add a new client? Press here
                <input type="submit" name="new" id="here" value="&#xf007;" class="fa fa-input"></input>
                </p>
            </form>
        <?php } ?>

        <br>

        <section id="add_client">

            <form action="action_add_client.php" method="post">

            <?php if (!isset($_SESSION['new_client'])) { ?>
                <br> <label> <?php $label = str_pad("Name:", 15, " ");
                            $label = str_replace(" ", "&nbsp;", $label);
                            echo $label; ?> </label>
                    <input type="text" name="name" value="<?php if (isset($_SESSION['name'])) {
                                                                echo $_SESSION['name'];
                                                            } ?>" required> </br>
                    <br> <label> <?php $label = str_pad("Address:", 15, " ");
                                    $label = str_replace(" ", "&nbsp;", $label);
                                    echo $label; ?> </label>
                    <input type="text" name="address" value="<?php if (isset($_SESSION['address'])) {
                                                                    echo $_SESSION['address'];
                                                                } ?>" required> </br>
                    <br> <label> <?php $label = str_pad("Phone number:", 15, " ");
                                    $label = str_replace(" ", "&nbsp;", $label);
                                    echo $label; ?> </label>
                    <input type="text" name="phone_number" value="<?php if (isset($_SESSION['phone_number'])) {
                                                                        echo $_SESSION['phone_number'];
                                                                    } else { ?>+351*********<?php } ?>" required> </br>
                    <br> <?php if (isset($_SESSION['error_num_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_num_msg'];;
                                                                                        unset($_SESSION['error_num_msg']) ?> </p> <?php } ?>
            <?php } ?> 
            
            <?php if (isset($_SESSION['new_client'])) { ?>
                <label> Employee: </label> 
                <select name="employee" required="required">
                    <option hidden disabled selected value> ----- Select employee to add ----- </option>
                    <?php $nonClients = getNonClientEmployee();
                    foreach ($nonClients as $futureClient) { ?>
                        <option value="<?php echo $futureClient['id'] ?>"> <?php echo $futureClient['name'] ?>, @<?php echo $futureClient['username']; ?> </option>
                    <?php } ?>
                </select>
            <?php } ?>
                
                <br> <label> <?php $label = str_pad("Date of birth:", 15, " ");
                                $label = str_replace(" ", "&nbsp;", $label);
                                echo $label; ?> </label>
                <input type="text" name="date_of_birth" value=<?php if (isset($_SESSION['date_of_birth'])) {
                                                                    echo $_SESSION['date_of_birth'];
                                                                } else {
                                                                    echo date('d') . '-' . date('m') . '-' . date('Y');
                                                                } ?>> </br>
                <br> <?php if (isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg'];
                                                                            unset($_SESSION['msg']); ?> </p> <?php } ?>
                <br> <label> <?php $label = str_pad("Tax Number:", 15, " ");
                                $label = str_replace(" ", "&nbsp;", $label);
                                echo $label; ?> </label>
                <input type="number" name="tax_number" value="<?php if (isset($_SESSION['tax_number'])) {
                                                                    echo $_SESSION['tax_number'];
                                                                } ?>"> </br>
                <br> <?php if (isset($_SESSION['error_tax_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_tax_msg'];
                                                                                    unset($_SESSION['error_tax_msg']); ?> </p> <?php } ?>
                <label> <?php $label = str_pad("Insurance Code:", 15, " ");
                        $label = str_replace(" ", "&nbsp;", $label);
                        echo $label; ?> </label>
                <input type="text" name="insurance_code" value="<?php if (isset($_SESSION['insurance_code'])) {
                                                                    echo $_SESSION['insurance_code'];
                                                                } ?>">
                <br> <?php if (isset($_SESSION['error_ins_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_ins_msg'];
                                                                                    unset($_SESSION['error_ins_msg']); ?> </p> <?php } ?>
                
            <?php if (!isset($_SESSION['new_client'])) { ?>    
                    <br> <label> <?php $label = str_pad("Username:", 15, " ");
                                    $label = str_replace(" ", "&nbsp;", $label);
                                    echo $label; ?> </label>
                    <input type="text" name="username" value="<?php if (isset($_SESSION['username'])) {
                                                                    echo $_SESSION['username'];
                                                                } ?>" required> </br>
                    <br> <?php if (isset($_SESSION['error_user_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_user_msg'];
                                                                                            unset($_SESSION['error_user_msg']); ?> </p> <?php } ?>
                    <label> <?php $label = str_pad("Password:", 15, " ");
                            $label = str_replace(" ", "&nbsp;", $label);
                            echo $label; ?> </label>
                    <input type="text" name="password" value="<?php if (isset($_SESSION['password'])) {
                                                                    echo $_SESSION['password'];
                                                                } else {
                                                                    echo generateRandomPassword(10);
                                                                } ?>" required> </br>
                    <?php if (isset($_SESSION['error_pass_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_pass_msg'];
                                                                                    unset($_SESSION['error_pass_msg']); ?> </p> <?php } ?>
                    <p> This is a random password! The client may change it in his profile page. </p>
            <?php } ?> 

                <input id="submit_add" type="submit" value="Add"> </br>
            </form>
        </section>
        </br>
    <?php }
    if (isset($_SESSION['final_msg'])) { ?> <p id="final"> <?php echo $_SESSION['final_msg'];
                                                            unset($_SESSION['final_msg']); ?> </p> <?php }
                                                                                                        if (isset($_POST['remove_client'])) {  ?>
        <section id="remove_client">
            <form action="action_remove_client.php" method="post">
                <select name="who" required="required" id="select_rem">
                <option hidden disabled selected value> ----- Select Client to remove ----- </option>
                    <?php foreach ($clients as $client) { ?>
                        <option value="<?php echo $client['id'] ?>"> <?php echo $client['name'] ?>, @<?php echo $client['username']; ?> </option>
                    <?php } ?>
                </select>
                <?php if (isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg'];
                                                                                                                unset($_SESSION['msg']); ?> </p> <?php } ?>
               <br> <input id="submit_remove" type="submit" value="Remove">
            </form>
        </section>

    <?php }
    ?>
</section> 