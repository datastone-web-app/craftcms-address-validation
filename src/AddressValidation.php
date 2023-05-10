<?php declare(strict_types=1);

namespace datastone\addressValidation;
use yii\base\Event;

use craft\base\Model;
use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;
use Yii;

class AddressValidation extends \craft\base\Plugin
{
    public bool $hasCpSettings = true;

    public function init()
    {
        parent::init();

        $this->setComponents([
            'postcodeEuClient' => \datastone\addressValidation\services\PostcodeEuService::class
        ]);

        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_SITE_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules = array_merge(include(__DIR__ . '/routes.php'), $event->rules);            
            }
        );
    }

    protected function createSettingsModel(): ?Model
    {
        return new \datastone\addressValidation\models\Settings();
    }

    protected function settingsHtml(): ?string
    {
        return \Craft::$app->getView()->renderTemplate(
            'address-validation/settings',
            [ 'settings' => $this->getSettings() ]
        );
    }
}