<?php
/**
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
?>

<?php Yii::app()->getClientScript()->registerScript('comm-booking-load', '
//$("#comm-booking-create-page").load("'. $this->createUrl('booking/create') .'");
//$("#comm-booking-request-create-page").load("'. $this->createUrl('request/create') .'");

$(document).on("click", "#comm-booking-request-manage-grid table.items .update-request", function() {
    $("#comm-booking-request-create-page").load($(this).attr("href"));
    return false;
});
'); ?>

<div class="row">
    <div id="comm-booking-create-page" class="col-sm-6"></div>
    <div id="comm-booking-request-create-page" class="col-sm-6"></div>
</div>

<div class="row"><div class="col-xs-12">
<?php $this->widget('GridView', [
    'id' => 'comm-booking-request-manage-grid',
    'dataProvider' => $request->browse(),
    'filter' => $request,
    'afterAjaxUpdate' => '_afterAjaxUpdate',
    'template' => '{items} {pager}',
    'columns' => [
        [
            'name' => 'cb_id',
            'type' => 'raw',
            'value' => 'CHtml::link($data->cb_id, ["booking/update", "id" => $data->cb_id], ["class" => "update-booking"])'
        ],
        [
            'name' => 'cb_name',
            'value' => '$data->cb->name'
        ],
        [
            'name' => 'ns_name',
            'value' => '$data->ns->name'
        ],
        [
            'name' => 'page'
        ],
        [
            'name' => 'sa_username',
            'value' => '$data->cb->sa->realname'
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
            'filter' => $this->widget('CMaskedTextField', array(
                'model' => $request,
                'attribute' => 'publish_at',
                'mask' => '9999-99-99',
                'htmlOptions' => [
                    'class' => 'form-control'
                ]
            ), true)
        ],
        [
            'name' => 'ua_username',
            'value' => '$data->ua->username'
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
