<!-- Modal -->
<div class="modal fade" id="map_<?= $player['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 865px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    <?= $player['name'] ?>'s Position
                    (<?= $player['position_x'] ?> |
                        <?= $player['position_y'] ?> |
                        <?= $player['position_z'] ?>)
                </h4>
            </div>
            <div class="modal-body">
                <div style="position: relative;">
                    <img src="<?= \Config::get()->getImagePath() ?>/map_nav.jpg" class="img-rounded"
                         width="816" height="810"
                         id="map_image">
                    <span class="glyphicon glyphicon-screenshot"
                          id="pointer_<?= $player['id'] ?>"
                          style="position: absolute;
                        z-index: 999; color: red; font-size: 2em;
                        top: 0px; left: 0px;"></span>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var scaled_x = (((<?= $player['position_x'] ?>) * 405) / 1210);
    var scaled_y = (((<?= $player['position_y'] ?>) * 408) / 1210) * -1;

    console.log(scaled_x, scaled_y);

    var position_x = scaled_x + 400; //last int up -> arrow left 410
    var position_y = scaled_y + 400; //last int up -> arrow up 390

    console.log(position_x, position_y);


    var Pointer = jQuery('#pointer_<?= $player['id'] ?>');
    Pointer.offset({ top: position_y, left: position_x});

</script>
