<?php
namespace MonthlyBasis\ContentModeration\Model\Service\RegularExpressions;

/**
 * WARNING
 *
 * The following code contains extremely explicit language.
 *
 * In order to ensure that this code is functioning properly,
 * we must use explicit language in our own code.
 *
 * @TODO Also, in future versions of this software, "bad" words will be
 * divided into more-specific categories. For example, a word dealing
 * with sex should be in a category called "sex" and should not always be
 * categorized as "bad".
 *
 * Notes:
 *
 * Word boundary (\b) cannot be used around non-word characters (\W).
 *
 * Phrases generally come first since we want to replace those completely.
 */
class BadWords
{
    public function getRegularExpressionsOfBadWords(): array
    {
        return [
            /*
             * Test string to trigger bad word detectors in production
             * for users who should not have to type a bad word.
             */
            '/ozeybhv/',

            '/8={2,}D/i',

            /*
             * anal
             */
            '/anal beads/i',

            /*
             * ass
             *
             * Cannot use word boundary (\b) around dollar sign because
             * dollar sign is not a word character.
             * So, just hard-code some variations for now.
             */
            '/\ba\s*ss(es)?\b/i',
            '/\bazz\b/i',

            // Symbols
            '/\ba\*\*/i',
            '/a(s|\$)\$/i',
            '/a\$(s|\$)/i',
            '/@ss/i',
            '/@\$\$/i',
            '/a§š/i',

            // Variants
            '/\ba[sz][sz\W]h[0o]les?/i',
            '/\ba holes\b/i',
            '/dumb?ass/i',
            '/dumba\W\W/i',

            /*
             * ball
             */
            '/ballsacks?/i',
            '/smelly balls/i',
            '/suck balls?/i',

            '/bastard/i',

            /*
             * bitch
             */
            '/biach/i',
            '/b\W*(i\W*)?t\W*c\W*h(es)?\b/i',
            '/bi+(t|\W)c(h|\W)/i',
            '/bict?h/i',
            '/bi\dch/i',
            '/a b\*+/i',
            '/biyach/i',

            // Symbols
            '/[bʙ][i1lïì][t\*]?[c\*ʨç]h/iu',

            // Variants
            '/\bbish\b/i',

            /*
             * blow
             */
            '/blow me/i',
            '/blow\W*j\W*o\W*b/i',

            /*
             * boner
             */
            '/boner/i',

            '/\bboobs\b/i',
            '/bullshi?t/i',
            '/\bclit\b/i',

            /*
             * cock
             */

            // Phrases
            '/cock ?and ?balls/i',
            '/cock\s*suck/i',
            '/massive co(c|ck|k)/i',
            '/suck a coc?k/i',

            // Symbols
            '/c[0\#]ck/i',

            /*
             * cooch
             */
            '/\bcooch(ie)?/i',
            '/coochieman/i',

            /*
             * coon
             */
            '/\b[ck]oon\b/i',

            '/\bcum\b/i',

            // The following results in a PREG_BACKTRACK_LIMIT_ERROR in some cases.
            //'/\bc(\W|\_| )*(u|\W) ?n ?ts?\b/i',
            '/\bc\s*u\s*n\s*t/i',
            '/\bc(\W|_)*u\W*n\W*t(\W*s)?\b/i',
            '/\bc\Wnt/i',

            '/dammit/i',
            '/damnit/i',

            '/douche/i',

            /*
             * daddy
             */

            '/harder daddy/i',

            /*
             * dick
             */

            // Phrases
            '/dig bick/i',

            // Letters
            '/d+i+c+k+s?\b/i',

            // Symbols
            '/d\W?[\!1i][ck]k\b/i',
            '/d[\!\#\*]{2}k/i',

            // Variations
            '/dickhead/i',

            /*
             * eat
             */
            '/eat me out/i',

            '/f(a|4)g/i',
            '/fap/',
            '/fleshlight/i',
            '/foreskin/i',

            /*
             * freak
             */
            '/certified ?freak/i',

            /*
             * fuck
             */

            '/\bf(###|\*\*\*|\-\-\-)/i',
            '/\bf[^\w\=\/\( ]+k/i',
            '/\bf\W+ck/i',
            '/\bf\W*a\W*g\b/i',

            '/\bfu\W?k\b/i',
            '/fu\W?king?/i',

            // Symbols
            '/(f|ƒ)(u|μ)(c|¢|ς)(k|κ)/i',
            '/\bf_u?ck/i',

            '/f(\W)*(u|v)e?\W*c\W*k/i',
            '/\bf\W*c\W*k\b/i',
            '/\bfuc/i',

            // Variations
            '/\bf off\b/i',
            '/\bf u\b/i',
            '/what the fk/i',

            /*
             * gay
             */

            // Spaces
            '/\bg ay\b/i',

            // Symbols
            '/g[\.\_]?[\@a][\.\_]?y/i',

            // Variations
            '/\bgae\b/i',

            '/god ?damn/i',

            /*
             * hentai
             */
            '/hentai/i',

            '/\bhoe/i',
            '/\bhorne?y/i',

            '/jigaboo/i',
            '/jackass/i',
            '/kike/i',

            /*
             * kill
             */
            '/kill ?yourself/i',
            '/\bkys\b/i',
            '/lesbian/i',
            '/mast(e|u)rbat(ion)?/i',

            /*
             * Mike Hunt
             */
            '/Mike Hunt/i',

            '/\bmilf\b/i',

            /*
             * nigger
             */
            '/[nɴΝ]\W*[1il\!\¡]\W*g\W*g/i',
            '/\/VIGGA/i',
            '/ngga/i',
            '/\bnicker\b/i',
            '/\bnig\b/i',
            '/nogger/i',

            // Spellings
            '/ni?gge?r/i',

            // Symbols
            '/[n𝖓][\!1i𝖎][9bg𝖌q][9bg𝖌q](a|[3e𝖊][r𝖗])?/iu',
            '/negg@/i',

            // Variations
            '/knee garr?/i',
            '/Nea grr/i',
            '/nick g[eu]rr?/i',
            '/niglet/i',
            '/\bn ?word\b/i',

            /*
             * nude
             */
            '/nudes?/i',

            /*
             * nut
             */
            '/no nut november/i',

            '/orgasm/i',

            '/penn?[iu][5s]/i',

            '/perv(ert|s|\b)/i',

            '/phuck/i',

            '/\bp\s*o\s*(r|ɾ)\s*n/i',
            '/\bp(o|\W)rn/i',

            /*
             * pussy
             */
            '/p\s*u\s*s\s*s\s*y/i',
            '/p\W*u\W*[s\$]\W*[s\$]\W*y/i',
            '/pussi(es)?/i',

            // Spellings
            '/pusay/i',

            /*
             * rape
             */
            '/\brape[ds]?/i',
            '/\brapist/i',

            /*
             * sex
             */
            '/have s[e\*]x/i',

            /*
             * shit
             */

            // Spaces
            '/\bs\s*h\s*i\s*t/i',

            // Symbols
            '/\bs[\*\.]?h[\*]?i[\.]?t/iu',
            '/(\bs|[\$\§])h[i1\!\*][t\ł]/iu',

            '/\bstfu/i',

            '/s(l|1)(u|ü)t/i',
            '/suck my/i',

            '/\btits?\b/i',
            '/titties/i',

            '/vagina/i',
            '/wh(o|0)re/i',
            '/w\s+h\s+o\s+r\s+e/i',
            '/xhamster/i',
            '/xvideos/i',
        ];
    }
}
