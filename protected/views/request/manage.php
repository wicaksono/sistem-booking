<?php
/**
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
?>

<?php
Yii::app()->getClientScript()->registerScript('comm-booking-request-manage-page', '
    function _afterAjaxUpdate(id, data) {
        $("#CommBookingRequest_publish_at_browse").datepicker();
    };
');
?>

<div class="row"><div class="col-xs-12">
<?php $this->widget('GridView', [
    'id' => 'comm-booking-request-manage-grid',
    'dataProvider' => $request->manage(),
    'filter' => $request,
    'afterAjaxUpdate' => '_afterAjaxUpdate',
    'template' => '{items} {pager}',
    'columns' => [
        [
            'name' => 'ua_username',
            'value' => '$data->ua->username'
        ],
        [
            'name' => 'ns_name',
            'value' => '$data->ns->name'
        ],
        [
            'name' => 'page'
        ],
        [
            'name' => 'sizex'
        ],
        [
            'name' => 'sizey'
        ],
        [
            'name' => 'color',
            'value' => 'CommBookingRequest::getColorName($data->color)',
            'filter' => CommBookingRequest::getColorList()
        ],
        [
            'name' => 'publish_at',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $request,
                'attribute' => 'publish_at',
                'htmlOptions' => array(
                    'id' => 'CommBookingRequest_publish_at_browse',
                ),
            ), TRUE)
        ],
        [
            'type' => 'raw',
            'name' => 'stat',
            'value' => 'CommBookingRequest::getStatHtml($data->stat)',
            'filter' => CommBookingRequest::getStatList()
        ],
        [
            'class' => 'ButtonColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => [
                    'visible' => '$data->stat != CommBookingRequest::STAT_DONE'
                ],
                'delete' => [
                    'visible' => '$data->stat != CommBookingRequest::STAT_DONE'
                ]
            ]
        ]
    ]
]); ?>
</div></div>
