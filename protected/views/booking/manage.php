<?php
/**
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
?>

<?php
Yii::app()->getClientScript()->registerScript('comm-booking-request-manage-page', '
    function _afterAjaxUpdate(id, data) {
        //$("#CommBookingRequest_publish_at_browse").datepicker();
    };
');
?>

<div class="row"><div class="col-xs-12">
<?php $this->widget('GridView', [
    'id' => 'comm-booking-manage-grid',
    'dataProvider' => $booking->manage(),
    'filter' => $booking,
    'afterAjaxUpdate' => '_afterAjaxUpdate',
    'template' => '{items} {pager}',
    'columns' => [
        [
            'name' => 'id',
            'value' => '$data->id'
        ],
        [
            'name' => 'ua_username',
            'value' => '$data->ua->username',
            'header' => 'PIC'
        ],
        [
            'name' => 'name',
            'value' => '$data->name'
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
                    'visible' => '$data->stat != CommBooking::STAT_DONE'
                ],
                'delete' => [
                    'visible' => '$data->stat != CommBooking::STAT_DONE'
                ]
            ]
        ]
    ]
]); ?>
</div></div>
