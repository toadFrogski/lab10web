<?php require_once __DIR__ . '/../views/base_up.html'; ?>

<?php
require_once __DIR__ . '/../utils/dbconnect.php';
$query = "SELECT m.manager_id, m.manager_login from manager m";
$managers =$conn->query($query)->fetch_all();
$conn->close();
?>

<form id="record" class="form-control mt-5 w-50 mx-auto" action="../controllers/record_new.php" method="post">
    <section class="row mt-3">
        <div class="col-sm mx-5">
            <label for="name" class="form-label">Название мероприятия</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="col-sm mx-5">
            <label for="manager" class="form-label">Менеджер</label>
            <select name="manager" class="form-select">
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
            <input type="text" class="form-control" name="location" id="location" >
        </div>
        <div class="col-sm mx-5">
            <label for="price" class="form-label">Цена</label>
            <input type="number" class="form-control" name="price" id="price" >
        </div>
    </section>
    <button class="w-100 btn btn-primary btn-lg mt-5 mb-3 mx-auto" type="submit">Сохранить</button>
</form>

<?php require_once __DIR__ . '/../views/base_down.html'; ?>