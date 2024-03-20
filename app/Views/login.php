<?php include 'partials/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <h1 class="text-center">Login</h1>
                <form action="/login" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
<?php include 'partials/footer.php'; ?>