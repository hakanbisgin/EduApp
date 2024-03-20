<?php view('partials.header'); ?>
    <div class="container">
        <h1>Create Grade</h1>
        <form action="/grades" method="post">
            <div class="form-group">
                <label for="term_id">Term</label>
                <select name="term_id" id="term_id" class="form-control" required>
                    <?php foreach ($terms as $term): ?>
                        <option value="<?= $term['id']; ?>"><?= $term['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="course_id">Course</label>
                <select name="course_id" id="course_id" class="form-control" required>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= $course['id']; ?>"><?= $course['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="student_id">Student</label>
                <select name="student_id" id="student_id" class="form-control" required>
                    <?php foreach ($students as $student): ?>
                        <option value="<?= $student['id']; ?>"><?= $student['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="grade">Grade</label>
                <input type="number" name="grade" id="grade" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
<?php view('partials.footer'); ?>