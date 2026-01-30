<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Sistema MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body class="d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-lg rounded-4 cupertino-card">
                    <div class="card-body p-4 p-sm-5">
                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-person-fill fs-1"></i>
                            </div>
                            <h2 class="mt-3 fw-bold fs-3">Iniciar Sesión</h2>
                            <p class="text-secondary small">Tópicos Avanzados de Desarrollo Web</p>
                        </div>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger border-0 rounded-3 mb-4 shadow-sm" role="alert">
                                <i class="bi bi-exclamation-circle-fill me-2"></i>
                                <?= $error ?>
                            </div>
                        <?php endif; ?>

                        <form action="index.php?route=auth/login" method="POST">
                            <div class="mb-3 position-relative">
                                <div class="form-floating">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="email"
                                        autocomplete="username" required>
                                    <label for="email">Usuario</label>
                                    <i class="bi bi-envelope input-icon"></i>
                                </div>
                            </div>
                            <div class="mb-4 position-relative">
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="pass" autocomplete="current-password" required>
                                    <label for="password">Contraseña</label>
                                    <i class="bi bi-lock input-icon"></i>
                                </div>
                            </div>
                            <div class="d-grid mb-4">
                                <button type="submit"
                                    class="btn btn-primary btn-lg rounded-3 fw-semibold shadow-sm py-2"
                                    style="background-color: #007AFF; border-color: #007AFF;">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>