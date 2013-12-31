

<h3 class="text-primary">Server</h3>

<ul class="nav nav-tabs">
    <li><a href="#actions" data-toggle="tab">Actions</a></li>
    <li class="active">
        <a href="#stats" data-toggle="tab">Stats</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane" id="actions">
        <?= $actions ?>
    </div>
    <div class="tab-pane active" id="stats">
        <?= $stats ?>
    </div>
</div>

<h3 class="text-primary">Clients</h3>
<?= $list ?>
