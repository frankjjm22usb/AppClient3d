<?php

require_once 'config.php';
require_once 'libs/Pabhoz/MySQLiManager.php';

$db = new MySQLiManager($servername,$username,$password,$dbname);
$table = "Item";

function select($id = null){
    if(is_null($id)){
        global $db,$table;
        $resultado = $db->select("*",$table);
        
        foreach ($resultado as $key => $item) {
            $laQuerysota = "SELECT property.id, property.name, ihp.value FROM (SELECT * FROM item_has_property WHERE itemId = ".$item["id"].") as ihp INNER JOIN property ON ihp.propertyId = property.id";

            $propiedades = $db->customSelect($laQuerysota);
            $resultado[$key]["properties"] = $propiedades;
        }

    }
    //echo "<pre>"; print_r($resultado); echo "</pre>";
    print_r(json_encode($resultado));
}

select();