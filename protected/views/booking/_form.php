<?php
/**
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
?>

<?php Yii::app()->getClientScript()->registerScript('comm-booking-form', '
$("#CommBooking_co_id").typeahead({
    name: "company",
    remote: "/~nix/project/bookshit/index-dev.php?r=company/browse&query=%QUERY",
    template: "<p>{{name}} – <strong>{{code}}</strong></p>",
    engine: Hogan
});
$("#CommBooking_sa_id").typeahead({
    name: "sales",
    remote: "/~nix/project/bookshit/index-dev.php?r=account/sales&query=%QUERY",
    template: "<p>{{name}} – <strong>{{code}}</strong></p>",
    engine: Hogan
});
'); ?>

<?php $form = $this->beginWidget('ActiveForm', [
    'id' => 'comm-booking-form',
    'htmlOptions' => ['class' => 'form-horizontal'],
    'enableClientValidation' => FALSE,
    'enableAjaxValidation' => TRUE,
    'clientOptions'=>array(
        'validateOnSubmit' => TRUE,
        'validateOnChange' => FALSE,
    ),
]); ?>
<fieldset>
    <legend>Booking</legend>
<div class="form-group">
    <?php echo $form->label($booking, 'name', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->textField($booking, 'name', ['class' => 'form-control']) ?>
        <?php echo $form->error($booking, 'name', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($booking, 'sa_id', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->textField($booking, 'sa_id', ['class' => 'form-control']) ?>
        <?php echo $form->error($booking, 'sa_id', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($booking, 'co_id', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->textField($booking, 'co_id', ['class' => 'form-control']) ?>
        <?php echo $form->error($booking, 'co_id', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($booking, 'stat', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->dropDownList($booking, 'stat', CommBooking::getStatList(), ['class' => 'form-control']) ?>
        <?php echo $form->error($booking, 'stat', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($booking, 'editions', ['class' => 'col-xs-4 control-label']); ?>
    <div class="col-xs-8">
        <?php echo $form->checkBoxList($booking, 'editions', NewsEdition::getOptionList()) ?>
        <?php echo $form->error($booking, 'editions', ['class' => 'help-block']); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <?php echo CHtml::submitButton('Submit', ['class' => 'btn btn-primary']); ?>
    </div>
</div>
</fieldset>
<?php $this->endWidget(); ?>
