<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use kartik\datecontrol\DateControl;
use yii\widgets\DetailView;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var <?= ltrim($generator->modelClass, '\\') ?> $model
 */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
   <p> <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Remove'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>



    <?= "<?= " ?>DetailView::widget([
            'model' => $model,
            
        ],
        'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "            '" . $name . "',\n";
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {

        $format = $generator->generateColumnFormat($column);
        if($column->name != 'ID' &&
           $column->name != 'CreateBy' &&
           $column->name != 'CreateDate' &&
           $column->name != 'CreateTerminal' &&
           $column->name != 'UpdateBy' &&
           $column->name != 'UpdateDate' &&
           $column->name != 'UpdateTerminal'
           ){
                if($column->type === 'date'){
                    echo "            [
                        'attribute'=>'$column->name',
                        'format'=>['date',(isset(Yii::\$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::\$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y'],
                        'type'=>DetailView::INPUT_WIDGET,
                        'widgetOptions'=> [
                            'class'=>DateControl::classname(),
                            'type'=>DateControl::FORMAT_DATE
                        ]
                    ],\n";

                }elseif($column->type === 'time'){
                    echo "            [
                        'attribute'=>'$column->name',
                        'format'=>['time',(isset(Yii::\$app->modules['datecontrol']['displaySettings']['time'])) ? Yii::\$app->modules['datecontrol']['displaySettings']['time'] : 'H:i:s A'],
                        'type'=>DetailView::INPUT_WIDGET,
                        'widgetOptions'=> [
                            'class'=>DateControl::classname(),
                            'type'=>DateControl::FORMAT_TIME
                        ]
                    ],\n";
                }elseif($column->type === 'datetime' || $column->type === 'timestamp'){
                    echo "            [
                        'attribute'=>'$column->name',
                        'format'=>['datetime',(isset(Yii::\$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::\$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A'],
                        'type'=>DetailView::INPUT_WIDGET,
                        'widgetOptions'=> [
                            'class'=>DateControl::classname(),
                            'type'=>DateControl::FORMAT_DATETIME
                        ]
                    ],\n";
                }else{
                    echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                }
           }
    }
}
?>
        ],
       
    ]) ?>

</div>
