<?php

namespace sagittaracc\MultiInput\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;

class SplitInput extends ActiveField
{
    private $className = 'sagittaracc-split-input';

    private $options;

    private $inputButton;

    public function textSplitInput($options = [])
    {
        $this->options = array_merge($this->inputOptions, $options);
        $buttonOptions = isset($options['button']) ? $options['button'] : [];

        $this->inputButton = new InputButton($this, $buttonOptions);

        $this->parts['{input}'] =
            $this->splitToInputs() .
            $this->inputButton->render();

        return $this;
    }

    private function splitToInputs()
    {
        $inputList = [];
        $valueList = $this->getValue();
        $name = isset($this->options['name']) ? $this->options['name'] : "{$this->model->formName()}[{$this->attribute}][]";

        Html::addCssClass($this->options, $this->className);
        ArrayHelper::setValue($this->options, 'data-model', $this->attribute);

        foreach ($valueList as $value) {
            $inputList[] = Html::input('text', $name, $value, $this->options);
        }

        return implode('', $inputList);
    }

    private function getValue()
    {
        $separatorByDefault = ';';
        $separator = ArrayHelper::getValue($this->options, 'separator', $separatorByDefault);

        return is_string($this->model->{$this->attribute}) || is_null($this->model->{$this->attribute})
            ? explode($separator, $this->model->{$this->attribute})
            : $this->model->{$this->attribute};
    }
}
