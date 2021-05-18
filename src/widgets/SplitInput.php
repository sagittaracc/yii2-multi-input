<?php

namespace sagittaracc\MultiInput\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;
use yii\web\View;

class SplitInput extends ActiveField {
  private static $className = 'sagittaracc-split-input';

  public function textSplitInput($options = [])
  {
    $options = array_merge($this->inputOptions, $options);

    $this->parts['{input}'] = $this->splitToInputs($options)
                            . $this->addAnotherInputButton($options);

    return $this;
  }

  private function splitToInputs($options) {
    $separatorByDefault = ';';
    $separator = ArrayHelper::getValue($options, 'separator', $separatorByDefault);

    $inputList = [];
    $valueList = is_string($this->model->{$this->attribute})
              || is_null($this->model->{$this->attribute})
                  ? explode($separator, $this->model->{$this->attribute})
                  : $this->model->{$this->attribute};
    Html::addCssClass($options, self::$className);
    $options['data-model'] = $this->attribute;
    $name = isset($options['name']) ? $options['name'] : "{$this->model->formName()}[{$this->attribute}][]";

    foreach ($valueList as $value) {
      $inputList[] = Html::input('text', $name, $value, $options);
    }

    return implode('', $inputList);
  }

  private function addAnotherInputButton($options) {
    $id = isset($options['id']) ? $options['id'] : "{$this->attribute}-add-button";
    $visibility = isset($options['button']) && $options['button'] === 'hidden' ? 'hidden' : 'visible';

    return Html::button(\Yii::t("app", "Add"), [
      'id' => $id,
      'style' => "visibility: $visibility;",
      'class' => 'btn',
      'onclick' => "(function(self){
        var input = $(self).prev().clone();
        input.val('');
        input.insertBefore($(self));
        $(document).trigger('".self::$className.":add', input);
      })(this);"
    ]);
  }
}
