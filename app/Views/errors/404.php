<?php view('partials.header'); ?>
    <div class="container ">
        <div class="row">
            <div class="col d-flex flex-column justify-content-center align-items-center gap-2">
                <h1 class="text-center text-primary">404</h1>
                <p class="text-center text-info">The Page You Are Looking For Does Not Exist!</p>
                <a href="/" class="btn btn-primary">Go Home</a>
                <?php if (!empty($_SERVER['HTTP_REFERER'])): ?>
                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-secondary">Go Back</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php view('partials.footer'); ?>