<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 26.03.2017
 * Time: 22:40
 */
use yii\bootstrap\Tabs;
use common\models\CategoryProduct,
    common\models\ProductFeature;


if (!isset($mode))
    $mode = 'view';
if (!isset($containerClass))
    $containerClass = 'product-view';
?>
<!-- Блок уведомлений -->
<div id="alert-placement">
    <?php
    if (isset($alert)) {
        echo Alert::widget([
            'options' => [ 'class' => "alert-{$alert['type']}", ],
            'body' => $alert['body'],
        ]);
    }
    ?>
</div>
<?= Tabs::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'content' => $this->render('_tab1', [
                'mode' => $mode,
                'model' => $model,
                'imageUploader' => $imageUploader,
            ]),
        ],
        [
            'label' => 'Характеристики',
            'content' => $this->render('_tab2', [
                'mode' => $mode,
                'model' => new ProductFeature(),
                'product_id' => $model->id,
            ]),
        ],
        [
            'label' => 'Категории',
            'content' => $this->render('_tab3', [
                'mode' => $mode,
                'model' => new CategoryProduct(),
                'product_id' => $model->id,
            ]),
        ],
    ],
]) ?>
<!-- Скрипты -->
<script type="text/javascript">
    function deleteLink() {
        var that = this;
        event.preventDefault();
        if (!confirm('Вы уверены, что хотите удалить связь?'))
            return;
        $.ajax(that.href, {
            success: function (data, status) {
                $('#alert-placement').html(data.response);
                if (data.status == 'success' && (el = $(that).closest('tr'))){
                    var tbody = $(el).closest('tbody');
                    if ($(tbody).find('tr').size() == 1)
                        el = $(tbody).closest('.row');
                    el.hide(1000);
                    var tm = setTimeout(function(){
                        clearTimeout(tm);
                        el.detach();
                    }, 1000);
                }
            },
            error: function (data, status, e) {
                alert('Request error');
            }
        })
    }
    function getPositions() {
        debugger;
        var that = $(this), url = that.attr('data-url'),
            action = that.attr('data-action-url'),
            category = that.attr('data-category'),
            product = that.attr('data-product'),
            position = that.attr('data-position');
        $.ajax(url+'?category_id='+category+'&product_id='+product, {
            dataType: 'json',
            async: false,
            success: function (data, status) {
                var list = $('#list_'+category+'_'+product);
                list.html("");
                while (data.length) {
                    el = data.shift();
                    if (el.list_position == position)
                        list.append('<li class="disabled"><a data-pjax=0 href="#">'+el.list_position+'</a></li>');
                    else
                        list.append('<li><a data-pjax=0 class="new-position" href="#" data-action-url="'+action+'&new_position='+el.list_position+'">'+el.list_position+'</a></li>');
                }
            },
            error: function (data, status, e) {
                alert('Request error');
            }
        });
        return false;
    }
    function changePosition(){
        var btn = $(this).parentsUntil('td').find('button');
        $.ajax($(this).attr('data-action-url'), {
            dataType: 'json',
            success: function(data, status) {
                if (data.status == 'success') {
                    var html = btn.html().replace(/[0-9]*/, data.position);
                    btn.html(html);
                    btn.attr('data-position', +data.position);
                }
                $('#alert-placement').html(data.response);
            },
            error: function(data, status, e) {
                alert('Response error: ' + e);
            }
        });
    }

    window.addEventListener('load', function () {
        $(document).on('click', '[data-action-delete-link]', deleteLink);
        $(document).on('click', '.position-selector', getPositions);
        $(document).on('click', '.new-position', changePosition);
    });
</script>