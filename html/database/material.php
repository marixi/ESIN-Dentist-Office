<?php 

    function getAllMaterial() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM material ORDER BY name');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getMaterialStock($material_name) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT quantity_in_stock FROM material WHERE name = ?');
        $stmt->execute(array($material_name));
        return $stmt->fetch();
    }

    function replaceMaterialStock($material_name, $stock_available) {
        global $dbh;
        $stmt = $dbh->prepare('REPLACE INTO material (name, quantity_in_stock) VALUES (?, ?)');
        $stmt->execute(array($material_name, $stock_available));
    }
    
    function update_material($action, $material_name, $quantity) {
        $stock_available = getMaterialStock($material_name);
        if ($action == 'remove') {
            if ($stock_available['quantity_in_stock'] < $quantity) {
                $_SESSION['mat_error'] = "Unable to perform the operation since there was more material to withdraw than the one in stock.";
            } else {
                $stock_available = $stock_available['quantity_in_stock'] - $quantity;
                replaceMaterialStock($material_name, $stock_available);
            }
        }
        else if ($action == 'add') {
            $stock_available = $stock_available['quantity_in_stock'] + $quantity;
            replaceMaterialStock($material_name, $stock_available);
        }
    }
    
?>