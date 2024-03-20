<?php view('partials.header');
$entity = ${$model->name}; ?>
    <div class="container">
        <h1>Edit <?= $model->name; ?></h1>
        <form action="/<?= $model->pluralName . "/" . $entity['id']; ?>" method="POST">
            <div class="form-group">
                <?php foreach ($model->attributes as $attribute): ?>
                    <label for="<?= $attribute; ?>"><?= ucfirst($attribute); ?></label>
                    <input type="text" name="<?= $attribute; ?>" id="<?= $attribute; ?>"
                           value="<?= $entity[$attribute] ?>"
                           class="form-control" required>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
<?php view('partials.footer'); ?>