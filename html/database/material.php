<?php 

    function getAllMaterial() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM material ORDER BY name');
        $stmt->execute();
        return $stmt->fetchAll();
    }


    
    function update_material($action, $material_name, $quantity) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT quantity_in_stock FROM material WHERE name = ?');
        $stmt->execute(array($material_name));
        $stock_available = $stmt->fetch();

        if ($action == 'remove') {
            $stock_available = $stock_available['quantity_in_stock'] - $quantity;
        }
        else if ($action == 'add') {
            $stock_available = $stock_available['quantity_in_stock'] + $quantity;

            $stmt = $dbh->prepare('REPLACE INTO material (name, quantity_in_stock) VALUES (?, ?)');
            $stmt->execute(array($material_name, $stock_available));
        }
    }
    
?>