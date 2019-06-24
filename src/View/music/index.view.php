<?php if(!($model instanceof \Application\Model\Music\Music)) { throw new Exception('Error'); } ?>

<div class="row">
    <div class="col-md-10">
        <h3>Gerênciar Músicas</h3>
    </div>
    <div class="col-md-2 text-right">
        <a class="btn btn-primary btn-xs" href="/Music/Form">
            Nova Musica
        </a>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered" >
            <thead>
                <tr>
                    <th>Musica</th>
                    <th>Duração</th>
                    <th>Link</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model->allMusics as $music) {  ?>
                    <tr>
                        <td><?= $music['name'] ?></td>
                        <td><?= $music['duration'] ?></td>
                        <td><?= $music['link'] ?></td>
                        <td>
                            <a href="/Music/Edit/<?= $music['id'] ?>">Edit</a>
                            <a  href="/Music/Delete/<?= $music['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
