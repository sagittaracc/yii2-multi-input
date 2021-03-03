# Yii2 Multi Input

This allows you to manipulate a field which consist of a bunch of values separated by a symbols.
In the example below we manipulate a list of addresses separated by semicolons.
There is a table in the database which stores stuff like this:

| id | address                                             |
|----|-----------------------------------------------------|
| 1  | Moscow, Street 43;Moscow, Street 1;Moscow, Street 2 |

![sagittaracc yii2 multi input](https://i.ibb.co/JtPRLzS/yii2-multi-input-01.png)

![sagittaracc yii2 multi input](https://i.ibb.co/pfNyPzL/yii2-multi-input-02.png)

![sagittaracc yii2 multi input](https://i.ibb.co/5Rg2MCg/yii2-multi-input-03.png)

```php

use yii\helpers\Html;
use sagittaracc\MultiInput\widgets\ActiveForm;
use sagittaracc\MultiInput\SplitInputAsset;

$this->title = 'Address';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-address">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'address')->textSplitInput(['separator' => ';']) ?>

    <div class="form-group">
        <?= Html::submitButton('Ok', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php SplitInputAsset::register($this); ?>
</div>

```
