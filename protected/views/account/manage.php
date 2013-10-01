<?php
/**
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
?>

<div class="row"><div class="col-xs-12">
<?php $this->widget('GridView', [
    'id' => 'user-account-manage-grid',
    'dataProvider' => $account->manage(),
    'filter' => $account,
    'afterAjaxUpdate' => '_afterAjaxUpdate',
    'template' => '{items} {pager}',
    'columns' => [
        [
            'name' => 'username',
        ],
        [
            'name' => 'identity',
        ],
        [
            'name' => 'division',
            'value' => 'UserAccount::getDivisionName($data->division)',
            'filter' => UserAccount::getDivisionList()
        ],
        [
            'name' => 'realname',
        ],
        [
            'class' => 'ButtonColumn',
            'template' => '{update} {delete}'
        ]
    ]
]); ?>
</div></div>
