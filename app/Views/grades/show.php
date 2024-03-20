<?php view('partials.header'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Grade</h1>
                <a href="/grades" class="btn btn-primary">Back</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Term</th>
                        <th>Course</th>
                        <th>Student</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= $grade['term']; ?></td>
                        <td><?= $grade['course']; ?></td>
                        <td><?= $grade['student']; ?></td>
                        <td><?= $grade['grade']; ?></td>
                        <td>
                            <a href="/grades/<?= $grade['id']; ?>/edit"
                               class="btn btn-warning">Edit</a>
                            <form action="/grades/<?= $grade['id']; ?>" method="post"
                                  style="display: inline;">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php view('partials.footer'); ?>