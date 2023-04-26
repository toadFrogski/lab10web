<?php require_once __DIR__ . '/../views/base_up.html'; ?>

<?php
require_once __DIR__ . '/../utils/dbconnect.php';
$query = "SELECT e.event_id, e.event_name, m.manager_login, e.event_location, e.event_price, m.manager_id from event e INNER JOIN manager m on e.manager_id=m.manager_id where event_id='{$_GET['event']}'";
$event = $conn->query($query)->fetch_array();

$event_id=$event[0];
$event_name = $event[1];
$event_manager = $event[2];
$event_location = $event[3];
$event_price = $event[4];
$event_manager_id = $event[5];

$query = "SELECT m.manager_id, m.manager_login from manager m";
$managers = array_filter($conn->query($query)->fetch_all(), fn($manager) => $manager[0] != $event_manager_id);

$conn->close();
?>

<form id="record" class="form-control mt-5 w-50 mx-auto" action="../controllers/record_edit.php" method="post">
    <input type="hidden" name="event_id" value="<?=$event_id?>" />
    <section class="row mt-3">
        <div class="col-sm mx-5">
            <label for="name" class="form-label">Название мероприятия</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $event_name ?>">
        </div>
        <div class="col-sm mx-5">
            <label for="manager" class="form-label">Менеджер</label>
            <select name="manager" class="form-select">
                <option selected value="<?=$event_manager_id?>"><?=$event_manager?></option>
                <?php
                foreach ($managers as $manager) {
                    echo "<option value=\"{$manager[0]}\">{$manager[1]}</option>";
                }
                ?>
            </select>
        </div>
    </section>
    <section class="row mt-3">
        <div class="col-sm mx-5">
            <label for="location" class="form-label">Место проведения мероприятия</label>
            <input type="text" class="form-control" name="location" id="location" value="<?= $event_location ?>">
        </div>
        <div class="col-sm mx-5">
            <label for="price" class="form-label">Цена</label>
            <input type="number" class="form-control" name="price" id="price" value="<?= $event_price ?>">
        </div>
    </section>
    <button class="w-100 btn btn-primary btn-lg mt-5 mb-3 mx-auto" type="submit">Сохранить</button>
</form>

<?php require_once __DIR__ . '/../views/base_down.html'; ?>