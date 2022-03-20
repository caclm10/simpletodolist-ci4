<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/app.css">
    <title>SimpleToDoList</title>

</head>

<body>
    <?php
    $notify = session('error') ?: (session('success') ?: '');
    $notifyName = session('error') ? 'error' : (session('success') ? 'success' : '');
    ?>
    <input type="hidden" id="notify" data-name="<?= $notifyName ?>" value="<?= $notify ?>">

    <div class="container">
        <div class="card mx-auto" style="max-width: 540px;">
            <div class="card-body">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <script defer src="https://unpkg.com/alpinejs@3.9.1/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/app.js"></script>
</body>

</html>