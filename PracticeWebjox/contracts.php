<?php
include("manager.php");
include("dataBase.php");
?>

<div class="row about">
    <div class="col-lg-4 col-md-4 col-sm-12">


    <form method="POST" action="" id="form" style="left: 5%; top:0%; width: 1wh;" onsubmit="saveSelectedEquipment()">
            <h4>Регистрация договора</h4>
        <label for ="client">Серия и номер паспорта клиента:</label> 
       
        
        <input type="text" name="client" id="client" required class="form-control" value="<?= isset($_POST['client']) ? $_POST['client'] : '' ?>">

<label for="equipment_class">Класс оборудования:</label>
<select name="equipment_class" id="equipment_class" class="form-control" onchange="saveSelectedClassId()">

  <?php
  $sql_classes = "SELECT * FROM equipment_class";
  $result_classes = mysqli_query($db, $sql_classes);
  while($class = mysqli_fetch_object($result_classes)) {
    $selectedClass = ($_POST["equipment_class"] == $class->class_id ) ? 'selected' : '';
    echo "<option value='$class->class_id' $selectedClass>$class->class</option>";
  }
  ?>
</select>

<label for="equipmentName">Наименование оборудования:</label>
<select name="equipmentName" id="equipmentName" class="form-control" onchange="saveSelectedEquipment()">
  <?php
  $selectedEquipment = isset($_POST['equipmentName']) ? $_POST['equipmentName'] : '';
  echo "<option value='' " . ($selectedEquipment == '' ? 'selected' : '') . "></option>";

  $sql_equipment = "SELECT * FROM equipment WHERE class_id = ?";
  $stmt_equipment = $db->prepare($sql_equipment);
  $stmt_equipment->bind_param("i", $_POST["equipment_class"]);
  $stmt_equipment->execute();
  $result_equipment = $stmt_equipment->get_result();

  while ($equipment = mysqli_fetch_object($result_equipment)) {
    $selected = ($selectedEquipment == $equipment->equipment_id) ? 'selected' : '';
    echo "<option value='$equipment->equipment_id' $selected>$equipment->equipmentName</option>";
  }
  ?>
</select>

            <label for="rental_start">Дата выдачи:</label>
    <input type="datetime-local" name="rental_start" id="rental_start" required class="form-control" value="<?= isset($_POST['rental_start']) ? $_POST['rental_start'] : '' ?>">
		
		<label for="rental_end">Дата возврата:</label>
		<input type="datetime-local" name="rental_end" id="rental_end" required class="form-control" value="<?= isset($_POST['rental_end']) ? $_POST['rental_end'] : '' ?>">
	
		<button type="submit" name="sum" style="margin-top: 10px; margin-bottom: 5px;background-color: #b5862b" class="btn btn-primary">
    Подсчет суммы аренды</button> <br>
      

        <label for="price">Общая сумма аренды:</label> <br>
		<input type="number" name="price" id="price" readonly> <br>
        <button type="submit" name="create_contract"style="margin-top: 10px; background-color: #b5862b" class="btn btn-primary">Создать договор</button>
        </form>

        <script>
  var selectedEquipment = ""; // Глобальная переменная для хранения выбранного наименования оборудования

  function saveSelectedEquipment() {
    var equipmentNameSelect = document.getElementById("equipmentName");
    selectedEquipment = equipmentNameSelect.options[equipmentNameSelect.selectedIndex].text;
  }
</script>


        <script>
  var equipmentClassSelect = document.getElementById("equipment_class");
  var equipmentNameSelect = document.getElementById("equipmentName");

  equipmentClassSelect.addEventListener("change", function() {

    var selectedClass = equipmentClassSelect.value;


    equipmentNameSelect.innerHTML = "";

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "get_equipment.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {

        var equipmentList = JSON.parse(xhr.responseText);
        for (var i = 0; i < equipmentList.length; i++) {

          var option = document.createElement("option");
          option.value = equipmentList[i].equipment_id;
          option.textContent = equipmentList[i].equipmentName;
          equipmentNameSelect.appendChild(option);
        }
      }
    };


    xhr.send("class_id=" + selectedClass);
  });
</script>

<script>
  var selectedClassId = ""; // Глобальная переменная для хранения выбранного ID класса оборудования

  function saveSelectedClassId() {
    var equipmentClassSelect = document.getElementById("equipment_class");
    selectedClassId = equipmentClassSelect.value;
    updateRentalRate();

  }

  function updateRentalRate() {
  var rentalRateInput = document.getElementById("rental_rate");

  // Создайте XMLHttpRequest для выполнения AJAX-запроса
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "get_rental_rate.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var rentalRate = xhr.responseText;
      rentalRateInput.value = rentalRate;
    }
  };

  // Отправьте запрос на сервер, передавая выбранный ID класса оборудования
  xhr.send("class_id=" + selectedClassId);
}
</script>

<?php
  if (isset($_POST['sum'])){
    $rentalStart = $_POST['rental_start'];
    $rentalEnd = $_POST['rental_end'];
  
    // Парсим значения даты и времени в объекты DateTime
    $startDateTime = new DateTime($rentalStart);
    $endDateTime = new DateTime($rentalEnd);
  
    // Вычисляем разницу в часах между началом и окончанием аренды
    $diff = $endDateTime->diff($startDateTime);
    $hours = $diff->h; // количество часов

    $selectedEquipmentId = $_POST['equipmentName'];
    $sql_tarif = "SELECT tarifPerHour FROM equipment WHERE equipment_id = ?";
    $stmt_tarif = $db->prepare($sql_tarif);
    $stmt_tarif->bind_param("i", $selectedEquipmentId);
    $stmt_tarif->execute();
    $result_tarif = $stmt_tarif->get_result();
    $tarifPerHour = mysqli_fetch_object($result_tarif)->tarifPerHour;
  
    // Рассчитываем общую сумму аренды
    $totalPrice = $hours * $tarifPerHour;
    echo "<script>document.getElementById('price').value = $totalPrice;</script>";
  }
?>

<?php
  if (isset($_POST['create_contract'])){
    $passport = $_POST['client'];
    $id_client = "SELECT client_id FROM client WHERE passport = $passport";
    $result_client = mysqli_query($db, $id_client);
    $client = mysqli_fetch_object($result_client)->client_id;
    echo $client;

    $equipment_id = $_POST['equipmentName'];

    $rental_start = $_POST['rental_start'];
    $rental_end = $_POST['rental_end'];


    $rental_price = $_POST['price'];

  // Формируем запрос для добавления данных в таблицу
    $sql = "INSERT INTO contract (equipment_id, client_id, startDate, endDate, price)
    VALUES ('$equipment_id', '$client', '$rental_start', '$rental_end', '$rental_price')";

  // Выполняем запрос
  if(mysqli_query($db, $sql)) {
    echo "Данные успешно обновлены!";
    echo "<script> document.location.href = 'contracts.php'</script>";
  } else {
    echo "Ошибка: " . mysqli_error($db);
  }

  $sql = "UPDATE equipment SET Status = 1 WHERE equipment_id = $equipment_id";
  $result_update = mysqli_query($db, $sql);
  if ($result_update == FALSE)
  {
    echo "Ошибка: " .mysqli_error($db);
  }
}

  
?>

</div>
    <div class="col-lg-8 col-md-8 col-sm-12 desc">
      <div>
<form method="POST" action="" id="form" style="left: 5%; top: 0%; width: 1wh;">
        <h4 style='background: #fff; color: black'>Сортировка по фамилии</h4>
        <div class="form-group">
            <input type="text" name="search_term" class="form-control" placeholder="Введите фамилию">
        </div>
        <button type="submit" name="search" class="btn btn-primary search-btn" style="background-color: #b5862b">Поиск</button>
        <button type="submit" name="show_all" class="btn btn-primary show-all-btn" style="background-color: #b5862b">Показать всех</button> 
        <style>
        .search-btn, .show-all-btn {
  margin-bottom: 20px;
}
</style>
    </form>
</div>
    
        <div>
    
        <?php

$first = 0;
$kol = 5;
$page = 1;

if (isset($_GET['page'])){
    $page = $_GET['page'];
}else $page = 1;

$first = ($page * $kol) - $kol;

$sql = "SELECT COUNT(*) FROM contract";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result); //
$total = $row[0]; //
$str_pag = ceil($total/$kol);
for ($i = 1; $i <= $str_pag; $i++){
    echo "<a href=contracts.php?page=".$i.">Страница ".$i."</a>"."|";
}

            $sql = "SELECT contract_id, startDate, endDate, price, contract.equipment_id, contract.client_id, client.firstname, client.surname,
            client.fathername, equipment.equipmentName FROM contract JOIN client ON contract.client_id = client.client_id
            JOIN equipment ON contract.equipment_id = equipment.equipment_id WHERE contract.endContractDate IS NULL LIMIT $first, $kol";


            if (isset($_POST['search']))
            {
              $search_term = $_POST['search_term'];

              $sql = "SELECT contract_id, startDate, endDate, price, contract.equipment_id, contract.client_id, client.firstname, client.surname,
            client.fathername, equipment.equipmentName FROM contract JOIN client ON contract.client_id = client.client_id
            JOIN equipment ON contract.equipment_id = equipment.equipment_id WHERE contract.endContractDate IS NULL AND client.surname = '$search_term'";
              
            $result = mysqli_query($db, $sql);

            }
            if (isset($_POST['show_all'])){
              $sql = "SELECT contract_id, startDate, endDate, price, contract.equipment_id, contract.client_id, client.firstname, client.surname,
            client.fathername, equipment.equipmentName FROM contract JOIN client ON contract.client_id = client.client_id
            JOIN equipment ON contract.equipment_id = equipment.equipment_id WHERE contract.endContractDate IS NULL";
            }
            $result = mysqli_query($db, $sql);
            
            echo "<h4 style='background: #fff; color: black'>Действующие договоры</h4>";
            echo "<table class='table table-bordered table-sm' style='background:#b5862b'>
            <tr class='table-primary' ><th style='background:#b5792b'>№</th>
            <th style='background:#b5792b'>Клиент</th>
            <th style='background:#b5792b'>Оборудование</th>
            <th style='background:#b5792b'>Дата выдачи</th>
            <th style='background:#b5792b'>Дата возврата</th>
            <th style='background:#b5792b'>Сумма аренды</th>
            <th style='background:#b5792b'></th>";

            while ($myrow=mysqli_fetch_array($result)){


                $clientN= $myrow['surname'].' '.$myrow['firstname'].' '.$myrow['fathername'];
                $equipN = $myrow['equipmentName'];
                echo "<tr>";
                echo "<td>".$myrow['contract_id']."</td>";
                echo "<td>".$clientN."</td>";
                echo "<td>".$myrow['equipmentName']."</td>";
                echo "<td>".$myrow['startDate']."</td>";
                echo "<td>".$myrow['endDate']."</td>";
                echo "<td>".$myrow['price']."</td>";


                echo "<td>

                <button type='button' name='submit' value='' class='btn btn-danger' data-toggle='modal' data-target='#myModal'
                     data-contract='".$myrow['contract_id']."' data-fio='".$clientN."' data-car_n='".$equipN."'>
                        Закрыть договор
                    </button>
            </td>
            ";
           
                echo "</tr>";
            }
            echo "</table>" 
            ?>    
    </div>
          </div>
          </div>


    <!--  модальноe окнo -->
 <!--  модальноe окнo -->
 <div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <h4 class="modal-title" style="color:black">Закрытие договора</h4>
      </div>
      <!-- Основное содержимое модального окна -->
       <div class="modal-body">  
         <form  method="POST"  action="">
      
<?php

echo '<div class="form-group"><label for="fio" style="color:black">Клиент:</label><br><input type="text" id="fio" name="fio" readonly class="form-control"></div>';
echo '<div class="form-group"><label for="car_n" style="color:black">Оборудование:</label><input type="text" id="car_n" name="car_n" readonly class="form-control"></div>'; 
echo '<div class="form-group"><label for="contractEnd" style="color:black">Дата фактического возврата:</label><br><input type="datetime-local" id="contractEnd" name="contractEnd"
 class="form-control"></div>';

 echo '<br><input type="hidden" id="idContract" name="idContract">'; 

?>

</div>
<!-- Футер модального окна -->
<div class="modal-footer">
 <button type="button" class="close" data-dismiss="modal" 
aria-hidden="true">Отмена</button>
 <button type="submit" name="submit" class="btn btn-danger">Закрыть договор</button>
</form>
 </div>
</div>
</div>
 </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Вызов модального окна -->

<script>
$(document).ready(function(){
  $('#myModal').on('show.bs.modal', function (event) {
// кнопка, которая вызывает модаль
 var button = $(event.relatedTarget);
// получим  data-idEdu атрибут
  var idContract = button.data('contract');
// получим  data-fio атрибут
  var fio = button.data('fio');
  var car_n = button.data('car_n');
   // Здесь изменяем содержимое модали
  var modal = $(this);
 modal.find('.modal-title').text('Договор № ' + idContract);
 modal.find('.modal-body #fio').val(fio);
 modal.find('.modal-body #car_n').val(car_n);
 modal.find('.modal-body #idContract').val(idContract);
})
});


</script>

<?php
    if (ISSET($_POST['submit']))
    {
        $contractEnd = $_POST['contractEnd'];
        $idContract = $_POST['idContract'];

        echo "<h1>$contractEnd</h1> <br> <h1>$idContract</h1>" ;

        
        $sql="UPDATE contract SET endContractDate = '$contractEnd' WHERE contract_id = $idContract";
        $result = mysqli_query($db, $sql);
        if ($result == TRUE){
            echo "Данные успешно сохранены!";
            echo "<script> document.location.href = 'contracts.php'</script>";
        }
        else{
            echo "Ошибка". mysqli_error($db);
            
        }
        $sql = "UPDATE equipment SET Status = 0 WHERE equipment_id = (SELECT equipment_id FROM contract WHERE contract_id = $idContract)";
        $result = mysqli_query($db, $sql);
        if ($result == FALSE){
          echo "Ошибка". mysqli_error($db);
        }
    }
?>




    
 <!-- jQuery (Cloudflare CDN) -->
 <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" 
 integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" 
 crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Bootstrap Bundle JS (Cloudflare CDN) -->
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
   integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" 
   crossorigin="anonymous" referrerpolicy="no-referrer"></script>

