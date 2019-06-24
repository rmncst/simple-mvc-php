<div class="row">
    <div class="col-md-12">
        <h3>Formulário: Música</h3>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="horizontal" method="post" action="/Music/Save">
            <div class="row">
                <div class="col-md-6">
                    <label> Nome </label>
                    <input type="text" name="name" class="form-control" value="<?= $model->name ?>" />
                    <?= fieldError('name', $model->errors) ?>
                </div>
                <div class="col-md-6">
                    <label> Duração </label>
                    <input type="number" name="duration" class="form-control" value="<?= $model->duration ?>" />
                    <?= fieldError('duration', $model->errors) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>  Link da Música  </label>
                    <input type="url" name="link" class="form-control" value="<?= $model->link ?>" />
                    <?= fieldError('link', $model->errors) ?>
                </div>
            </div>
            <br>
            <div class="row">
                <input type="hidden" name="id" value="<?= $model->id ?>">
                <div class="col-md-12">
                    <button class="btn btn-primary">
                        Salvar
                    </button>
                    <a class="btn btn-outline-info" type="reset" href="/Music/Index">
                        Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>