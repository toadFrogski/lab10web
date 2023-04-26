<?php require_once __DIR__ . '/../views/base_up.html'; ?>
<form id="record" class="form-control mt-5 w-50 mx-auto" action="../controllers/sign.php" method="post">
    <div class="mx-5 my-3">
        <label for="email" class="form-label">Введите адрес вашей почты</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
    </div>
    <div class="mx-5 my-3">
        <label for="password" class="form-label">Введите пароль</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <div class="mx-5 my-3">
        <label for="password1" class="form-label">Введите пароль еще раз</label>
        <input type="password" class="form-control" name="password" id="password1">
    </div>
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
            if (data[1].value != data[2].value) {
                val =false;
            }
            return val;
        });
        form.on('change', () => {
            let data = form.serializeArray();
            validate(data) ? submitBtn.prop('disabled', false) : submitBtn.prop('disabled', true);
        });
    });
</script>

<?php require_once __DIR__ . '/../views/base_down.html'; ?>