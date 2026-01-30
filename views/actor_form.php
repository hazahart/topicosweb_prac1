<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($actor) ? 'Editar' : 'Nuevo' ?> Actor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card form-card p-4">
                    <h3 class="fw-bold mb-4 text-center"><?= isset($actor) ? 'Editar Actor' : 'Crear Actor' ?></h3>

                    <form action="index.php?route=actor/<?= isset($actor) ? 'update' : 'store' ?>" method="POST">
                        <?php if (isset($actor)): ?>
                            <input type="hidden" name="actor_id" value="<?= $actor['actor_id'] ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">Nombre</label>
                            <input type="text" name="first_name" class="form-control form-control-lg bg-light border-0"
                                value="<?= $actor['first_name'] ?? '' ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-bold">Apellido</label>
                            <input type="text" name="last_name" class="form-control form-control-lg bg-light border-0"
                                value="<?= $actor['last_name'] ?? '' ?>" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3">Guardar</button>
                            <a href="index.php?route=home"
                                class="btn btn-link text-decoration-none text-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>