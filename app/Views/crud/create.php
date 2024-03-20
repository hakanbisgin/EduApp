<?php view('partials.header'); ?>
    <div class="container">
        <h1>Create <?= $model->name; ?></h1>
        <form action="/<?= $model->pluralName; ?>" method="POST">
            <div class="form-group">
                <?php foreach ($model->attributes as $attribute): ?>
                    <label for="<?= $attribute; ?>"><?= ucfirst($attribute); ?></label>
                    <input type="text" name="<?= $attribute; ?>" id="<?= $attribute; ?>" class="form-control" required>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
<?php view('partials.footer'); ?>