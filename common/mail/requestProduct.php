<?php
/**
 * Template of mail message
 *
 * Created by PhpStorm.
 * User: user
 * Date: 11.05.2017
 * Time: 12:34
 */
?>
<h3> Online-заявка</h3>
<p>Контактная информация:</p>
<p><span style="font-weight: bold">Город: </span><?= \Yii::$app->params['city']->name?></p>
<p><span style="font-weight: bold">E-mail: </span><?= $contactEmail?></p>
<p><span style="font-weight: bold">Телефон: </span><?= $contactPhone?></p>
<hr/>
<p><span tyle="font-weight: bold">Текст</span></p>
<?= $body ?>