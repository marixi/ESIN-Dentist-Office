    <!-- Table to display the services performed and respective prices -->
    <h1 id="tableTitle"> Prices </h1>
    <table id='table'>
        <tr>
            <th scope="col"> Specialty </th> <th scope="col"> Procedure </th> <th scope="col"> Price </th>
        </tr>
        <?php foreach ($services as $service) {?>
                <tr>
                    <td> <?php echo $service['specialty_type'] ?> </td>
                    <td> <?php echo $service['procedure_name'] ?> </td>
                    <td id="price"> <?php echo $service['price'] ?> </td>
                </tr>
        <?php } ?>
    </table>