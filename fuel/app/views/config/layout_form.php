<form action="<?= Uri::create('config/save') ?>" method="POST"
      role="form" class="form-horizontal">

    <?= $content ?>

    <div class="form-group">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit">send</button>
        </div>
    </div>
</form>