<?php include 'partials/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center text-primary">New type of Edu...</h1>
                <p class="text-center text-info">Basically, practically, aimed needed </p>
            </div>
        </div>
        <div class="row  gap-3">
            <a <?= authenticated()? 'href="/terms"': "#" ?> class="text-decoration-none col p-3 bg-info rounded ">
                <img src="/img/term.svg" class="img-fluid mb-2" alt="Education">
                <h2 class="text-center text-white">Terms</h2>
                <p class="text-center">Define your terms compatible with your Education Program</p>
            </a>
            <a <?= authenticated()? 'href="/courses"': "#" ?> class="text-decoration-none col p-3 bg-info rounded">
                <img src="/img/course.svg" class="img-fluid mb-2" alt="Course">
                <h2 class="text-center text-white">Courses</h2>
                <p class="text-center">Complete your Course names and weights.</p>
            </a>
            <a <?= authenticated()? 'href="/students"': "#" ?> class="text-decoration-none col p-3 bg-info rounded">
                <img src="/img/student.svg" class="img-fluid mb-2" alt="Student">
                <h2 class="text-center text-white">Students</h2>
                <p class="text-center">Create or update your students</p>
            </a>
            <a <?= authenticated()? 'href="/grades"': "#" ?> class="text-decoration-none col p-3 bg-info rounded">
                <img src="/img/grade.svg" class="img-fluid mb-2" alt="Grade">
                <h2 class="text-center text-white">Grades</h2>
                <p class="text-center">Enter exam results.</p>
            </a>
        </div>
    </div>
<?php include 'partials/footer.php'; ?>