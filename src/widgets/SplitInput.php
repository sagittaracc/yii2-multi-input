<?php

namespace sagittaracc\MultiInput\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;
use yii\web\View;

class SplitInput extends ActiveField {
  private $id;
  private $separator;

  public function textSplitInput($options = [])
  {
    $separatorByDefault = ';';
    $this->separator = ArrayHelper::getValue($options, 'separator', $separatorByDefault);
    $options = array_merge($this->inputOptions, $options);

    $this->id = array_key_exists('id', $options) ? $options['id'] : Html::getInputId($this->model, $this->attribute);
    $this->form->getView()->registerJs('var separator = "'. $this->separator .'"', View::POS_HEAD);
    $this->parts['{input}'] = Html::activeHiddenInput($this->model, $this->attribute, $options)
                            . $this->splitToInputs($options)
                            . $this->addAnotherInputButton();

    return $this;
  }

  private function splitToInputs($options) {
    $inputList = [];
    $valueList = explode($this->separator, $this->model->{$this->attribute});
    $options['class'] .= ' sagittaracc-split-input';

    foreach ($valueList as $value) {
      $inputList[] = Html::beginTag("p")
                   . Html::input('text', null, $value, $options)
                   . Html::endTag("p");
    }

    return implode('', $inputList);
  }

  private function addAnotherInputButton() {
    return Html::button("Add", [
      'class' => 'btn',
      'onclick' => "(function(self){
        var input = $(self).prev().clone();
        input.find('input').val('');
        input.insertBefore($(self));
      })(this);"
    ]);
  }
}
