<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class ResponseContainsFlagsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->responseContainsFlagsService = new ContentModerationService\OpenAi\ResponseContainsFlags();
    }

    public function test_doesResponseContainFlags_false()
    {
$response = <<<RESPONSE
{
  "id": "modr-8NQ1zRRVZkKqcd5Uf3D7kOqV2ACmu",
  "model": "text-moderation-006",
  "results": [
    {
      "flagged": false,
      "categories": {
        "sexual": false,
        "hate": false,
        "harassment": false,
        "self-harm": false,
        "sexual/minors": false,
        "hate/threatening": false,
        "violence/graphic": false,
        "self-harm/intent": false,
        "self-harm/instructions": false,
        "harassment/threatening": false,
        "violence": false
      },
      "category_scores": {
        "sexual": 0.000021431864297483116,
        "hate": 0.00002257188498333562,
        "harassment": 0.000075509786256589,
        "self-harm": 0.00001071254700946156,
        "sexual/minors": 1.0029423265223159e-6,
        "hate/threatening": 6.547368229803396e-7,
        "violence/graphic": 6.88998227360571e-7,
        "self-harm/intent": 4.321589585742913e-6,
        "self-harm/instructions": 7.849426992834196e-7,
        "harassment/threatening": 2.9453110528265825e-7,
        "violence": 1.2239099760336103e-6
      }
    }
  ]
}
RESPONSE;
        $this->assertFalse(
            $this->responseContainsFlagsService->doesResponseContainFlags(
                $response
            )
        );
    }

    public function test_doesResponseContainFlags_flagged_true()
    {
$response = <<<RESPONSE
{
  "id": "modr-moderationrequestid",
  "model": "text-moderation-006",
  "results": [
    {
      "flagged": true,
      "categories": {
        "sexual": false,
        "hate": false,
        "harassment": false,
        "self-harm": false,
        "sexual/minors": false,
        "hate/threatening": false,
        "violence/graphic": false,
        "self-harm/intent": false,
        "self-harm/instructions": false,
        "harassment/threatening": false,
        "violence": false
      },
      "category_scores": {
        "sexual": 0.00013046465755905956,
        "hate": 0.00018139940220862627,
        "harassment": 0.0031440879683941603,
        "self-harm": 0.002330463845282793,
        "sexual/minors": 0.00005766292451880872,
        "hate/threatening": 0.00007506000838475302,
        "violence/graphic": 0.000010010073310695589,
        "self-harm/intent": 0.0008129942580126226,
        "self-harm/instructions": 0.000021542598915402777,
        "harassment/threatening": 0.030469587072730064,
        "violence": 0.05927495956420898
      }
    }
  ]
}
RESPONSE;
        $this->assertTrue(
            $this->responseContainsFlagsService->doesResponseContainFlags(
                $response
            )
        );
    }

    public function test_doesResponseContainFlags_categoryFlags_true()
    {
$response = <<<RESPONSE
{
  "id": "modr-moderationrequestid",
  "model": "text-moderation-006",
  "results": [
    {
      "flagged": false,
      "categories": {
        "sexual": false,
        "hate": false,
        "harassment": true,
        "self-harm": false,
        "sexual/minors": false,
        "hate/threatening": false,
        "violence/graphic": false,
        "self-harm/intent": false,
        "self-harm/instructions": false,
        "harassment/threatening": false,
        "violence": true
      },
      "category_scores": {
        "sexual": 0.00013046465755905956,
        "hate": 0.00018139940220862627,
        "harassment": 0.0031440879683941603,
        "self-harm": 0.002330463845282793,
        "sexual/minors": 0.00005766292451880872,
        "hate/threatening": 0.00007506000838475302,
        "violence/graphic": 0.000010010073310695589,
        "self-harm/intent": 0.0008129942580126226,
        "self-harm/instructions": 0.000021542598915402777,
        "harassment/threatening": 0.030469587072730064,
        "violence": 0.05927495956420898
      }
    }
  ]
}
RESPONSE;
        $this->assertTrue(
            $this->responseContainsFlagsService->doesResponseContainFlags(
                $response
            )
        );
    }

    public function test_doesResponseContainFlags_highCategoryScore_true()
    {
$response = <<<RESPONSE
{
  "id": "modr-moderationrequestid",
  "model": "text-moderation-006",
  "results": [
    {
      "flagged": false,
      "categories": {
        "sexual": false,
        "hate": false,
        "harassment": false,
        "self-harm": false,
        "sexual/minors": false,
        "hate/threatening": false,
        "violence/graphic": false,
        "self-harm/intent": false,
        "self-harm/instructions": false,
        "harassment/threatening": false,
        "violence": false
      },
      "category_scores": {
        "sexual": 0.00013046465755905956,
        "hate": 0.00018139940220862627,
        "harassment": 0.0031440879683941603,
        "self-harm": 0.002330463845282793,
        "sexual/minors": 0.00005766292451880872,
        "hate/threatening": 0.00007506000838475302,
        "violence/graphic": 0.000010010073310695589,
        "self-harm/intent": 0.0008129942580126226,
        "self-harm/instructions": 0.000021542598915402777,
        "harassment/threatening": 0.030469587072730064,
        "violence": 0.5927495956420898
      }
    }
  ]
}
RESPONSE;
        $this->assertTrue(
            $this->responseContainsFlagsService->doesResponseContainFlags(
                $response
            )
        );
    }
}
