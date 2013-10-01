<?php

Yii::import('zii.widgets.grid.CGridView');

/**
 * Class GridView
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class GridView extends CGridView {
    public $htmlOptions = array(
        'class' => 'grid-view table-responsive'
    );
    public $itemsCssClass = 'table table-striped table-condensed table-hover';
    public $pagerCssClass = 'pagination';

    public $pager = array(
        'hiddenPageCssClass' => 'disabled',
        'header' => ''
    );
}
