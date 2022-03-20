<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h1 class="text-center mb-4">Sign Up</h1>

<form action="/register/create" method="POST">
    <div class="form-floating mb-3">
        <input type="text" class="form-control <?= isset($errors->name) ? 'is-invalid' : '' ?>" name="name" id="name" placeholder="Name" value="<?= old('name') ?>">
        <label for="name">Name</label>
        <?php if (isset($errors->name)) : ?>
            <div class="invalid-feedback">
                <?= $errors->name ?>
            </div>
        <?php endif ?>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control <?= isset($errors->email) ? 'is-invalid' : '' ?>" name="email" id="email" placeholder="Email Address" value="<?= old('email') ?>">
        <label for="email">Email Address</label>
        <?php if (isset($errors->email)) : ?>
            <div class="invalid-feedback">
                <?= $errors->email ?>
            </div>
        <?php endif ?>
    </div>
    <div class="form-floating mb-4">
        <input type="password" class="form-control <?= isset($errors->password) ? 'is-invalid' : '' ?>" name="password" id="password" placeholder="Password">
        <label for="password">Password</label>
        <?php if (isset($errors->password)) : ?>
            <div class="invalid-feedback">
                <?= $errors->password ?>
            </div>
        <?php endif ?>
    </div>

    <div class="d-grid mb-3">
        <button class="btn btn-primary">Register</button>
    </div>

    <p class="text-center mb-0">
        <a href="/login">Already have an account?</a>
    </p>
</form>

<?= $this->endSection() ?>