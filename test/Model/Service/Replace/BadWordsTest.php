<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Replace;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

/**
 * WARNING
 *
 * The following code contains extremely explicit language.
 *
 * We have written code this code to prevent users from publicly posting
 * foul, vulgar, and offesnive language.
 *
 * In order to ensure that this code is functioning properly,
 * we must use explicit language in our own code.
 *
 * We sincerely apologize in advance if this code offends anyone.
 * Unfortunately, it is necessary in order to filter out this language.
 */
class ReplaceBadWordsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->regularExpressionsOfBadWordsService = new ContentModerationService\RegularExpressions\BadWords();
        $this->replaceBadWordsService = new ContentModerationService\Replace\BadWords(
            $this->regularExpressionsOfBadWordsService
        );
    }

    public function testReplaceBadWords()
    {
        $r = '!@#$%^&';

        $string = "\t\tthis sentence has line breaks and no bad words\r\n\n";;
        $this->assertSame(
            $string,
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'hello world Kushite s*h*i.t! s.hit sh*t shot doushite shtick';
        $this->assertSame(
            'hello world Kushite !@#$%^&! !@#$%^& !@#$%^& shot doushite shtick',
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'hclkafck fck you F U C K f.uck f-u-c----k f*ck f.ck ummm';
        $this->assertSame(
            "hclkafck $r you !@#$%^& !@#$%^& !@#$%^& !@#$%^& !@#$%^& ummm",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'shut the FuCk up p   u   s   sy fluck f.uck f*cking a ss f**k';
        $this->assertSame(
            "shut the !@#$%^& up !@#$%^& fluck !@#$%^& {$r}ing $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'hello fucker HOLY SHIT shithead nogg';
        $this->assertSame(
            'hello !@#$%^&er HOLY !@#$%^& !@#$%^&head nogg',
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'F-A-G foo faggot fagot bar DumbASS baz a$S';
        $this->assertSame(
            "!@#$%^& foo !@#$%^&got !@#$%^&ot bar !@#$%^& baz $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'ass bassoon sassy ASS a$$ @$$ @ss n1gg';
        $this->assertSame(
            '!@#$%^& bassoon sassy !@#$%^& !@#$%^& !@#$%^& !@#$%^& !@#$%^&',
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = ' fag wharfage suck dick suck a dick d!ck tracy dickhead';
        $this->assertSame(
            " $r whar{$r}e suck $r suck a $r $r tracy $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'fukuyama fuk foo cucumber cum boobs';
        $this->assertSame(
            "fukuyama !@#$%^& foo cucumber !@#$%^& !@#$%^&",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'bullshit bullsht dick tracy can suck my dick F OFF';
        $this->assertSame(
            "!@#$%^& !@#$%^& $r tracy can $r !@#$%^& $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = '8=D 8==D 8=========D';
        $this->assertSame(
            "8=D $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'ass @$$ asset asses assess as*hole as S pass area** a§š';
        $this->assertSame(
            "$r $r asset $r assess $r as S pass area** $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'A HOLES a hole has holes dumba** a** dumass AZZH0LES azzhole';
        $this->assertSame(
            "$r a hole has holes $r $r $r $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'ball suck balls ballsack ballsacks smelly balls';
        $this->assertSame(
            "ball $r $r $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'blowjob BLOW JOB blow.j.o.b blow me';
        $this->assertSame(
            "$r $r $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'boner';
        $this->assertSame(
            "$r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        /*
         * bitch
         */

        $string = 'bitch b*tch batch betcha bltch biach Bi!tches ʙïʨh bìtçh';
        $this->assertSame(
            "$r $r batch betcha $r $r $r $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'suck my b!tch b.itch b.i.t.c.h b i t c h sunuvabitch b itch';
        $this->assertSame(
            '!@#$%^& !@#$%^& !@#$%^& !@#$%^& !@#$%^& sunuva!@#$%^& !@#$%^&',
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'bi*ch bich bicth biitch Bi9ch a b***h a b**** biyach';
        $this->assertSame(
            "$r $r $r $r $r {$r}h $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'BITC* cubic units bish bishop snobbish';
        $this->assertSame(
            "$r cubic units $r bishop snobbish",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'bit cheerful a b*** a b**';
        $this->assertSame(
            "bit cheerful $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'clit classiclit';
        $this->assertSame(
            "$r classiclit",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        /*
         * cock
         */
        $string = 'cockadoodledoo cock sucker c0ck suck a cock';
        $this->assertSame(
            "cockadoodledoo !@#$%^&er $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );
        $string = 'suck a cok';
        $this->assertSame(
            "$r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'cooch coochie scooch';
        $this->assertSame(
            "$r $r scooch",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        /*
         * coon
         */
        $string = 'coon koon racoon';
        $this->assertSame(
            "$r $r racoon",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'cunt c__unt c*nt c u n t s etc until C++ until';
        $this->assertSame(
            "$r $r $r $r s etc until C++ until",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        /*
         * daddy
         */
        $string = 'harder daddy';
        $this->assertSame(
            "$r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'douchebag douche bag';
        $this->assertSame(
            "{$r}bag $r bag",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        /*
         * dick
         */
        $string = 'dick dikk d**k d!#k d)/k d***k Emily Dickinson SuckMyD*ick';
        $this->assertSame(
            "$r $r $r $r d)/k d***k Emily Dickinson SuckMy$r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'd!ck i like dicks DDIICCKK big dick dig bick';
        $this->assertSame(
            "$r i like $r $r big $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'f4ggot';
        $this->assertSame(
            "{$r}got",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'fap Fap';
        $this->assertSame(
            "$r Fap",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'fleshlight flashlight';
        $this->assertSame(
            "$r flashlight",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'foreskin';
        $this->assertSame(
            "$r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'fuck fukin f = 123 fuc F=kx F/k fuking fvck f### f*** f---';
        $this->assertSame(
            "$r $r f = 123 $r F=kx F/k $r $r $r $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'fu*king Confucius John F. Kennedy Fuecking of office f_uck';
        $this->assertSame(
            "$r Confucius John F. Kennedy {$r}ing of office $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'f_ck ƒμςκ f(kx) fU¢K WHAT THE FK f u if unicorns';
        $this->assertSame(
            "$r $r f(kx) $r $r $r if unicorns",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'gay g ay gae algae g_a.y reading a youtube';
        $this->assertSame(
            "$r $r $r algae $r reading a youtube",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'goddamn god damn';
        $this->assertSame(
            "$r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        /*
         * hentai
         */

        $string = 'hentai HENTAI';
        $this->assertSame(
            "$r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'hoe shoe';
        $this->assertSame(
            "$r shoe",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'horny thorny horney';
        $this->assertSame(
            "$r thorny $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'jigaboo';
        $this->assertSame(
            "$r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'kike KIKE';
        $this->assertSame(
            "$r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'kys skyscraper';
        $this->assertSame(
            "$r skyscraper",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'lesbian';
        $this->assertSame(
            "$r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'masturbation Masterbation';
        $this->assertSame(
            "$r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'Milford MILF';
        $this->assertSame(
            "Milford $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'nigg n1gg nig g ni99 n!gga n ! g g a In 1999 ɴigg n¡gg';
        $this->assertSame(
            "$r $r $r $r {$r}a {$r} a In 1999 $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );
        $string = ' nigleT nig night nicker nggas Nick Gurr noggers N!993R';
        $this->assertSame(
            " $r $r night $r {$r}s $r {$r}s {$r}3R",
            $this->replaceBadWordsService->replaceBadWords($string)
        );
        $string = 'ΝIGGΕR nick gur n word /VIGGA knee gar knee garr mr.nword';
        $this->assertSame(
            "{$r}ΕR $r $r $r $r $r mr.{$r}",
            $this->replaceBadWordsService->replaceBadWords($string)
        );
        $string = 'niqqa niqqer ngger niggr nggr Nick Ger Nick Gers negg@';
        $this->assertSame(
            "$r $r $r {$r}r $r $r {$r}s $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'nude nudes';
        $this->assertSame(
            "$r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        /*
         * nut
         */
        $string = 'no nut november';
        $this->assertSame(
            "$r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'penis Peni5 pennies pennis penus';
        $this->assertSame(
            "$r $r pennies $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'pervert perv friendlyperv hyperventilate';
        $this->assertSame(
            "$r $r friendly{$r} hyperventilate",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'porn P O R N pron p*rn help or not';
        $this->assertSame(
            "$r $r pron $r help or not",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'pussy P.u.s.s.y pussi pussies pu$$y';
        $this->assertSame(
            "$r $r $r $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'rape raped RAPES grape therapeutic rapist therapist';
        $this->assertSame(
            "$r {$r} {$r} grape therapeutic $r therapist",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        /*
         * sex
         */
        $string = 'have sex';
        $this->assertSame(
            "$r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        /*
         * shit
         */
        $string = 'shit sh!t sh1t $h!t §h!ł ft/s h(t)';
        $this->assertSame(
            "$r $r $r $r $r ft/s h(t)",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'stfu restful';
        $this->assertSame(
            "$r restful",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'slut SLUT slüt s1ut';
        $this->assertSame(
            "$r $r $r $r",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'tit competition TITS titties petit';
        $this->assertSame(
            "$r competition $r $r petit",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'whore WH0RE w h o r e who respects';
        $this->assertSame(
            "$r $r $r who respects",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'xhamster.com';
        $this->assertSame(
            "$r.com",
            $this->replaceBadWordsService->replaceBadWords($string)
        );

        $string = 'xvideos.com';
        $this->assertSame(
            "$r.com",
            $this->replaceBadWordsService->replaceBadWords($string)
        );
    }

    public function testReplaceBadWords_alternateReplacement_appropriateString()
    {
        $string = '\t\tthis sentence has line breaks and no bad words\r\n\n';
        $this->assertSame(
            $string,
            $this->replaceBadWordsService->replaceBadWords($string, 'foobar')
        );

        $string = 'foo bar ozeybhv baz';
        $this->assertSame(
            'foo bar  baz',
            $this->replaceBadWordsService->replaceBadWords($string, '')
        );
    }

    public function test_replaceBadWords_longString_longString()
    {
$string = <<<STRING
Can someone please help me? Here's my quick check questions :)


  1. Native Americans who live in on lake Titicaca use totora reeds for all except
        A. Making boats and houses
        B. Wagons
        C. Clothing
        D. Food and medicine

  2. The Argentinian plains are home to Argentinian cowboys,also known as
       A. Pampas
       B. Maquiladoras
       C. Immigrants
       D. Gauchos

  3.  South Americas largest country,brazil, dose not speak Spanish , instead they speak
       A. French
       B. Italian
       C. English
       D. Portuguese

4.   On the pampas of Argentina , many people make their living as
       A. Coffee farmers
       B. Cattle ranchers
       C. Factory workers
       D.  Street vendors

My answers: 1. A
                     2. D
                     3. C
                     4. B
                               ( NOTE ) DON'T SUBMIT THESE! I NEED THEM TO BE CHECKED       AND PLEASE NO HATE IF I GET THEM WRONG I'M STRUGGLING ON THESE UNIT!!! :(
STRING;

        $this->assertSame(
            $string,
            $this->replaceBadWordsService->replaceBadWords($string)
        );
    }
}
