<?php

namespace sagittaracc\MultiInput\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;

/**
 * Компонент разбиения строки на несколько полей
 * 
 * @author sagittaracc <sagittaracc@gmail.com>
 */
class SplitInput extends ActiveField
{
    /**
     * @var string имя класса конечных input'ов
     */
    public $className = 'sagittaracc-split-input';
    /**
     * @var sagittaracc\MultiInput\widgets\InputButton элемент кнопка "Добавить"
     */
    private $inputButton;
    /**
     * Разбивает на несколько input'ов
     * @param array $options настройки компонента
     * @return self
     */
    public function textSplitInput($options = [])
    {
        $options = array_merge($this->inputOptions, $options);
        $buttonOptions = isset($options['button']) ? $options['button'] : [];
        $this->inputButton = new InputButton($this, $buttonOptions);

        $this->parts['{input}'] =
            $this->splitToInputs($options) .
            $this->inputButton->render();

        return $this;
    }
    /**
     * Возвращает html с разбивкой на набор input'ов
     * @param array $options
     * @return string
     */
    private function splitToInputs($options)
    {
        $inputList = [];
        $separator = ArrayHelper::getValue($this->options, 'separator', ';');
        $valueList = $this->getValue($separator);
        $name = isset($options['name']) ? $options['name'] : "{$this->model->formName()}[{$this->attribute}][]";

        Html::addCssClass($options, $this->className);
        ArrayHelper::setValue($options, 'data-model', $this->attribute);

        foreach ($valueList as $value) {
            $inputList[] = Html::input('text', $name, $value, $options);
        }

        return implode('', $inputList);
    }
    /**
     * Получает список значений для набора input'ов
     * @param string $separator
     * @return array
     */
    private function getValue($separator)
    {
        return is_string($this->model->{$this->attribute}) || is_null($this->model->{$this->attribute})
            ? explode($separator, $this->model->{$this->attribute})
            : $this->model->{$this->attribute};
    }
}
