<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <title> Dentist Office HomePage</title>
</head>

<body>
    <!-- Header -->
    <header>
        <a href='index.php' title="Home">
            <img src="images/Logo.png" alt="Dentist Clinic Logo" id="logo_img">
        </a>
        <nav>
            <ul>
                <li><a href='index.php' title="Home"> Home </a></li>
                <li><a href=#services title="Services"> Services </a></li>
                <li><a href=#team title="Team"> Meet the Team </a></li>
                <li><a href=#contacts title="Contacts"> Contacts </a></li>
                <?php if (isset($_SESSION['id'])) { ?>
                    <li><a href='action_decideProfile.php'> Profile </a></li>
                <?php } else { ?>
                    <li><a href="login.php"> Login </a></li>
                <?php } ?>
            </ul>
        </nav>
        <h1> Denticare Clinic </h1>
        <h2> Where your smile is art! </h2>
        <img src="images/header.jpg" alt="A crew happy to give you the perfect smile." id="beauty">
    </header>

    <!-- First appointment section -->
    <section id="first">
        <h2> First Appointment? <a href=#contacts title="Contacts"> Contact Us! </a> </h2>
    </section>

    <!-- Services section -->
    <section id="services">
        <h1> Services </h1>
        <p> Our clinic offers the best dental treatments with the most recent, inovative and reliable approaches. </p>
        <div id="icons">
            <img src="images/general.svg" alt="General">
            <img src="images/orthodontics.svg" alt="Orthodontics">
            <img src="images/pediatric.svg" alt="Pediatric">
            <img src="images/prosthodontics.svg" alt="Prosthodontics">
            <img src="images/endodontics.svg" alt="Endodontics">
        </div>
        <div id="titles">
            <h2> General </h2>
            <h2> Orthodontics </h2>
            <h2> Pediatric </h2>
            <h2> Prosthodontics </h2>
            <h2> Endodontics </h2>
        </div>
        <div id="description">
            <p> We can perform your regular check up and cleaning rotines to keep your mouth healthy and teeth strong.
            </p>
            <p> Crooked teeth? Not anymore! Come and see the different options we have to fit your own needs. </p>
            <p> We know what all those candies do to the so called "milk-teeth"! Come and find out about our ludic and
                pedagogical space to keep the little ones distracted on the appointments. </p>
            <p> Using the most advanced technological means and materials of excellence, you won't even notice it's not
                a natural one. </p>
            <p> The teeth is way beyond what you can see. Lets not allow for the root canal to bring any more
                disconfort. </p>
        </div>
        <div id="prices">
            <p> See below how much each of our services cost. But don't worry, we have plenty agreements with insurance
                companies to make your smile smile cost less! </p>
            <form action="servicePrice.php" method="post">
                <input type="submit" value="Price List">
            </form>
        </div>
    </section>

    <!-- Meet the team section -->
    <section id="team">
        <div id="teamTitle">
            <h1> Meet the Team </h1><br>
            <p> Meet our experienced dentists and staff who are ready to assist you with all of your dental care needs.
            </p>
            <h2> Dentists </h2>
        </div>
        <div id="dentistPhoto">
            <img src="images/miguel.paredes.jpg" alt="One of our dentists" id="dentist1">
            <img src="images/raquel.pires.jpg" alt="Another of our dentists" id="dentist2">
        </div>
        <div id="dentistNames">
            <h3> Dr. Miguel Paredes </h3>
            <h3> Dr. Raquel Pires </h3>
        </div>
        <div id="dentistDescription">
            <p> Concluded the Integrated Master in Dental Medicine in the University of Porto and is the co-founder of
                the
                clinic. He will impress you with a high level of skill and technical abilities. He employs the latest
                equipment and techniques to provide a predictable, pain-free and expedient experience. Dr. Miguel has a
                warm
                and caring bedside manner and is sensitive to his patients' needs. </p>
            <p> Concluded the Integrated Master in Dental Medicine in the University of Porto and is the co-founder of
                the
                clinic. She loves her profession and is dedicated to offering the best services possible. She is
                certified
                with Invisilign from Align technology Inc. and she has completed the 3 year orthodontics and orthopedic
                dentofacial program from the International Dental Institute. She has also taken soft tissue grafting
                courses
                with Alloderm. </p>
        </div>
        <div id="auxiliar">
            <h2> Auxiliars </h2>
            <img src="images/auxiliars.jpg" alt="Our assistants">
            <p> Together with the best dentists we have gathered a highly educated team of assistants (clockwise):
                Joana Fonseca, Ricardo Brioso, Sara Fernandes, Lara Guerreiro and Erica Freitas. </p>
        </div>
    </section>

    <!-- Contacts section -->
    <section id="contacts">
        <h1> Contacts</h1>
        <div id="office">
            <h3> Where to Find Us: </h3>
            <p> Av. da Boavista 650, 4100-127 Porto </p>
        </div>
        <div id="schedule">
            <h3> Open Hours: </h3>
            <ul>
                <li> Monday-Friday: 9am - 7pm </li>
                <li> Saturday: 9am - 5pm </li>
                <li> Sunday: closed </li>
            </ul>
        </div>
        <div id="contactInfo">
            <h3> Our Contacts: </h3>
            <ul>
                <li> Email: greatsmiles@denticare.com </li>
                <li> Telephone: +351-921-555-102 </li>
                <li> Facebook: www.facebook.com/clinique_denticare </li>
            </ul>
        </div>
        <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3003.91712541639!2d-8.633627284621008!3d41.15815967928583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2465a744d11d17%3A0x269e6eb103409c!2sAv.%20da%20Boavista%20650%2C%20Porto!5e0!3m2!1spt-PT!2spt!4v1606685835889!5m2!1spt-PT!2spt" width="700" height="450" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li>Home</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

</body>

</html>