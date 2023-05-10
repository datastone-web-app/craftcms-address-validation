<?php declare(strict_types=1);

namespace datastone\addressValidation\models;

use craft\base\Model;

class Settings extends Model
{
    public $apiKey = null;
    public $apiSecret = null;
    public $apiUrl = null;

    public function rules(): array
    {
        return [
            [['apiKey', 'apiSecret', 'apiUrl'], 'required'],
        ];
    }
}