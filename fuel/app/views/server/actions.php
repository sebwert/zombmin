<form action="<?= Uri::create('server/say') ?>" method="POST" class="form-inline">
    <div class="col-md-offset-1">
        <fieldset>
            <legend>say something</legend>
                <div class="form-group">
                    <input class="form-control" type="text"
                           name="string" placeholder="your text...">
                </div>
                <button class="btn btn-success" type="submit">
                    submit
                </button>
        </fieldset>
    </div>
</form>