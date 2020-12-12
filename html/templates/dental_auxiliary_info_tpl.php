    <!-- Section to display the information about the dental auxiliary -->
    <h1 id="profileTitle"> Assistant </h1>
    <section id="profileInfo">
        <img src="images/<?php echo $auxilary['username'] ?>.jpg" alt="Aux. <?php echo $auxiliary['name'] ?>">
        <div id="info">
            <p> <strong> Name: </strong> <?php echo $auxiliary['name'] ?> </p>
            <p> <strong> Address: </strong> <?php echo $auxiliary['address'] ?> </p>
            <p> <strong> Phone Number: </strong> <?php echo $auxiliary['phone_number'] ?> </p>
            <p> <strong> Date of Admission: </strong> <?php echo $auxiliary['date_of_admission'] ?> </p>
        </div>
    </section>