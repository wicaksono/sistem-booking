<?php Yii::app()->getClientScript()->registerScript('comm-booking-request-load', '
$("#comm-booking-request-manage-page").load("'. $this->createUrl('request/manage', ['id' => $booking->id]) .'");
$("#comm-booking-request-create-page").load("'. $this->createUrl('request/create', ['id' => $booking->id]) .'");

$(document).on("click", "#comm-booking-request-manage-grid .table .update", function() {
    $("#comm-booking-request-create-page").load($(this).attr("href"));
    return false;
});
'); ?>

<div class="row">
    <div class="col-sm-6">
        <?php $this->renderPartial('_form', ['booking' => $booking, 'create' => false]); ?>
    </div>
    <div id="comm-booking-request-create-page" class="col-sm-6"></div>
</div>

<div class="row">
    <div id="comm-booking-request-manage-page" class="col-lg-12"></div>
</div>
