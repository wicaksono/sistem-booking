<?php
/**
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
?>

<?php $form = $this->beginWidget('ActiveForm', [
    'id' => 'comm-placing-dateset-form',
    'htmlOptions' => ['class' => 'form-horizontal'],
    'enableClientValidation' => FALSE,
    'enableAjaxValidation' => TRUE,
    'clientOptions'=>array(
        'validateOnSubmit' => TRUE,
        'validateOnChange' => TRUE,
    ),
]); ?>

<div class="form-group">
    <?php echo $form->label($dateset, 'date', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $dateset,
            'attribute' => 'date',
            'htmlOptions' => [
                'class' => 'form-control'
            ]
        )); ?>
        <?php echo $form->error($dateset, 'date', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($dateset, 'type', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->dropDownList($dateset, 'type', CommPlacing::getTypeList(), ['class' => 'form-control']) ?>
        <?php echo $form->error($dateset, 'type', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <?php echo CHtml::submitButton('Submit', ['class' => 'btn btn-primary']); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
