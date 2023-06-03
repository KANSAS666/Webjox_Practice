<?php
include("dataBase.php");
if (isset($_POST["class_id"])) {
    $class_id = mysqli_real_escape_string($db, $_POST["class_id"]);
    
    $sql_equipment = "SELECT * FROM equipment WHERE status = 0 AND class_id = '$class_id'";
    $result_equipment = mysqli_query($db, $sql_equipment);
    
    if ($result_equipment) {
        $equipmentList = array();
        while ($equipment = mysqli_fetch_assoc($result_equipment)) {
            $equipmentList[] = array(
                "equipment_id" => $equipment["equipment_id"],
                "equipmentName" => $equipment["equipmentName"]
            );
        }
        echo json_encode($equipmentList);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}

mysqli_close($db);
?>
