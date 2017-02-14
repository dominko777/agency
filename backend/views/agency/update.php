<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Agency */

$this->title = 'Редактировать агенство: ' . $model->name;

?>
<div class="agency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
