<?php

/**
 * Class ActiveForm
 *
 * @author Niko Wicaksono <wicaksono@nodews.com>
 */
class ActiveForm extends CActiveForm {
    public function init() {
        $this->clientOptions = array_merge($this->clientOptions, [
            'inputContainer' => '.form-group',
            'errorCssClass' => 'has-error',
            'successCssClass' => 'has-success',
        ]);
        parent::init();
    }
}
