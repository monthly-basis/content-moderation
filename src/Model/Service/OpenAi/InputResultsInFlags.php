<?php
namespace MonthlyBasis\ContentModeration\Model\Service\OpenAi;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class InputResultsInFlags
{
    public function __construct(
        protected ContentModerationService\OpenAi\ResponseContainsFlags $responseContainsFlagsService,
    ) {
    }

    /**
     * @throws \Exception If Open AI API timeout is reached, \Exception is thrown.
     */
    public function doesInputResultInFlags(string $input): bool
    {
        $response = $this->openAiService->moderation([
            'input' => $input,
        ]);

        return $this->responseContainsFlagsService->doesResponseContainFlags(
            $response
        );
    }
}
