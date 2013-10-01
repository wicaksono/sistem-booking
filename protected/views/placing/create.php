<?php $this->renderPartial('_view', ['placing' => $placing]); ?>
<div class="row">
    <div class="col-sm-6">
        <?php $this->renderPartial('_form', ['placing' => $placing]); ?>
    </div>
    <div class="col-sm-6" style="text-align: center;">
        <img id="comm-booking-placing-render-view" style="width: 140px;" />
    </div>
</div>
