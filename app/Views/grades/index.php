<?php view('partials.header'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Grades</h1>
                <a href="/grades/create" class="btn btn-primary">Create</a>
                <form action="/grades" method="GET">
                    <div class="form-group col-12 col-md-3 d-inline-flex align-items-center gap-3">
                        <label for="term">Term</label>
                        <select name="term_id" id="term" class="form-control select2">
                            <option value="">All</option>
                            <?php foreach ($terms as $term): ?>
                                <option value="<?= $term['id']; ?>" <?= (isset($_GET['term_id']) && $term['id'] == $_GET['term_id']) ? 'selected="selected"' : "" ?> >
                                    <?= $term['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-12 col-md-3 d-inline-flex align-items-center gap-3">
                        <label for="course">Course</label>
                        <select name="course_id" id="course" class="form-control select2">
                            <option value="">All</option>
                            <?php foreach ($courses as $course): ?>
                                <option value="<?= $course['id']; ?>" <?= (isset($_GET['course_id']) && $course['id'] == $_GET['course_id']) ? 'selected="selected"' : "" ?>>
                                    <?= $course['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-12 col-md-3 d-inline-flex align-items-center gap-3">
                        <label for="student">Student</label>
                        <select name="student_id" id="student" class="form-control select2">
                            <option value="">All</option>
                            <?php foreach ($students as $student): ?>
                                <option value="<?= $student['id']; ?>" <?= (isset($_GET['student_id']) && $student['id'] == $_GET['student_id']) ? 'selected="selected"' : "" ?>>
                                    <?= $student['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
                <br>
                <?php if ($grades): ?>
                    <table class="table">
                        <thead>
                        <tr>
                            <?php foreach ($attributes as $attribute): ?>
                                <th><?= ucfirst(str_replace(["_", "id"], [" ", ""], $attribute)); ?></th>
                            <?php endforeach; ?>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($grades as $entity): ?>
                            <tr>
                                <td><?= $entity['term']; ?></td>
                                <td><?= $entity['course']; ?></td>
                                <td><?= $entity['student']; ?></td>
                                <td><?= $entity['grade']; ?></td>
                                <td>
                                    <a href="/grades/<?= $entity['id']; ?>"
                                       class="btn btn-primary">Show</a>
                                    <a href="/grades/<?= $entity['id']; ?>/edit"
                                       class="btn btn-warning">Edit</a>
                                    <form action="/grades/<?= $entity['id']; ?>/delete" method="POST"
                                          style="display: inline;">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h2 class="text-muted my-2">No grades found.</h2>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php view('partials.footer'); ?>