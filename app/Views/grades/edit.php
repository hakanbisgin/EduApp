<?php view('partials.header'); ?>
    <div class="container">
        <h1 class="text-center">Edit Grade</h1>
        <form action="/grades/<?= $grade['id']; ?>" method="post">
            <div class="form-group">
                <label for="term_id">Term</label>
                <select name="term_id" id="term_id" class="form-control">
                    <?php foreach ($terms as $term): ?>
                        <option value="<?= $term['id']; ?>" <?= $term['id'] == $grade['term_id'] ? 'selected' : ''; ?>>
                            <?= $term['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="course_id">Course</label>
                <select name="course_id" id="course_id" class="form-control">
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= $course['id']; ?>" <?= $course['id'] == $grade['course_id'] ? 'selected' : ''; ?>>
                            <?= $course['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="student_id">Student</label>
                <select name="student_id" id="student_id" class="form-control">
                    <?php foreach ($students as $student): ?>
                        <option value="<?= $student['id']; ?>" <?= $student['id'] == $grade['student_id'] ? 'selected' : ''; ?>>
                            <?= $student['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="grade">Grade</label>
                <input type="text" name="grade" id="grade" class="form-control" value="<?= $grade['grade']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
    </div>
<?php view('partials.footer'); ?>