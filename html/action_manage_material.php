<?php 

$dbh = new PDO('sqlite:sql/dentist_office.db');
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$stmt2 = $dbh->prepare('SELECT quantity_in_stock FROM material WHERE name=?');

function update_material($action,$material_name,$quantity){
    global $stmt2, $dbh;
    $stmt2->execute(array($material_name));
    $stock_available=$stmt2->fetch();
    if($action=='remove')
        $stock_available=$stock_available['quantity_in_stock']-$quantity;
    elseif($action=='add')
        $stock_available=$stock_available['quantity_in_stock']+$quantity;

    $stmt3 = $dbh->prepare('REPLACE INTO material(name,quantity_in_stock) VALUES(?,?)');

    $stmt3->execute(array($material_name,$stock_available));
}

if(isset($_POST['service'])){
    $service=$_POST['service'];

$stmt = $dbh->prepare('SELECT material_name, quantity_needed FROM quantity WHERE service_name= ? ');
$stmt->execute(array($service));

while ($row = $stmt->fetch()){
    update_material('remove',$row['material_name'],$row['quantity_needed']);
}

} elseif(isset($_POST['material_rem']) && isset($_POST['qtty_rem'])){

$xtra_rem=$_POST['material_rem'];
$qtty_rem=$_POST['qtty_rem'];

update_material('remove',$xtra_rem,$qtty_rem);

}elseif(isset($_POST['add_material']) && isset($_POST['qtty_add'])){
    $new_mat=$_POST['add_material'];
    $qtty_add=$_POST['qtty_add'];

    update_material('add',$new_mat,$qtty_add);
}

header('Location: \manage_material.php');
?>