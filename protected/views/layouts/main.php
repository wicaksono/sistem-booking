<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/css/chosen.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/fonts/ubuntu.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/css/jquery-ui.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/css/select2.css" rel="stylesheet" type="text/css">
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/js/jquery.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/js/jquery-ui.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/js/jquery.chosen.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/js/jquery.select2.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/js/jquery.ajax-chosen.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/js/hogan.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/js/bootstrap.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/js/typeahead.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/js/yii/gridview.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/static/js/yii/activeform.js"></script>
        <?php Yii::app()->getClientScript()->registerCoreScript('bbq'); ?>
        <?php Yii::app()->getClientScript()->registerCoreScript('yiiactiveform'); ?>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php Yii::app()->getClientScript()->registerScript('init', '
            jQuery(function($) {
                $.datepicker.setDefaults({
                    dateFormat: "yy-mm-dd",
                    defaultDate: "0000-00-00",
                    showOn: "focus",
                    showButtonPanel: true,
                    changeMonth: true,
                    changeYear: true,
                    buttonImageOnly: true,
                    showButtonPanel: false
                });
            });
            function _afterAjaxUpdate(id, data) {
                $(".datepicker").datepicker();
            };
        ', CClientScript::POS_END); ?>
        <style>
            body {
                font-family: 'Ubuntu Condensed';
                font-weight: 400;
            }
            .filters input,
            .filters select {
                display: block;
                width: 100%;
                height: 24px;
                padding: 0 2px;
                font-size: 12px;
                line-height: 1.428571429;
                color: #555555;
                vertical-align: middle;
                background-color: #ffffff;
                background-image: none;
                border: 1px solid #cccccc;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
                transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
            }
            .form-control {
                border-radius: 0;
            }
            .grid-view tbody tr td,
            .grid-view thead tr th {
                text-align: center;
            }
            .grid-view table.items th,
            .grid-view .button-column {
                white-space: nowrap;
            }
            .partiture-image {
                list-style: none;
            }
            .partiture-image li {
                float: left;
                margin: 10px;
            }

            .placing-pagination {
                list-style: none;
            }
            .placing-pagination li {
                float: left;
                margin-left: 10px;
            }

            .tt-hint {
                color: #fff
            }

            .tt-dropdown-menu {
                width: 422px;
                margin-top: 12px;
                padding: 8px 0;
                background-color: #fff;
                border: 1px solid #ccc;
                border: 1px solid rgba(0, 0, 0, 0.2);
                -webkit-border-radius: 8px;
                -moz-border-radius: 8px;
                border-radius: 8px;
                -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                box-shadow: 0 5px 10px rgba(0,0,0,.2);
            }

            .tt-suggestion {
                padding: 3px 20px;
            }

            .tt-suggestion.tt-is-under-cursor {
                color: #fff;
                background-color: #0097cf;

            }

            .tt-suggestion p {
                margin: 0;
            }
        </style>
    </head>
<body>
    <div class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="javascript:;"><?php echo Yii::app()->name; ?></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if(Yii::app()->user->isGuest): ?>
                    <?php else: ?>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Booking <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><?php echo CHtml::link('Create', ['booking/create']); ?></li>
                            <li><?php echo CHtml::link('Manage', ['booking/manage']); ?></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Request</li>
                            <li><?php echo CHtml::link('Browse', ['request/browse']); ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Partitur <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><?php echo CHtml::link('Create', ['placing/browse']); ?></li>
                            <li><?php echo CHtml::link('Report', ['placing/report']); ?></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Dateset</li>
                            <li><?php echo CHtml::link('Create', ['dateset/create']); ?></li>
                            <li><?php echo CHtml::link('Manage', ['dateset/manage']); ?></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Resource</li>
                            <li><?php echo CHtml::link('Coordinate', Yii::app()->request->baseUrl . '/pageset.pdf'); ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><?php echo CHtml::link('Create', ['account/create']); ?></li>
                            <li><?php echo CHtml::link('Manage', ['account/manage']); ?></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(Yii::app()->user->isGuest): ?>
                    <li><?php echo CHtml::link('Login', ['account/login']); ?></li>
                    <?php else: ?>
                    <li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::app()->user->account->username; ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><?php echo CHtml::link('Logout', ['account/logout']); ?></li>
                                <li class="divider"></li>
                                <li class="dropdown-header">Setting</li>
                                <li><?php echo CHtml::link('Change Password', ['dateset/create']); ?></li>
                            </ul>
                        </li>
                    </li>
                    <?php endif; ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1><?php echo CHtml::encode($this->pageTitle); ?></h1>
            </div>
        </div>
        <?php echo $content; ?>
    </div>

</body>
</html>