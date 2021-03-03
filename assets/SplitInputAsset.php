<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sagittaracc\assets;

use yii\web\AssetBundle;

class SplitInputAsset extends AssetBundle
{
  public $sourcePath = '@vendor/sagittaracc/yii-multi-input/assets';
  public $css = [
  ];
  public $js = [
    'js/split-input.js',
  ];
  public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap\BootstrapAsset',
  ];
}
