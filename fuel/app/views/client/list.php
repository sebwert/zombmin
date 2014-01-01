<div class="panel-group" id="accordion">
    <? $i = 0; ?>
    <? foreach($all_player as $player): ?>
    <div class="client panel">
        <div class="row panel-heading">
            <div class="col-md-4 col-md-offset-1">
                <h4>
                    <a data-toggle="collapse"
                       data-parent="#accordion"
                       href="#collapse<?= $i ?>" style="color: black;">
                        <span class="text-muted">
                            #<?= $player['number'] ?>
                        </span>
                        &nbsp;&nbsp;<?= $player['name'] ?>
                        <span class="small text-muted">
                            (id: <?= $player['id'] ?>)
                        </span>
                    </a>
                </h4>
            </div>
            <div class="col-md-2 text-danger">
                <button data-toggle="modal" class="btn"
                        data-target="#map_<?= $player['id'] ?>">
                        <b>
                            <span class="glyphicon glyphicon-map-marker
                                  text-success">

                            </span>
                        <b>
                </button>
                <span class="glyphicon glyphicon-plus"></span>
                <b><?= $player['health'] ?></b>
            </div>
        </div>
        <div class="row panel-collapse collapse"
             id="collapse<?=$i?>">
            <div class="col-md-5 col-md-offset-2">
                <form action="<?= Uri::create('server/spawnEntity') ?>"
                      method="POST" role="form" class="form-inline">
                    <fieldset>
                        <legend>
                            <b>spawn entity at player</b>
                        </legend>
                        <div class="form-group">
                            <label for="entity">
                                Select Entity:
                            </label>
                            <select name="entity" id="entity">
                                <?= implode("\n", $entity_options) ?>
                            </select>
                        </div>
                        <button class="btn btn-success" type="submit">
                            spawn
                        </button>
                    </fieldset>
                    <input type="hidden" name="player"
                                        value="<?=$player['id'] ?>">
                </form>
            </div>

            <div class="col-md-5">
                <form action="<?= Uri::create('server/kick') ?>"
                      method="POST" role="form" class="form-inline">
                    <fieldset>
                        <legend>
                            <b>kick</b>
                        </legend>
                        <div class="form-group">
                            <input id="reason_kick_<?= $player['name'] ?>"
                                   class="form-control form-group"
                                   type="text" name="reason_kick" value=""
                                   placeholder="kick reason">
                        </div>
                        <button class="btn btn-warning" type="submit">
                            kick
                        </button>
                    </fieldset>
                    <input type="hidden" name="player"
                                        value="<?= urlencode($player['name']) ?>">
                </form>
                <form action="<?= Uri::create('server/ban') ?>"
                      method="POST" role="form" class="form-inline">
                    <fieldset>
                        <legend>
                            <b>ban</b>
                        </legend>

                        <div class="form-group">
                            <input id="reason_ban_<?= $player['name'] ?>"
                                   class="form-control"
                                   type="text" name="reason_ban" value=""
                                   placeholder="ban reason">
                        </div>

                        <div class="form-group">
                            <select id="time_ban_<?= $player['name'] ?>"
                                    class="form-control" name="time">
                                <?=  implode("\n", $ban_time_options) ?> ?>
                            </select>
                        </div>

                        <button class="btn btn-danger" type="submit">
                            ban
                        </button>
                    </fieldset>
                    <input type="hidden" name="player"
                                        value="<?= urlencode($player['name']) ?>">
                </form>
            </div>
        </div>
    </div>
    <?= Request::forge('client/map')->execute(array('player' => $player)) ?>
    <? $i++; ?>
    <? endforeach; ?>
</div>