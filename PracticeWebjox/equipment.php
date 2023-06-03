
<?php
include("analyst.php");
include("dataBase.php");
?>

<div class="row about">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <form method="POST" action="" id="form" style="left: 5%; top:0%; width: 1wh;">
            <h4>Добавить новое оборудование</h4>
            <label for="carClass">Класс оборудования:</label>
<select name="carClass" id="carClass" required class="form-control">
  <?php
  $sql_classes = "SELECT * FROM equipment_class";
  $result_classes = mysqli_query($db, $sql_classes);
  while($class = mysqli_fetch_object($result_classes)) {
    $selectedClass = ($_POST["carClass"] == $class->class_id) ? 'selected' : '';
    echo "<option value='$class->class_id' $selectedClass>$class->class</option>";
  }
  ?>
</select>
<label for="carMark">Наименование:</label>
<input type="text" name="carMark" id="carMark" required class="form-control">

<label for="carTarif">Тариф за сутки:</label>
<input type="number" name="carTarif" id="carTarif" required class="form-control">




            <button type="submit" name="submit" class='btn btn-primary' style="margin-top: 10px; background-color: #b5862b">Добавить</button>
        </form>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 desc">
        <?php
          
          $sql = "SELECT equipment_class.class, equipment.equipmentName, equipment.tarifPerHour
          FROM equipment
          INNER JOIN equipment_class ON equipment.class_id = equipment_class.class_id";
          $result = mysqli_query($db, $sql);
          if (!$result) {
            die('Ошибка выполнения запроса: ' . mysqli_error($db));
          }
         
            echo "<h4 style='background: #fff; color: black'>Информация о музыкальном оборудовании</h4>";
            echo "<table class='table table-bordered table-sm' style='background: #b5862b'>
            <tr class='table-primary' style='background-color:#b5792b'><th style='background:#b5792b'>Класс оборудования</th>
            <th style='background:#b5792b'>Наименование</th>
            <th style='background:#b5792b'>Стоимость аренды в час</th>";

            while ($myrow=mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>".$myrow['class']."</td>";
                echo "<td>".$myrow['equipmentName']."</td>";
                echo "<td>".$myrow['tarifPerHour']."</td>";
            }
            echo "</table>"
        ?>
    </div>
</div>


<?php
if (isset($_POST['submit']))
{
    
    $class = $_POST["carClass"];
    $mark = $_POST["carMark"];
    $tarif = $_POST["carTarif"];
    

    $sql="INSERT INTO `equipment`(`class_id`, `equipmentName`, `tarifPerHour`)
    VALUES ('$class', '$mark', $tarif)";

    $result=mysqli_query($db, $sql);
    if ($result == TRUE)
    {
        echo "Данные успешно сохранены!";
        echo "<script> document.location.href = 'equipment.php'</script>";

    }
    else
    {
        echo "Ошибка". mysqli_error($db);
    }
    
    
}
?>

