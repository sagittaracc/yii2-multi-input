<?php

namespace sagittaracc\MultiInput\components;

use yii\validators\Validator;

/**
 * Валидор поля
 * 
 * @author sagittaracc <sagittaracc@gmail.com>
 */
class SplitInputValidator extends Validator
{
    /**
     * Валидирует заданное поле $attribute модели $model
     * Полю модели разрешено быть либо массивом либо строкой
     */
    public function validateAttribute($model, $attribute)
    {
        if (!is_string($model->$attribute) && !is_array($model->$attribute))
            $this->addError($model, $attribute, "$attribute must be a string or an array.");
    }
}
