
<?php
include("manager.php");
include("dataBase.php");
?>


<div class="row about">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <form method="POST" action="" id="form" style="left: 5%; top:0%; width: 1wh;">
            <h4>Регистрация клиента</h4>
        <label for ="lastname">Фамилия:</label>
        <input type="text" name="last_name" id="last_name" required class="form-control"> 
        <label for ="first_name">Имя:</label>
        <input type="text" name="first_name" id="first_name" required class="form-control"> 
        <label for ="father_name">Отчество:</label>
        <input type="text" name="father_name" id="father_name" required class="form-control"> 
        <label for ="passport">Серия и номер паспорта:</label>
        <input type="number" name="passport" id="passport" required class="form-control"> 
        <label for ="phone_number">Номер телефона:</label>
        <input type="text" name="phone_number" id="phone_number" required class="form-control"> 
        <label for ="birth_date">Дата рождения:</label>
        <input type="date" name="birth_date" id="birth_date" required class="form-control"> 	
		<input type="submit" name="submit" value="Зарегистрировать" style="margin-top: 10px; background-color: #b5862b" class="btn btn-primary">
        </form>
    </div>

    <?php
        if (isset($_POST['submit'])){
            $firstName = $_POST['first_name'];
            $surname = $_POST['last_name'];
            $fathername = $_POST['father_name'];
            $phone = $_POST['phone_number'];
            $passport = $_POST['passport'];
            $birthDate = $_POST['birth_date'];

            $mysql = "INSERT INTO `client`(`firstname`, `surname`, `fathername`, `passport`, `phone`, `birthDate`) 
            VALUES ('$firstName','$surname','$fathername','$passport','$phone','$birthDate')";

            $result=mysqli_query($db,$mysql);

            if($result == TRUE)
            {
                echo "Данные успешно сохранены!";
                echo "<script> document.location.href = 'clients.php'</script>";
            }
            else{
                 echo "Ошибка";
            }


        }
    ?>
</div>

