<?php

use junkman\components\skills\SkillRest;
use junkman\components\skills\SkillSearch;
use junkman\components\skills\Skill;
use extas\interfaces\samples\parameters\ISampleParameter;

return [
    new Skill([
        Skill::FIELD__NAME => 'rest',
        Skill::FIELD__TITLE => 'Отдых',
        Skill::FIELD__DESCRIPTION => 'Восстанавливает Х здоровья, где Х - текущий размер регенерации',
        Skill::FIELD__DEFINITION => '',
        Skill::FIELD__FREQUENCY => [],
        Skill::FIELD__CLASS => SkillRest::class,
        Skill::FIELD__PARAMETERS => [
            SkillRest::FIELD__DEFAULT_REGENERATION => [
                ISampleParameter::FIELD__NAME => SkillRest::FIELD__DEFAULT_REGENERATION,
                ISampleParameter::FIELD__VALUE => 1
            ]
        ]
    ]),
    new Skill([
        Skill::FIELD__NAME => 'search',
        Skill::FIELD__TITLE => 'Поиск',
        Skill::FIELD__DESCRIPTION => 'Позволяет порыться в мусоре и попробовать найти хоть что-нибудь',
        Skill::FIELD__DEFINITION => '',
        Skill::FIELD__FREQUENCY => [],
        Skill::FIELD__CLASS => SkillSearch::class,
        Skill::FIELD__PARAMETERS => [
            SkillRest::FIELD__DEFAULT_REGENERATION => [
                ISampleParameter::FIELD__NAME => SkillRest::FIELD__DEFAULT_REGENERATION,
                ISampleParameter::FIELD__VALUE => 1
            ]
        ]
    ])
];
