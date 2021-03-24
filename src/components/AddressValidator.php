<?php

namespace sagittaracc\MultiInput\components;

use yii\validators\Validator;

class AddressValidator extends Validator
{
  public function validateAttribute($model, $attribute)
  {
    if (!is_string($model->$attribute) && !is_array($model->$attribute))
      $this->addError($model, $attribute, "$attribute must be a string or an array.");
  }
}
