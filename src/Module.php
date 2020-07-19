<?php
namespace MonthlyBasis\ContentModeration;

use LeoGalleguillos\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use MonthlyBasis\ContentModeration\View\Helper as ContentModerationHelper;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                    'containsBadWords'                   => ContentModerationHelper\ContainsBadWords::class,
                    'escapeAndReplaceBadWords'           => ContentModerationHelper\EscapeAndReplaceBadWords::class,
                    'stripTagsReplaceBadWordsAndShorten' => ContentModerationHelper\StripTagsReplaceBadWordsAndShorten::class,
                ],
                'factories' => [
                    ContentModerationHelper\ContainsBadWords::class => function ($sm) {
                        return new ContentModerationHelper\ContainsBadWords(
                            $sm->get(ContentModerationService\ContainsBadWords::class)
                        );
                    },
                    ContentModerationHelper\EscapeAndReplaceBadWords::class => function ($sm) {
                        return new ContentModerationHelper\EscapeAndReplaceBadWords(
                            $sm->get(StringService\Escape::class),
                            $sm->get(ContentModerationService\ReplaceBadWords::class)
                        );
                    },
                    ContentModerationHelper\StripTagsReplaceBadWordsAndShorten::class => function ($sm) {
                        return new ContentModerationHelper\StripTagsReplaceBadWordsAndShorten(
                            $sm->get(ContentModerationService\StripTagsReplaceBadWordsAndShorten::class)
                        );
                    },
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                ContentModerationService\ContainsBadWords::class => function ($sm) {
                    return new ContentModerationService\ContainsBadWords(
                        $sm->get(ContentModerationService\RegularExpressionsOfBadWords::class)
                    );
                },
                ContentModerationService\ContainsImmatureWords::class => function ($sm) {
                    return new ContentModerationService\ContainsImmatureWords(
                        $sm->get(ContentModerationService\RegularExpressionsOfImmatureWords::class)
                    );
                },
                ContentModerationService\RegularExpressionsOfBadWords::class => function ($sm) {
                    return new ContentModerationService\RegularExpressionsOfBadWords(
                    );
                },
                ContentModerationService\RegularExpressionsOfImmatureWords::class => function ($sm) {
                    return new ContentModerationService\RegularExpressionsOfImmatureWords(
                    );
                },
                ContentModerationService\ReplaceBadWords::class => function ($sm) {
                    return new ContentModerationService\ReplaceBadWords(
                        $sm->get(ContentModerationService\RegularExpressionsOfBadWords::class)
                    );
                },
                ContentModerationService\StripTagsReplaceBadWordsAndShorten::class => function ($sm) {
                    return new ContentModerationService\StripTagsReplaceBadWordsAndShorten(
                        $sm->get(ContentModerationService\ReplaceBadWords::class),
                        $sm->get(StringService\Shorten::class)
                    );
                },
            ],
        ];
    }
}
