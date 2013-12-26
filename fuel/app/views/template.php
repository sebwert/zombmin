<!DOCTYPE html>
<html>
    <head>
        <title>php7admin - <?= \Php7admin\Page::getTitleStrippedTags() ?></title>
        <?= \Php7admin\Page::getHeadElements() ?>
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <?= \Php7admin\Navigation::getNavigation(); ?>
            </div>
        </nav>

        <div class="container">
            <div class="page-header">
                <h1 class="muted" >
                    <small>php7admin - </small><?= \Php7admin\
                                                        Page::getTitle() ?>
                </h1>
            </div>
        </div>

        <div id="alert_box">
        <? $error = \Php7admin\Messages::get('error'); ?>
        <? $success = \Php7admin\Messages::get('success'); ?>
        <? $info = \Php7admin\Messages::get('info'); ?>
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
        <?= \Php7admin\Page::getBottomScripts() ?>
    </body>
</html>
