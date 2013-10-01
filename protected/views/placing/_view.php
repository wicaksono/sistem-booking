<?php Yii::app()->getClientScript()->registerScript('comm-request-view', '
    $(document).on("click", "#comm-placing-form a.render", function() {
        posx = $("#CommBookingPlacing_posx").val();
        posy = $("#CommBookingPlacing_posy").val();

        jQuery.ajax({
            url: "'. $this->createUrl('placing/getter') .'",
            type: "POST",
            data: $("#comm-placing-form").serialize(),
            success: function(data, textStatus, jqXHR) {
                $("#comm-booking-placing-render-view").attr("src", data);
            }
        });
        return false;
    });
'); ?>
