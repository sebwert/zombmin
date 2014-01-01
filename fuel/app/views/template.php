<!DOCTYPE html>
<html>
    <head>
        <title>Zombmin - <?= \Zombmin\Page::getTitleStrippedTags() ?></title>
        <?= \Zombmin\Page::getHeadElements() ?>
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <?= \Zombmin\Navigation::getNavigation(); ?>
            </div>
        </nav>

        <div class="container">
            <div class="page-header">
                <h1 class="muted" >
                    <small>Zombmin - </small><?= \Zombmin\
                                                        Page::getTitle() ?>
                </h1>
            </div>
        </div>

        <div id="alert_box">
        <? $error = \Zombmin\Messages::get('error'); ?>
        <? $success = \Zombmin\Messages::get('success'); ?>
        <? $info = \Zombmin\Messages::get('info'); ?>
        <? if($error): ?>
            <? if(!$success && !$info): ?>
            <div class="alert alert-danger last">
            <? else: ?>
            <div class="alert alert-danger">
            <? endif; ?>
                <div class="container">
                    <p>
                        <?= implode("\n</p>\n<p>\n", $error) ?>
                    </p>

                </div>
            </div>
        <? endif; ?>
        <? if($success): ?>
            <? if(!$info): ?>
            <div class="alert alert-success last">
            <? else: ?>
            <div class="alert alert-success">
            <? endif; ?>
                <div class="container">
                    <p>
                        <?= implode("\n</p>\n<p>\n", $success) ?>
                    </p>

                </div>
            </div>
        <? endif; ?>
        <? if($info): ?>
            <div class="alert alert-info last">
                <div class="container">
                    <p>
                        <?= implode("\n</p>\n<p>\n", $info) ?>
                    </p>

                </div>
            </div>
        <? endif; ?>
        </div>
        <div class="container">
            <?= $content ?>
        </div>
        <?= \Zombmin\Page::getBottomScripts() ?>
    </body>
</html>
