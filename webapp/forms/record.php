<?php require_once __DIR__ . '/../views/base_up.html'; ?>
<form id="record" class="form-control mt-5 w-50 mx-auto" action="../controllers/record.php" method="post">
    <section class="row mt-3">
        <div class="col-sm mx-5">
            <label for="name" class="form-label">Введите имя и фамилию</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Иван Иванович">
        </div>
        <div class="col-sm mx-5">
            <label for="email" class="form-label">Введите адрес вашей почты</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
        </div>
    </section>
    <section class="row mt-3">
        <div class="col-sm mx-5">
            <label for="child_name" class="form-label">Введите имя ребенка</label>
            <input type="text" class="form-control" name="child_name" id="child_name" placeholder="Ваня">
        </div>
        <div class="col-sm mx-5">
            <label for="date" class="form-label">Введите год рождения ребенка</label>
            <input type="date" class="form-control" name="date" id="date" min='2007-01-01' max='2017-01-01'>
        </div>
    </section>
    <section class="row">
        <button class="col-sm btn btn-primary btn-lg my-3 mx-5" disabled type="submit">Отправить</button>
        <button class="col-sm btn btn-light btn-lg my-3 mx-5" type="reset">Сбросить</button>
    </section>
</form>

<script>
    $(document).ready(() => {
        const form = $('#record');
        const submitBtn = form.find('button[type="submit"]');
        const validate = (data => {
            let val = true
            data.forEach(element => {
                if (element['value'] == '') {
                    val = false;
                }
            });
            return val;
        });
        form.on('change', () => {
            let data = form.serializeArray();
            validate(data) ? submitBtn.prop('disabled', false) : submitBtn.prop('disabled', true);
        });
    });
</script>
<?php require_once __DIR__ . '/../views/base_down.html'; ?>