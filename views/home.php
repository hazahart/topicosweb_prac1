<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actores | Sakila (21030017)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">CRUD Sakila (21030017)</a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary small d-none d-md-block"><?= htmlspecialchars($_SESSION['user']) ?></span>
                <a href="index.php?route=auth/logout" class="btn btn-outline-danger btn-sm rounded-pill px-3">Salir</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0 text-dark">Actores</h2>
            <button type="button" class="btn btn-primary btn-ios shadow-sm" data-bs-toggle="modal"
                data-bs-target="#actorModal" onclick="prepareCreate()">
                <i class="bi bi-plus-lg me-1"></i> Nuevo Actor
            </button>
        </div>
        <div class="card table-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary small text-uppercase">
                            <tr>
                                <th class="ps-4 py-3 border-0">ID</th>
                                <th class="py-3 border-0">Nombre</th>
                                <th class="py-3 border-0">Apellido</th>
                                <th class="py-3 border-0 text-end pe-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            <?php foreach ($actors as $actor): ?>
                                <tr>
                                    <td class="ps-4 text-secondary small"><?= $actor['actor_id'] ?></td>
                                    <td class="fw-medium"><?= htmlspecialchars($actor['first_name']) ?></td>
                                    <td><?= htmlspecialchars($actor['last_name']) ?></td>
                                    <td class="text-end pe-4">
                                        <button type="button" class="btn btn-light btn-sm rounded-circle text-primary me-1"
                                            data-bs-toggle="modal" data-bs-target="#actorModal"
                                            onclick="prepareEdit(<?= $actor['actor_id'] ?>, '<?= htmlspecialchars($actor['first_name']) ?>', '<?= htmlspecialchars($actor['last_name']) ?>')">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>

                                        <button type="button" class="btn btn-light btn-sm rounded-circle text-danger"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            onclick="prepareDelete(<?= $actor['actor_id'] ?>)">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Crear y editar (modal) -->
    <div class="modal fade modal-cupertino" id="actorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTitle">Nuevo Actor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="actorForm" action="" method="POST">
                        <input type="hidden" name="actor_id" id="actor_id">

                        <div class="mb-3 position-relative">
                            <div class="form-floating">
                                <input type="text" name="first_name" id="first_name" class="form-control"
                                    placeholder="Nombre" required>
                                <label for="first_name">Nombre</label>
                                <i class="bi bi-person input-icon"></i>
                            </div>
                        </div>

                        <div class="mb-4 position-relative">
                            <div class="form-floating">
                                <input type="text" name="last_name" id="last_name" class="form-control"
                                    placeholder="Apellido" required>
                                <label for="last_name">Apellido</label>
                                <i class="bi bi-tag input-icon"></i>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3"
                                style="background-color: #007AFF; border-color: #007AFF;">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-cupertino" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm"> <!-- modal-sm para estilo alerta -->
            <div class="modal-content text-center">
                <div class="modal-body p-4">
                    <div class="mb-3 text-danger opacity-75">
                        <i class="bi bi-trash-fill fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-2">¿Eliminar actor?</h5>
                    <p class="text-secondary small mb-4">Esta acción no se puede deshacer.</p>

                    <div class="d-grid gap-2">
                        <a href="#" id="confirmDeleteBtn" class="btn btn-danger rounded-3 fw-medium">Eliminar</a>
                        <button type="button" class="btn btn-light text-primary bg-transparent border-0"
                            data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const form = document.getElementById('actorForm');
        const title = document.getElementById('modalTitle');
        const idInput = document.getElementById('actor_id');
        const firstNameInput = document.getElementById('first_name');
        const lastNameInput = document.getElementById('last_name');

        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        function prepareCreate() {
            form.action = 'index.php?route=actor/store';
            title.innerText = 'Nuevo Actor';
            idInput.value = '';
            firstNameInput.value = '';
            lastNameInput.value = '';
        }

        function prepareEdit(id, firstName, lastName) {
            form.action = 'index.php?route=actor/update';
            title.innerText = 'Editar Actor';
            idInput.value = id;
            firstNameInput.value = firstName;
            lastNameInput.value = lastName;
        }

        function prepareDelete(id) {
            confirmDeleteBtn.href = `index.php?route=actor/delete&id=${id}`;
        }
    </script>
</body>

</html>