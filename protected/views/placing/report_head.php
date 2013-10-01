<?php Yii::app()->getClientScript()->registerScript('comm-booking-placing-report-date', '
    $(function() {
        $("#comm-booking-placing-report-date").datepicker({
            numberOfMonths: 3,
            changeMonth: false,
            changeYear: false,
            onSelect: function(value, date) {
                $.ajax({
                    url: "'. $this->createUrl('placing/report') .'",
                    type: "POST",
                    data: {date: value},
                    success: function(data, textStatus, jqXHR) {
                        $(location).attr("href", data);
                    }
                });
            }
        });
    });
'); ?>

<div class="row">
    <div class="span-12" style="text-align: center">
        <div id="comm-booking-placing-report-date" style="display: inline-block;"></div>
    </div>
</div>

<div id="comm-booking-placing-report-view"></div>
