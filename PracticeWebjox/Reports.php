<?php
    session_start();
    include('analyst.php');
    include('dataBase.php');

    echo "<div class='row about'>
            <div class='col-lg-4 col-md-4 col-sm-12'>
                <form method='POST' action=''>
                    <label for='rb1'>Выбор отчета: </label>
                    <div class='form-check'>
                        <input class='form-check-input' type='radio' name='report' value='1' id='report'>
                        <label class='form-check-label' for='rb1'> Отчет по завершенным договорам</label>
                    </div>
                    <div class='form-check'>
                    <input class='form-check-input' type='radio' name='report' value='2' id='report'>
                    <label class='form-check-label' for='rb1'> Отчет по действующим договорам  </label>
                    </div>
                <button type='submit' name='submit' class='btn btn-primary' style='background-color: #b5862b'>Просмотр</button>
                </form>
            </div>
            <div class = 'col-lg-8 col-md-8 col-sm-12 desc'>
        "
?>

<?php
    if (isset($_POST['submit']))
    {
        $n = $_POST['report'];

        if($n==1){


$sql = "SELECT contract.price, equipment_class.class, equipment.equipmentName, COUNT(contract.contract_id) 
AS kol, SUM(IF(contract.endContractDate > contract.endDate, contract.price + 
(DATEDIFF(contract.endContractDate, contract.endDate) * equipment.tarifPerHour), contract.price)) AS summ
FROM contract 
INNER JOIN equipment ON contract.equipment_id = equipment.equipment_id 
INNER JOIN equipment_class ON equipment.class_id = equipment_class.class_id 
WHERE contract.endContractDate IS NOT NULL
GROUP BY contract.price, equipment_class.class, equipment.equipmentName 
ORDER BY COUNT(contract.contract_id) DESC";


            $result = mysqli_query($db, $sql);
            echo "<h4 style='background: #fff; color: black'>Отчет по завершенным договорам</h4>";


            echo "<table class='table table-bordered table-sm' style='background: #b5862b'>
                <tr class='table-primary' style='background-color:#b5792b'><th style='background:#b5792b'>Класс оборудования</th>
                <th style='background:#b5792b'>Наименование</th>
                <th style='background:#b5792b'>Количество договоров</th>
                <th style='background:#b5792b'>Общая сумма</th>
            ";
            $sum = 0;
            $count = 0;
            
            while ($myrow=mysqli_fetch_array($result))
            {
                $sum += $myrow['summ'];
                $count += $myrow['kol'];
                echo "<tr>";
                echo "<td>".$myrow['class']."</td>";
                echo "<td>".$myrow['equipmentName']."</td>";
                echo "<td>".$myrow['kol']."</td>";
                echo "<td>".$myrow['summ']."</td>";
                echo "<tr>";

            }

            echo "<tr>";
            echo "<td><b>Итого:</b></td><td></td>
                  <td><b>$count</b></td><td><b>$sum</b></td>";
            echo "</td>";
            echo "</table>";
            echo "</div>";
        }

        elseif($n==2){

$sql = "SELECT equipment_class.class, equipment.equipmentName, COUNT(*) AS kol, SUM(contract.price) AS summ 
FROM contract 
INNER JOIN equipment ON contract.equipment_id = equipment.equipment_id 
INNER JOIN equipment_class ON equipment.class_id = equipment_class.class_id 
WHERE contract.endContractDate IS NULL
GROUP BY equipment.equipment_id, equipment_class.class, equipment.equipmentName 
ORDER BY COUNT(*) DESC";



            $result = mysqli_query($db, $sql);
            echo "<h4 style='background: #fff; color: black'>Отчет по действующим договорам</h4>";


            echo "<table class='table table-bordered table-sm' style='background:#b5862b'>
                <tr class='table-primary'><th style='background:#b5792b'>Класс оборудования</th>
                <th style='background:#b5792b'>Наименование</th>
                <th style='background:#b5792b'>Количество договоров</th>
                <th style='background:#b5792b'>Общая сумма</th>
            ";
            $sum = 0;
            $count = 0;

            while ($myrow=mysqli_fetch_array($result))
            {
                $sum += $myrow['summ'];
                $count += $myrow['kol'];
                echo "<tr>";
                echo "<td>".$myrow['class']."</td>";
                echo "<td>".$myrow['equipmentName']."</td>";
                echo "<td>".$myrow['kol']."</td>";
                echo "<td>".$myrow['summ']."</td>";
                echo "<tr>";

            }

            echo "<tr>";
            echo "<td><b>Итого:</b></td><td></td>
                  <td><b>$count</b></td><td><b>$sum</b></td>";
            echo "</td>";
            echo "</table>";

        }

    }

?>