<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \common\models\User;
use yii\helpers\ArrayHelper;
use \common\models\Country;

$this->title = 'Регистрация';

?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'name')->textInput(['value'=>'Мое агенство', 'autofocus' => true]) ?>

                <?= $form->field($model, 'fio')->textInput() ?>

                <?= $form->field($model, 'country_id')->dropDownList(ArrayHelper::map(Country::find()->all(),'id','name'), ['prompt' => 'Выберите страну']); ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'phone')->textInput() ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'repeat_password')->passwordInput() ?>

                <?= $form->field($model, 'role')->textInput(['value'=>User::ROLE_ADMINISTRATOR, 'readonly' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
