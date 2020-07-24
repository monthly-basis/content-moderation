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
            'controllers' => [
                'factories' => [
                    ContentModerationController\Index::class => function ($sm) {
                        return new ContentModerationController\Index();
                    },
                ],
            ],
            'router' => [
                'routes' => [
                    'index' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/',
                            'defaults' => [
                                'controller' => ContentModerationController\Index::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                ],
            ],
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
            'view_manager' => [
                'display_not_found_reason' => true,
                'doctype'                  => 'HTML5',
                'not_found_template'       => 'error/404',
                'exception_template'       => 'error/index',
                'template_map' => [
                    'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
                    'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
                    'error/404'               => __DIR__ . '/../view/error/404.phtml',
                    'error/index'             => __DIR__ . '/../view/error/index.phtml',
                ],
                'template_path_stack' => [
                    'application' => __DIR__ . '/../view',
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
