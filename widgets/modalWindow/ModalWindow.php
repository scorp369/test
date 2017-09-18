<?php

namespace app\widgets\modalWindow;

use app\widgets\ModuleWidget;

/**
 * виджет модального окна
 */
class ModalWindow extends ModuleWidget
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerWidgetAssets(['modalWindow.js']);

        $this->renderBodyEnd();
    }

    /**
     * отобразить начало модального окна
     *
     * @param $caption - заголовок модального окна
     *
     * @return string
     */
    public static function renderBodyBegin($caption)
    {
        return '
        <div class="row js-modal-window-wrapper">
                 <div class="col-xs-12 col-md-push-1 col-md-10 modal-window panel panel-default">
                     <div class="row panel-heading">
                            <p class="caption"> ' . $caption . '</p>
                      </div>
                      <div class="row panel-body">';
    }

    /**
     * отобразить конец модального окна
     *
     * @return string
     */
    public static function renderBodyEnd()
    {
        return
            '</div>
            </div>
            </div>';
    }
}
