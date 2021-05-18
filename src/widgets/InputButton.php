<?php

namespace sagittaracc\MultiInput\widgets;

use yii\helpers\Html;

class InputButton
{
    private $model;

    private $options;

    function __construct($model, $options = [])
    {
        $this->model = $model;
        $this->options = $options;
    }

    public function render()
    {
        $id = isset($this->options['id']) ? $this->options['id'] : $this->getId();
        $visibility = isset($this->options['visibility']) ? $this->options['visibility'] : 'visible';

        return Html::button(\Yii::t("app", "Add"), [
            'id' => $id,
            'style' => "visibility: $visibility;",
            'class' => 'btn',
            'onclick' => "(function(self){
                var input = $(self).prev().clone();
                input.val('');
                input.insertBefore($(self));
                $(document).trigger('" . $this->model->className . ":add', input);
            })(this);"
        ]);
    }

    private function getId()
    {
        return "{$this->model->attribute}-add-button";
    }
}