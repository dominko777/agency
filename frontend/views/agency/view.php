<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Agency */

$this->title = $model->name;

?>
<div class="agency-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'country.name',
            'phone',
        ],
    ]) ?>

</div>
