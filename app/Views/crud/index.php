<?php view('partials.header'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?= ucfirst($model->pluralName); ?></h1>
                <a href="/<?= $model->pluralName; ?>/create" class="btn btn-primary">Create</a>
                <?php if(${$model->pluralName}): ?>
                <table class="table">
                    <thead>
                    <tr>
                        <?php foreach ($model->attributes as $attribute): ?>
                            <th><?= ucfirst(str_replace("_", " ", $attribute)); ?></th>
                        <?php endforeach; ?>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (${$model->pluralName} as $entity): ?>
                        <tr>
                            <?php foreach ($model->attributes as $attribute): ?>
                                <td><?= ucfirst((string)str_replace("_", " ", $entity[$attribute])); ?></td>
                            <?php endforeach; ?>
                            <td>
                                <a href="/<?= $model->pluralName; ?>/<?= $entity['id']; ?>"
                                   class="btn btn-primary">Show</a>
                                <a href="/<?= $model->pluralName; ?>/<?= $entity['id']; ?>/edit"
                                   class="btn btn-warning">Edit</a>
                                <form action="/<?= $model->pluralName; ?>/<?= $entity['id']; ?>/delete" method="post"
                                      style="display: inline;">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="/transcripts?<?= $model->name; ?>_id=<?= $entity['id']; ?>"
                                   class="btn btn-outline-success">Transcript</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <h2 class="text-muted my-2">No <?= $model->pluralName; ?> found.</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php view('partials.footer'); ?>