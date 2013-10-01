<?php
/**
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
?>

<div class="row"><div class="col-xs-12">
<?php $this->widget('GridView', [
    'id' => 'comm-booking-manage-grid',
    'dataProvider' => $dateset->manage(),
    'filter' => $dateset,
    'afterAjaxUpdate' => '_afterAjaxUpdate',
    'template' => '{items} {pager}',
    'columns' => [
        [
            'name' => 'ua_username',
            'value' => '$data->ua->username',
            'header' => 'PIC'
        ],
        [
            'name' => 'date',
            'value' => '$data->date'
        ],
        [
            'name' => 'type',
            'value' => 'CommPlacing::getTypeName($data->type)',
            'filter' => CommPlacing::getTypeList()
        ],
        [
            'class' => 'ButtonColumn',
            'template' => '{update} {delete}'
        ]
    ]
]); ?>
</div></div>
