<?php

namespace sagittaracc\MultiInput\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveField;
use yii\web\View;

class SplitInput extends ActiveField {
  private $id;
  private static $className = 'sagittaracc-split-input';
  private $separator;

  public function textSplitInput($options = [])
  {
    $separatorByDefault = ';';
    $this->separator = ArrayHelper::getValue($options, 'separator', $separatorByDefault);
    $options = array_merge($this->inputOptions, $options);

    $this->id = array_key_exists('id', $options) ? $options['id'] : Html::getInputId($this->model, $this->attribute);
    $this->form->getView()->registerJs('if (typeof separator === "undefined") separator = {}', View::POS_HEAD);
    $this->form->getView()->registerJs('separator["' . $this->id . '"] = "'. $this->separator .'"', View::POS_HEAD);
    $this->parts['{input}'] = $this->splitToInputs($options)
                            . $this->addAnotherInputButton();

    return $this;
  }

  private function splitToInputs($options) {
    $inputList = [];
    $valueList = explode($this->separator, $this->model->{$this->attribute});
    Html::addCssClass($options, self::$className);

    foreach ($valueList as $value) {
      $inputList[] = Html::activeTextInput($this->model, $this->attribute, array_merge($options, ['value' => $value]));
    }

    return implode('', $inputList);
  }

  private function addAnotherInputButton() {
    return Html::button(\Yii::t("app", "Add"), [
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
