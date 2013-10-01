<?php
/**
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
?>

<?php Yii::app()->getClientScript()->registerScript('comm-booking-placing-load', '
$(document).on("click", "#comm-placing-browse-grid table.items .btn-report", function() {
    $("#comm-booking-placing-form").load($(this).attr("href"));
    return false;
});
'); ?>

<div class="row">
    <div id="comm-booking-placing-form" class="col-sm-12"></div>
</div>

<div class="row"><div class="col-xs-12">
<?php $this->widget('GridView', [
    'id' => 'comm-placing-browse-grid',
    'dataProvider' => $placing->browse(),
    'filter' => $placing,
    'afterAjaxUpdate' => '_afterAjaxUpdate',
    'template' => '{items} {pager}',
    'columns' => [
        [
            'name' => 'cb_id',
        ],
        [
            'name' => 'cb_name',
            'value' => '$data->cb->name'
        ],
        [
            'name' => 'cb_username',
            'value' => '$data->cb->ua->username'
        ],
        [
            'name' => 'ne_id',
            'value' => '$data->ne->name',
            'filter' => NewsEdition::getOptionList()
        ],
        [
            'name' => 'br_id',
        ],
        [
            'name' => 'br_page',
            'value' => '$data->br->page'
        ],
        [
            'name' => 'br_sizex',
            'value' => '$data->br->sizex'
        ],
        [
            'name' => 'br_sizey',
            'value' => '$data->br->sizey'
        ],
        [
            'name' => 'br_stat',
            'value' => 'CommBookingRequest::getStatName($data->br->stat)',
            'filter' => CommBookingRequest::getStatList()
        ],
        [
            'name' => 'br_publish_at',
            'value' => '$data->br->publish_at'
        ],
        [
            'name' => 'bp_id',
            'value' => 'is_null($data->bp_id) ? "NULL" : $data->bp->id'
        ],
        [
            'name' => 'bp_page',
            'value' => 'is_null($data->bp_id) ? "NULL" : $data->bp->page'
        ],
        [
            'name' => 'bp_posx',
            'value' => 'is_null($data->bp_id) ? "NULL" : sprintf("%02x", $data->bp->posx)'
        ],
        [
            'name' => 'bp_posy',
            'value' => 'is_null($data->bp_id) ? "NULL" : sprintf("%02x", $data->bp->posy)'
        ],
        [
            'class' => 'ButtonColumn',
            'template' => '{create} {update}',
            'buttons' => array(
                'create' => array(
                    'url' => 'Yii::app()->createUrl(\'placing/create\', array(\'ne_id\' => $data->ne_id, \'br_id\' => $data->br_id))',
                    'imageUrl' => Yii::app()->baseUrl . '/assets/static/images/icons/add.png',
                    'visible' => '$data->bp_id === null',
                    'options' => ['class' => 'btn-report']
                ),
                'update' => array(
                    'url' => 'Yii::app()->createUrl(\'placing/update\', array(\'ne_id\' => $data->ne_id, \'br_id\' => $data->br_id))',
                    'visible' => '$data->bp_id !== null',
                    'options' => ['class' => 'btn-report']
                )
            )
        ]
    ]
]); ?>
</div></div>
