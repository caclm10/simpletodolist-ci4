<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<input type="hidden" id="error-profile" value="<?= (int) !empty(session('errors-profile')) ?>">
<input type="hidden" id="error-todo" value="<?= (int) !empty(session('errors-todo')) ?>">

<form action="/logout" method="POST" id="logout-form"></form>

<div class="modal fade" id="edit-profile-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit-profile-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-profile-modal-label">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/profile/edit" method="POST" id="edit-profile">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control <?= isset($errorsProfile->name) ? 'is-invalid' : '' ?>" name="name" id="name" placeholder="Name" value="<?= old('name', auth_user()->name) ?>">
                        <label for="name">Name</label>
                        <?php if (isset($errorsProfile->name)) : ?>
                            <div class="invalid-feedback">
                                <?= $errorsProfile->name ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?= auth_email() ?>" disabled>
                        <label for="email">Email Address</label>
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control <?= isset($errorsProfile->password) ? 'is-invalid' : '' ?>" name="password" id="password" placeholder="New Password">
                        <label for="password">New Password</label>
                        <?php if (isset($errorsProfile->password)) : ?>
                            <div class="invalid-feedback">
                                <?= $errorsProfile->password ?>
                            </div>
                        <?php endif ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="edit-profile" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-todo-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="add-todo-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-todo-modal-label">Add Todo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/todo/create" method="POST" id="add-todo">
                    <div class="form-floating">
                        <input type="text" class="form-control <?= isset($errorsTodo->title) ? 'is-invalid' : '' ?>" name="title" id="title" placeholder="Title">
                        <label for="title">Title</label>
                        <?php if (isset($errorsTodo->title)) : ?>
                            <div class="invalid-feedback">
                                <?= $errorsTodo->title ?>
                            </div>
                        <?php endif ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="add-todo" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>

<div class="mb-4 d-flex justify-content-between align-items-center">
    <h1 class="mb-0 fs-3">To-Do List</h1>

    <div class="dropdown">
        <a class="text-reset text-decoration-none" href="#" role="button" id="user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
            Hi, <?= auth_user()->name ?> <i class="bi bi-person-circle"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user-dropdown">
            <li>
                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-profile-modal">Edit Profile</button>
            </li>
            <li>
                <button form="logout-form" class="dropdown-item">Logout</button>
            </li>
        </ul>
    </div>
</div>
<div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-todo-modal">
        <i class="bi bi-plus"></i> ToDo
    </button>
</div>

<div id="todo-list" class="d-flex flex-column">
    <?php foreach ($todos as $todo) : ?>
        <div class="d-flex mb-3">
            <a href="/todo/<?= $todo->id ?>" class="card shadow-sm w-100 me-3 text-reset text-decoration-none shadow-sm hvr-float">
                <div class="card-body">
                    <?= $todo->title ?>
                </div>
            </a>
            <form action="/todo/<?= $todo->id ?>/destroy" method="POST" onsubmit="return confirm('Delete this todo?')">
                <button type="submit" class="btn btn-outline-danger h-100">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </div>
    <?php endforeach ?>
</div>

<?= $this->endSection() ?>