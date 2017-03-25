<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 25.03.2017
 * Time: 10:15
 */
use yii\helpers\Html;

if (!isset($header) || !is_array($header))
    $head = Html::a('...', '#');
else
    $head = Html::a($header['text'],[$header['link']]);

$description = isset($description)? $description : '...';
$icon = isset($icon) ? $icon : 'fa-folder';
if (!isset($short_links) || !is_array($short_links))
    $short_links = [];
?>
<div class="col col-sm-4 col-md-3 col-lg-3 no-padding">
    <div class="window">
        <div class="sub-wrap">
            <header>
                <h5><i class="fa <?= $icon ?>" aria-hidden="true"></i><?= $head ?></h5>
            </header>
            <section>
                <p><small><i><?= $description ?></i></small></p>
                <ul>
                    <?php
                        foreach ($short_links as $link)
                            echo '<li>'.Html::a($link['text'], [$link['link']]).'</li>';
                    ?>
                </ul>
            </section>
        </div>
        <footer><i class="fa fa-ellipsis-v"></i></footer>
    </div>
</div>
