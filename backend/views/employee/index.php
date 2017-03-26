<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = ['label' => 'Справочники', 'url' => ['directory/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новый сотрудник', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'headerOptions' => [ 'style' => 'width: 50px;'],
            ],
            // 'user_id',
            'fio',
            'post',
            [
                'attribute' => 'photo',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::img('data:image/jpeg;charset=utf-8;base64,' . base64_encode($data->photo), ['style' => 'width:100px;']);
                },
            ],
            [
                'label' => 'Контакты',
                'format' => 'raw',
                'value' => function($data) {
                    $res = [];
                    if ($data->phone)
                        $res[] = "<span>Телефон: </span><a href='tel:{$data->phone}'>{$data->phone}</a>";
                    if ($data->email)
                        $res[] = "<span>E-mail: </span><a href='mailto:{$data->email}'>{$data->email}</a>";
                    return implode('<br>', $res);
                }
            ],
            // 'email:email',
            // 'phone',
            // 'is_chief',
            // 'create_dt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
