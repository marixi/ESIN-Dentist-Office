<?php

    $quantity_list = getAllQuantities();

?>

<h1 id="mat">Material needed for each specific service </h1>

    <ul id='serv_material'>
        <?php 
            $j = 0;
            for ($i = 0; $i < count($quantity_list); $i++) {
                if ($quantity_list[$i]['service_name'] != $quantity_list[$i + 1]['service_name']) {  ?>
                    <li id='service_list'>
                        <div id="shadow_box">
                            <h3> <?php echo $quantity_list[$i]['service_name'] ?> </h3>
                            <ul>
                                <?php for (; $j <= $i; $j++) { ?>
                                    <li id="qtty_list"> <?php echo str_pad($quantity_list[$j]['material_name'],30,".") ?><?php echo $quantity_list[$j]['quantity_needed'] ?> </li>
                                    <label> <?php echo $quantity_list['quantity_needed'] ?> </li> </label>
                                <?php }
                                $j = $i + 1; ?>
                            </ul>
                        </div>
                    </li>
                <?php } 
            } ?>
    </ul>