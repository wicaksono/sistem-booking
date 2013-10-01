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
        'validateOnChange' => FALSE,
        'afterValidate' => 'js:function(form, attribute, hasError){'
        .       'if(!hasError) {'
        .           '$.fn.yiiGridView.update("comm-booking-request-manage-grid");'
        .           '$("#comm-booking-request-create-page").load("'. $this->createUrl('request/create', ['id' => $request->cb_id]) .'");'
        .      '}'
        .   '}'
    ),
]); ?>
<fieldset>
    <legend><?php echo $request->isNewRecord ? 'Create' : 'Update'; ?>&nbsp;Request</legend>
<div class="form-group">
    <?php echo $form->label($request, 'ns_id', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->dropDownList($request, 'ns_id', NewsSection::getOptionList(), ['class' => 'form-control']) ?>
        <?php echo $form->error($request, 'ns_id', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($request, 'page', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->textField($request, 'page', ['class' => 'form-control']) ?>
        <?php echo $form->error($request, 'page', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($request, 'sizex', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->textField($request, 'sizex', ['class' => 'form-control']) ?>
        <?php echo $form->error($request, 'sizex', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($request, 'sizey', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->textField($request, 'sizey', ['class' => 'form-control']) ?>
        <?php echo $form->error($request, 'sizey', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($request, 'color', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->dropDownList($request, 'color', CommBookingRequest::getColorList(), ['class' => 'form-control']) ?>
        <?php echo $form->error($request, 'color', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($request, 'stat', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->dropDownList($request, 'stat', CommBookingRequest::getStatList(), ['class' => 'form-control']) ?>
        <?php echo $form->error($request, 'stat', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($request, 'publish_at', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $request,
            'attribute' => 'publish_at',
            'htmlOptions' => [
                'class' => 'form-control'
            ]
        )); ?>
        <?php echo $form->error($request, 'publish_at', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <?php echo CHtml::submitButton('Submit', ['class' => 'btn btn-primary']); ?>
    </div>
</div>
</fieldset>
<?php $this->endWidget(); ?>
