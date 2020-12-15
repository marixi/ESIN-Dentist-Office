<?php

require_once('database/init.php');
require_once('database/person.php');
// require_once('database/dentist.php');
// require_once('database/dentalAuxiliary.php');
require_once('database/client.php');

$id = $_SESSION['id'];

$person_info = getPersonInfo($id);

print_r($person_info);

$person_name=$person_info['name'];
$person_address=$person_info['adress'];
$person_phone=$person_info['phone_number'];
$person_username=$person_info['username'];
//nao faz sentido meter uma pré password pq ela está guardada de forma segura na base dados

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>

    <header id="log">
        <a href='index.php' title="Home"> <img src="images/grey_bg.png" alt="Dentist Clinic Logo" id="logo_img"> </a>
    </header>

    <h1> Edit Profile Information </h1>

    <section id="edit_form">
        <form action="action_hireAuxiliary.php" method="post">
            <label> <?php $label = str_pad("Name:", 18, " ");
                    $label = str_replace(" ", "&nbsp;", $label);
                    echo $label; ?> </label>
            <input type="text" name="name" value="<?php
                                                        echo $person_name;
                                                    ?>" required>
            <br> <label> <?php $label = str_pad("Address:", 18, " ");
                            $label = str_replace(" ", "&nbsp;", $label);
                            echo $label; ?> </label>
            <input type="text" name="address" value="<?php 
                                                            echo $person_address;
                                                       ?>" required> </br>
            <br> <label> <?php $label = str_pad("phone Number:", 18, " ");
                            $label = str_replace(" ", "&nbsp;", $label);
                            echo $label; ?> </label>
            <input type="text" name="phone_number" value="<?php 
                                                                echo $person_phone;
                                                            ?>" required> </br>
            <br> <?php if (isset($_SESSION['error_num_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_num_msg'];;
                                                                                unset($_SESSION['error_num_msg']) ?> </p> <?php } ?>
            <label> <?php $label = str_pad("Username:", 18, " ");
                    $label = str_replace(" ", "&nbsp;", $label);
                    echo $label; ?> </label>
            <input type="text" name="username" value="<?php
                                                            echo $person_username;
                                                         ?>" required> </br>
            <br> <?php if (isset($_SESSION['error_user_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_user_msg'];
                                                                                unset($_SESSION['error_user_msg']); ?> </p> <?php } ?>
            <label><?php $label = str_pad("Password:", 18, " ");
                    $label = str_replace(" ", "&nbsp;", $label);
                    echo $label; ?> </label>
            <input type="text" name="password" value="" > </br>
            <?php if (isset($_SESSION['error_pass_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_pass_msg'];
                                                                            unset($_SESSION['error_pass_msg']); ?> </p> <?php } ?>
            <br> <label><?php $label = str_pad("Salary:", 18, " ");
                        $label = str_replace(" ", "&nbsp;", $label);
                        echo $label; ?> </label>
            <input type="number" name="salary" min="0" max="2000" value="<?php if (isset($_SESSION['salary'])) {
                                                                                echo $_SESSION['salary'];
                                                                            } else {
                                                                                echo "1000";
                                                                            } ?>" step="100"> </br>
            <br> <label> <?php $label = str_pad("Date of Admission:", 18, " ");
                            $label = str_replace(" ", "&nbsp;", $label);
                            echo $label; ?> </label>
            <input type="text" name="date_of_admission" value=<?php if (isset($_SESSION['date_of_admission'])) {
                                                                    echo $_SESSION['date_of_admission'];
                                                                } else {
                                                                    echo date('d') . '-' . date('m') . '-' . date('Y');
                                                                } ?>> </br>
            <br> <?php if (isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg'];
                                                                        unset($_SESSION['msg']); ?> </p> <?php } ?>
            <input id="submit" type="submit" value="Submit"> </br>
        </form>
    </section>


</body>

</html>