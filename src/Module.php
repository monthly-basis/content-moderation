<?php
namespace MonthlyBasis\ContentModeration;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use LeoGalleguillos\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Controller as ContentModerationController;
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
                    'toHtml'                             => ContentModerationHelper\ToHtml::class,
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
                    ContentModerationHelper\ToHtml::class => function ($sm) {
                        return new ContentModerationHelper\ToHtml(
                            $sm->get(ContentModerationService\ToHtml::class)
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
                ContentModerationService\Contains\BadWords::class => function ($sm) {
                    return new ContentModerationService\Contains\BadWords(
                        $sm->get(ContentModerationService\RegularExpressions\BadWords::class)
                    );
                },
                ContentModerationService\Contains\ImmatureWords::class => function ($sm) {
                    return new ContentModerationService\Contains\ImmatureWords(
                        $sm->get(ContentModerationService\RegularExpressions\ImmatureWords::class)
                    );
                },
                ContentModerationService\Contains\RepeatingCharacters::class => function ($sm) {
                    return new ContentModerationService\Contains\RepeatingCharacters(
                        $sm->get('config')['content-moderation']['contains-repeating-characters']
                    );
                },
                ContentModerationService\Contains\SocialMedia::class => function ($sm) {
                    return new ContentModerationService\Contains\SocialMedia(
                        $sm->get(ContentModerationService\RegularExpressions\SocialMedia::class)
                    );
                },
                ContentModerationService\ContainsBadWords::class => function ($sm) {
                    return new ContentModerationService\ContainsBadWords(
                        $sm->get(ContentModerationService\RegularExpressions\BadWords::class)
                    );
                },
                ContentModerationService\ContainsImmatureWords::class => function ($sm) {
                    return new ContentModerationService\ContainsImmatureWords(
                        $sm->get(ContentModerationService\RegularExpressions\ImmatureWords::class)
                    );
                },
                ContentModerationService\RegularExpressions\BadWords::class => function ($sm) {
                    return new ContentModerationService\RegularExpressions\BadWords();
                },
                ContentModerationService\RegularExpressions\ImmatureWords::class => function ($sm) {
                    return new ContentModerationService\RegularExpressions\ImmatureWords();
                },
                ContentModerationService\RegularExpressions\SocialMedia::class => function ($sm) {
                    return new ContentModerationService\RegularExpressions\SocialMedia();
                },
                ContentModerationService\Replace\BadWords::class => function ($sm) {
                    return new ContentModerationService\Replace\BadWords(
                        $sm->get(ContentModerationService\RegularExpressions\BadWords::class)
                    );
                },
                ContentModerationService\Replace\ImmatureWords::class => function ($sm) {
                    return new ContentModerationService\Replace\ImmatureWords(
                        $sm->get(ContentModerationService\RegularExpressions\ImmatureWords::class)
                    );
                },
                /**
                 * @deprecated Use ContentModerationService\Replace\BadWords() instead.
                 */
                ContentModerationService\ReplaceBadWords::class => function ($sm) {
                    return new ContentModerationService\ReplaceBadWords(
                        $sm->get(ContentModerationService\RegularExpressions\BadWords::class)
                    );
                },
                /**
                 * @deprecated Use ContentModerationService\Replace\ImmatureWords() instead.
                 */
                ContentModerationService\ReplaceImmatureWords::class => function ($sm) {
                    return new ContentModerationService\ReplaceImmatureWords(
                        $sm->get(ContentModerationService\RegularExpressions\ImmatureWords::class)
                    );
                },
                ContentModerationService\StripTagsReplaceBadWordsAndShorten::class => function ($sm) {
                    return new ContentModerationService\StripTagsReplaceBadWordsAndShorten(
                        $sm->get(ContentModerationService\ReplaceBadWords::class),
                        $sm->get(StringService\Shorten::class)
                    );
                },
                ContentModerationService\ToHtml::class => function ($sm) {
                    return new ContentModerationService\ToHtml(
                        $sm->get(ContentModerationService\Replace\ImmatureWords::class),
                        $sm->get(ContentModerationService\ReplaceBadWords::class),
                        $sm->get(StringService\Escape::class),
                        $sm->get(StringService\Url\ToHtml::class)
                    );
                },
            ],
        ];
    }
}
