<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="<?= base_url() ?>/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <?php if(session()->getFlashdata('success')) : ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <?= session()->getFlashdata('success'); ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(session()->getFlashdata('warning')) : ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <?= session()->getFlashdata('warning'); ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        <?php endif; ?>
                                        <form action="<?= site_url('auth') ?>" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control <?php if(!empty($validation)) echo ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" type="text" placeholder="Username" name="username" value="<?= old('username') ?>"/>
                                                <div class="invalid-feedback">
                                                <?php if(!empty($validation)) echo $validation->getError('username'); ?>
                                                </div>
                                                <label for="username">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control <?php if(!empty($validation)) echo ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" type="password" placeholder="Password" name="password"/>
                                                <div class="invalid-feedback">
                                                <?php if(!empty($validation)) echo $validation->getError('password'); ?>
                                                </div>
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="rememberPassword" type="checkbox" value="1" name="rememberPassword" />
                                                <label class="form-check-label" for="rememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <div></div>
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>/js/scripts.js"></script>
    </body>
</html>
