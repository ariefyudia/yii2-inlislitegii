<?php
/**
 * @link https://github.com/inlislite-ext/yii2-inlislitegii
 * @copyright Copyright (c) 2015 Perpustakaan Nasional Republik Indonesia
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace inlislite\gii;

use yii\base\Application;
use yii\base\BootstrapInterface;


/**
 * Class Bootstrap
 * @package inlislite\gii
 * @author Henry <alvin_vna@yahoo.com>
 */
class Bootstrap implements BootstrapInterface
{

    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if ($app->hasModule('gii')) {

            if (!isset($app->getModule('gii')->generators['inlislite-model'])) {
                $app->getModule('gii')->generators['inlislite-model'] = 'inlislite\gii\model\Generator';
            }
            if (!isset($app->getModule('gii')->generators['inlislite-crud'])) {
                $app->getModule('gii')->generators['inlislite-crud'] = 'inlislite\gii\crud\Generator';
            }
           
        }
    }
}