<!-- Modal -->
<div class="modal fade" id="map" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 865px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">
                    <span id="map_cur_playername">map_cur_playername</span>'s Position
                    (<span id="map_cur_playerpos_x">map_cur_playerpos_x</span> |
                        <span id="map_cur_playerpos_y">map_cur_playerpos_y</span> |
                        <span id="map_cur_playerpos_z">map_cur_playerpos_z</span>)
                </h4>
            </div>
            <div class="modal-body">
                <div style="position: relative;">
                    <img src="<?= \Config::getImagePath() ?>/map_nav_78.jpg" class="img-rounded"
                         width="816" height="810"
                         id="map_image">
                    <? foreach($all_player as $possible_player): ?>
                        <span class="glyphicon glyphicon-screenshot map_pointer"
                              id="pointer_<?= $possible_player['id'] ?>"
                              style="position: absolute;
                            z-index: 999; color: red; font-size: 2em;
                            top: 0px; left: 0px;" 
                            title="<?= $possible_player['name'] ?>"></span>
                    <? endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var set_position = function(id, pos_x, pos_y) {
    var scaled_x = (((pos_x) * 405) / 1350);
    var scaled_y = (((pos_y) * 408) / 1380) * -1;


    var position_x = scaled_x + 400; //last int up -> arrow left 410
    var position_y = scaled_y + 400; //last int up -> arrow up 390



    var Pointer = jQuery('#pointer_' + id);
    Pointer.offset({ top: position_y, left: position_x});
}
<? foreach($all_player as $possible_player): ?>
set_position(<?=$possible_player['id']?>, 
             <?=$possible_player['position_x']?>,
             <?=$possible_player['position_y']?>) 
<? endforeach; ?>

</script>
