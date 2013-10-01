<?php
/**
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
?>

<?php $form = $this->beginWidget('ActiveForm', [
    'id' => 'comm-placing-form',
    'htmlOptions' => ['class' => 'form-horizontal'],
    'enableClientValidation' => FALSE,
    'enableAjaxValidation' => TRUE,
    'clientOptions'=>array(
        'validateOnSubmit' => TRUE,
        'validateOnChange' => FALSE,
        'afterValidate' => 'js:function(form, attribute, hasError){'
        .       'if(!hasError) {'
        .           '$.fn.yiiGridView.update("comm-placing-browse-grid");'
        .           '$("#comm-booking-placing-form").load("'. $this->createUrl('placing/update', ['ne_id' => $placing->ne_id, 'br_id' => $placing->br_id]) .'");'
        .           'return false;'
        .      '}'
        .   '}'
    ),
]); ?>

<div class="form-group">
    <?php echo $form->label($placing, 'ns_id', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->dropDownList($placing, 'ns_id', NewsSection::getOptionList(), ['class' => 'form-control']) ?>
        <?php echo $form->error($placing, 'ns_id', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($placing, 'page', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->textField($placing, 'page', ['class' => 'form-control']) ?>
        <?php echo $form->error($placing, 'page', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($placing, 'posx', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->textField($placing, 'posx', ['class' => 'form-control']) ?>
        <?php echo $form->error($placing, 'posx', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($placing, 'posy', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->textField($placing, 'posy', ['class' => 'form-control']) ?>
        <?php echo $form->error($placing, 'posy', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <?php echo CHtml::submitButton('Submit', ['class' => 'btn btn-primary']); ?>
        <?php echo CHtml::link('Render', ['booking/render'], ['class' => 'render btn btn-warning']); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
