<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace sagittaracc\MultiInput;

use yii\web\AssetBundle;
use Yii;

class SplitInputAsset extends AssetBundle
{
  public $sourcePath = '@yii2-multi-input';

  public $css = [
    'css/split-input.css',
  ];

  public $js = [
    'js/split-input.js',
  ];

  public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap\BootstrapAsset',
  ];

  public function init() {
    Yii::setAlias('@yii2-multi-input', __DIR__ . '/assets/');
    parent::init();
  }
}
