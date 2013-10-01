<?php
/**
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
?>

<?php $form = $this->beginWidget('ActiveForm', [
    'id' => 'comm-booking-request-form',
    'htmlOptions' => ['class' => 'form-horizontal'],
    'enableClientValidation' => FALSE,
    'enableAjaxValidation' => TRUE,
    'clientOptions'=>array(
        'validateOnSubmit' => TRUE,
        'validateOnChange' => FALSE
    ),
]); ?>

<div class="form-group">
    <?php echo $form->label($account, 'username', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->textField($account, 'username', ['class' => 'form-control']) ?>
        <?php echo $form->error($account, 'username', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($account, 'password', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->passwordField($account, 'password', ['class' => 'form-control']) ?>
        <?php echo $form->error($account, 'password', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <?php echo CHtml::submitButton('Login', ['class' => 'btn btn-primary']); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
