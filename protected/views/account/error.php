<?php
$this->pageTitle = 'Oops';
?>

<div class="row panel panel-default">
    <div class="panel-body">
        <?php echo CHtml::image(Yii::app()->baseUrl . '/assets/static/images/error404.jpg', 'Error 404', array('class' => 'col-xs-4 thumbnail', 'style' => 'margin-bottom: 0;')); ?>
        <div class="col-xs-8">
            <h3>Don't get angry and don't cry</h3>
            <p>
                <strong>Let us take that burden.</strong> It's not your fault. No, really,
                listen to me. It's not your fault. We have 24 hours hotline to deal with
                things just like this. Okay, it's not really a hot line, it's really just
                some encouraging words to keep trying, but hotline sounds so much cooler.
            </p>
            <h3>The very nerdy error</h3>
            <p>
                <strong>Error <?php echo $code; ?></strong>
                <?php echo CHtml::encode($message); ?>
            </p>

            <div>
                <?php $this->widget('zii.widgets.jui.CJuiButton', array(
                    'name' => 'history_back',
                    'buttonType' => 'button',
                    'caption' => 'Back',
                    'onclick' => 'js:function(){window.history.back();}',
                    'options' => array(
                        'icons' => array(
                            'primary' => 'ui-icon-arrowthick-1-w'
                        )
                    ),
                )); ?>
            </div>
        </div>
    </div>
</div>
