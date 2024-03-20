<?php view('partials.header');
$entity = ${$model->name}; ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Show <?= $model->name; ?></h1>
                <table class="table">
                    <thead>
                    <tr>
                        <?php foreach ($model->attributes as $attribute): ?>
                            <th><?= $attribute; ?></th>
                        <?php endforeach; ?>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php foreach ($model->attributes as $attribute): ?>
                            <td><?= $entity[$attribute]; ?></td>
                        <?php endforeach; ?>
                        <td>
                            <a href="/<?= $model->pluralName; ?>/<?= $entity['id']; ?>/edit" class="btn btn-warning">Edit</a>
                            <form action="/<?= $model->pluralName; ?>/<?= $entity['id']; ?>" method="post"
                                  style="display: inline;">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php view('partials.footer'); ?>