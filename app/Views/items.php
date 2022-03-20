<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<input type="hidden" id="error-item" value="<?= (int) !empty(session('errors-item')) ?>">

<div class="modal fade" id="add-item-modal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="add-item-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-item-modal-label">Add Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/todo/<?= $todo->id ?>/item/create" method="POST" id="add-todo">
                    <div class="form-floating">
                        <textarea class="form-control <?= isset($errorsItem->content) ? 'is-invalid' : '' ?>" name="content" id="content" placeholder="Content" style="height:100px"><?= old('content') ?></textarea>
                        <label for="content">Content</label>
                        <?php if (isset($errorsItem->content)) : ?>
                            <div class="invalid-feedback">
                                <?= $errorsItem->content ?>
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

<h1 class="mb-4 fs-3"><?= $todo->title ?></h1>

<div class="d-flex justify-content-between mb-3">
    <a href="/todo" class="btn btn-secondary">
        <i class="bi bi-arrow-left-short"></i> Back
    </a>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-item-modal">
        <i class="bi bi-plus"></i> Task
    </button>
</div>



<div id="todo-list" class="d-flex flex-column">
    <?php if ($items) : ?>
        <?php foreach ($items as $item) : ?>
            <div class="d-flex mb-3" x-data="todoItems(<?= $item->is_done ?>, <?= $item->id ?>)">
                <span class="card shadow-sm w-100 me-3 text-reset text-decoration-none shadow-sm hvr-float" style="cursor:pointer" @dblclick="mark">
                    <div class="card-body d-flex justify-content-between">
                        <span><?= $item->content ?></span>
                        <i class="bi bi-check2 text-success" x-show="done"></i>
                    </div>
                </span>
                <form action="/todo/<?= $todo->id ?>/item/<?= $item->id ?>/destroy" method="POST" onsubmit="return confirm('Delete this task?')">
                    <button type="submit" class="btn btn-outline-danger h-100">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>

<?= $this->endSection() ?>