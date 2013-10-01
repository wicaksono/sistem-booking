<?php
class ButtonColumn extends CButtonColumn
{
    /**
     * @var array the HTML options for the data cell tags.
     */
    public $htmlOptions=array('class'=>'button-column');
    /**
     * @var array the HTML options for the header cell tag.
     */
    public $headerHtmlOptions=array('class'=>'button-column');
    /**
     * @var array the HTML options for the footer cell tag.
     */
    public $footerHtmlOptions=array('class'=>'button-column');
    /**
     * @var string the label for the view button. Defaults to "View".
     * Note that the label will not be HTML-encoded when rendering.
     */
    public $viewButtonLabel = 'Detail';
    /**
     * @var string the image URL for the view button. If not set, an integrated image will be used.
     * You may set this property to be false to render a text link instead.
     */
    public $viewButtonImageUrl;
    /**
     * @var string a PHP expression that is evaluated for every view button and whose result is used
     * as the URL for the view button. In this expression, the variable
     * <code>$row</code> the row number (zero-based); <code>$data</code> the data model for the row;
     * and <code>$this</code> the column object.
     */
    public $viewButtonUrl='Yii::app()->controller->createUrl("detail",array("id"=>$data->primaryKey))';
    /**
     * @var array the HTML options for the view button tag.
     */
    public $viewButtonOptions=array('class'=>'detail');

    /**
     * @var string the label for the update button. Defaults to "Update".
     * Note that the label will not be HTML-encoded when rendering.
     */
    public $updateButtonLabel;
    /**
     * @var string the image URL for the update button. If not set, an integrated image will be used.
     * You may set this property to be false to render a text link instead.
     */
    public $updateButtonImageUrl;
    /**
     * @var string a PHP expression that is evaluated for every update button and whose result is used
     * as the URL for the update button. In this expression, the variable
     * <code>$row</code> the row number (zero-based); <code>$data</code> the data model for the row;
     * and <code>$this</code> the column object.
     */
    public $updateButtonUrl='Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))';
    /**
     * @var array the HTML options for the update button tag.
     */
    public $updateButtonOptions=array('class'=>'update');

    /**
     * @var string the label for the delete button. Defaults to "Delete".
     * Note that the label will not be HTML-encoded when rendering.
     */
    public $deleteButtonLabel = 'Delete';
    /**
     * @var string the image URL for the delete button. If not set, an integrated image will be used.
     * You may set this property to be false to render a text link instead.
     */
    public $deleteButtonImageUrl;
    /**
     * @var string a PHP expression that is evaluated for every delete button and whose result is used
     * as the URL for the delete button. In this expression, the variable
     * <code>$row</code> the row number (zero-based); <code>$data</code> the data model for the row;
     * and <code>$this</code> the column object.
     */
    public $deleteButtonUrl='Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))';
    /**
     * @var array the HTML options for the view button tag.
     */
    public $deleteButtonOptions=array('class'=>'delete');
}