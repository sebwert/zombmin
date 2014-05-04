<fieldset>
    <legend>
        <b>Telnet options</b>
    </legend>

    <div class="form-group">
        <label for="telnet_ip" class="col-sm-2 control-label">Telnet IP</label>
        <div class="col-md-10">
            <input type="text" name="telnet_ip" id="telnet_ip"
                   class="form-control" value="<?= $telnet_ip ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="telnet_ip" class="col-sm-2 control-label">
            Telnet Port</label>
        <div class="col-md-10">
            <input type="text" name="telnet_port" id="telnet_port"
                   class="form-control" value="<?= $telnet_port ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="telnet_password" class="col-sm-2 control-label">
            Telnet Password</label>
        <div class="col-md-10">
            <input type="text" name="telnet_password" id="telnet_password"
                   class="form-control" value="<?= $telnet_password ?>">
        </div>
    </div>
</fieldset>