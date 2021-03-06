<?php

namespace App;

class Member {

    protected const MEMBERS_CREATE_REQUIRED_FIELDS = [
        'voornaam',
        'achternaam',
        'geslacht',
        'geboortedatum',
        'straatnaam',
        'huisnummer',
        'postcode',
        'plaats',
        'email',
        'telefoonnummer',
        'bondssporten',
        'iban',
        'opmerkingen',
        'captcha',
        'captchaimagestring',
    ];

    public function getMembersCreateRequiredFields(): array
    {
        return static::MEMBERS_CREATE_REQUIRED_FIELDS;
    }

}
