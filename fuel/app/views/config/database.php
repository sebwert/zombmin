<fieldset>
    <legend>
        <b>Database options</b>
    </legend>

    <div class="form-group">
        <label for="db_host" class="col-sm-2 control-label">Database Host</label>
        <div class="col-md-10">
            <input type="text" name="db_host" id="db_host"
                   class="form-control" value="<?= $database_host ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="db_name" class="col-sm-2 control-label">Database Name</label>
        <div class="col-md-10">
            <input type="text" name="db_name" id="db_name"
                   class="form-control" value="<?= $database_name ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="db_user" class="col-sm-2 control-label">
            Database User</label>
        <div class="col-md-10">
            <input type="text" name="db_user" id="db_user"
                   class="form-control" value="<?= $database_user ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="db_pw" class="col-sm-2 control-label">
            Database User Password</label>
        <div class="col-md-10">
            <input type="text" name="db_pw" id="db_pw"
                   class="form-control" value="<?= $database_pw ?>">
        </div>
    </div>
</fieldset>
