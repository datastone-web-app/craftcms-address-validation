<?php declare(strict_types=1);

namespace datastone\addressValidation;

use Craft;
use datastone\obfuscate\twigextensions\DatastoneObfuscateTwigExtension;
use datastone\obfuscate\services\DatastoneObfuscateService;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;
use craft\base\Model;
use craft\elements\User;
use craft\events\ModelEvent;

class AddressValidation extends \craft\base\Plugin
{
    public bool $hasCpSettings = true;

    public function init()
    {
        parent::init();

        // $this->setComponents([
        //     'obfuscate' => \datastone\obfuscate\services\DatastoneObfuscateService::class
        // ]);

        // Event::on(
        //     CraftVariable::class,
        //     CraftVariable::EVENT_INIT,
        //     function(Event $e) {
        //         /** @var CraftVariable $variable */
        //         $variable = $e->sender;
        //         $variable->set('obfuscate', DatastoneObfuscateService::class);
        //     }
        // );

        // if (Craft::$app->request->getIsSiteRequest()) {
        //     Craft::$app->view->registerTwigExtension(new DatastoneObfuscateTwigExtension());
        // }
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