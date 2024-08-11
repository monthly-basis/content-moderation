# Content Moderation

Determine whether text contains bad words.

## WARNING

The source code for this repository contains extremely explicit language.

We have written code to determine whether a string contains bad words.

Unfortunately, in order to ensure that this code is functioning properly, we must use explicit language in our own code.

Sorry.

## Installation

    composer require monthly-basis/content-moderation

## Examples

### Standalone PHP

    <?php
    require_once('vendor/autoload.php');

    $containsBadWords = MonthlyBasis\ContentModeration\Model\Factory\ContainsBadWords::build();

    $string = 'hello world';

    if ($containsBadWords->containsBadWords($string)) {
        echo 'Your string contains bad words!';
    } else {
        echo 'Phew, your string does not contain bad words.';
    }

### GET Request

    https://content-moderation.monthly-basis.com/api/v0/contains-bad-words?string=hello+world

JSON response

    {
        "contains-bad-words": false,
        "success": true
    }
