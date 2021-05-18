<?php

namespace sagittaracc\MultiInput\widgets;

use yii\helpers\Html;

/**
 * Элемент кнопка "Добавить" в компоненте разбивки на input'ы
 * 
 * @author sagittaracc <sagittaracc@gmail.com>
 */
class InputButton
{
    /**
     * @var sagittaracc\MultiInput\widgets\SplitInput ссылка на компонент
     */
    private $model;
    /**
     * @var array настройки кнопки
     */
    private $options;
    /**
     * Constructor
     * @param sagittaracc\MultiInput\widgets\SplitInput $model
     * @param array $options
     */
    function __construct($model, $options = [])
    {
        $this->model = $model;
        $this->options = $options;
    }
    /**
     * Отображение кнопки
     * @return string
     */
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
    /**
     * Генерирует id для кнопки
     * @return string
     */
    private function getId()
    {
        return "{$this->model->attribute}-add-button";
    }
}