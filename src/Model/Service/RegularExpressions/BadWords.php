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
            '/\banal\b/i',

            /*
             * anus
             */
            '/Hugh Janus/i',

            /*
             * ass
             *
             * Cannot use word boundary (\b) around dollar sign because
             * dollar sign is not a word character.
             * So, just hard-code some variations for now.
             */
            '/\ba\.?\s*ss(es)?\b/i',
            '/\bazz\b/i',

            // Spaces
            '/\ba\s+s\s+s\b/i',

            // Symbols
            // An 'a' followed by one asterisk is used in many equations.
            // So, we will only match an 'a' followed by two asterisks.
            '/\ba\*\*/i',
            '/(\ba|[@])[s§\$]([š\$]|s\b)/iu',

            // Variants
            '/\ba[s5z][s5z\W]h[0o][l1]es?/i',
            '/\ba holes\b/i',
            '/badass/i',
            '/dum(ass|b(ass?|a\W\W))/i',

            /*
             * ball
             */
            '/^balls$/i',
            '/ball ?sacks?/i',
            '/balls ?in ?yo/i',
            '/my balls/i',
            '/smelly balls/i',
            '/suck balls?/i',
            '/your balls/i',

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
            '/[bʙ][i1lïì][t\*]?[cʨçč\$\*]h/iu',

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

            '/\bbo{2,}bs?/i',

            /*
             * ching chong
             */

            '/ching chong/i',

            /*
             * clit
             */

            '/\bclit\b/i',

            /*
             * cock
             */

            // Spellings
            '/co{2,}ck/i',

            // Phrases
            '/cockandballs/i',
            '/cock ?sucker/i',
            '/massive co[ck]/i',
            '/suck a co(ck?|k)/i',

            // Spaces
            '/\bc\s*o\s*c\s*k(\s*s)?\b/i',

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

            /*
             * cum
             */
            '/\bcum+s?(?! laude)\b/i',
            '/cumming\b/i',

            // The following results in a PREG_BACKTRACK_LIMIT_ERROR in some cases.
            //'/\bc(\W|\_| )*(u|\W) ?n ?ts?\b/i',

            // Spaces
            '/\bc\s*u\s*n\s*t(?!il)/i',

            // Symbols
            '/\bc(\W|_)*u\W*n\W*t(\W*s)?\b/i',
            '/\bc\Wnt/i',

            '/dammit/i',
            '/damnit/i',

            '/douche?/i',

            /*
             * daddy
             */

            '/harder daddy/i',

            /*
             * dick
             */

            // Phrases
            '/dig bick/i',
            '/big dik/i',

            // Letters and Spaces
            '/(?<!moby[\-\s])d+\s*i+\s*c+\s*k+s?\b/i',

            // Symbols
            '/(?<!moby[\-\s])d\W?[i\!\*1][ck]k\b/i',
            '/(?<!moby[\-\s])[dđ][iį\!\#\*][cč\#\*][kķ]\b/iu',

            // Variations
            '/\bdicc\b/i',
            '/dickhead/i',

            /*
             * eat
             */

            '/eat me out/i',

            /*
             * erection
             */

            '/Hue G\.? Rection/i',

            /*
             * fag
             */

            '/\bf\W*a\W*g\b/i',
            '/\bf[a4@]g/i',

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

            '/\bf[^\w\=\/\( ]+k/i',
            '/\bf\W+ck/i',

            '/\bfu+\W?k+(ers?)?\b/i',
            '/\bfu?[c\W]?king?\b/i',

            // Phrases
            '/dumb af/i',
            '/\bf you\b/i',
            '/go f yourself/i',
            '/gtfo/i',
            '/mother ?f[u\*]ckers/i',
            '/\bs(hut )?\W?t(he )?\W?f ?\W?up?\b/i',

            // Symbols
            '/(\bf|[ƒḟ])[uμ0#\*\-\/][c#\*\(\-¢ς\*][kκ#\*\-]/iu',
            // We don't want to match four consecutive asterisks,
            // so we match just two astericks followed by 'ck' instead.
            '/\*\*ck/iu',
            '/\bf_u?ck/i',
            '/F-ING/i',
            '/\*\*\*\*ING/i',

            '/f(\W)*(u|v)e?\W*c\W*k/i',
            '/\bf\W*c\W*k\b/i',
            '/\bfuc(?!tion)/i',

            // Spellings
            '/f+(u+|x)(c+k+|q)/i',
            '/fcuk/i',
            '/fawk/i',
            '/fook/i',
            '/fuxk/i',

            // Variations
            '/\bf off\b/i',
            '/\bf u\b/i',
            '/what the fk/i',

            /*
             * gay
             */

            // Spellings
            '/\bgae\b/i',
            '/\bgey\b/i',

            // Symbols
            '/\bg[\s\.\_]?[a\@4][\s\.\_]?y(?!le)(?!-Lussac)/i',

            '/god ?damn?/i',

            /*
             * handjob
             */
            '/hand(\s|\W)*job/i',

            /*
             * hentai
             */
            '/hentai/i',

            /*
             * hoe
             */
            '/\bh[o0]e/i',

            /*
             * homo
             */
            '/\bhomo\b(?! habilis)(?! sapien)/i',

            /*
             * horny
             */

            '/\bh\s*o\s*r\s*n(\s*e)?\s*y/i',

            '/jigaboo/i',
            '/jackass/i',
            '/kike/i',

            /*
             * kill
             */
            '/kill ?yourself/i',
            '/\bkys\b/i',

            /*
             *
             */
            '/lesb(ian|o)/i',

            '/mast(e|u)rbat(ion)?/i',

            /*
             * ligma
             */

            '/l[i\!]gma/i',

            /*
             * lolita
             */

            '/lolita/i',

            /*
             * Mike
             */
            '/Mike Hawk/i',
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
            '/([n𝔫𝖓𝓃]|\/\\\\\/)[1ie𝔦𝖎𝒾\'"\!][69bg𝔤𝖌𝑔q][69bg𝔤𝖌𝑔q](?!le)(?!ling)([a@]|[3e𝔢𝖊𝑒][r𝔯𝖗𝓇])?/iu',

            // Variations
            '/knee g[ae]rr?s?/i',
            '/Nea grr/i',
            '/\bneg[ae]r/i',
            '/nigro/i',
            '/nick [gk][eu]rr?/i',
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

            /*
             * oral
             */

            '/love oral/i',

            '/orgasm/i',

            /*
             * pedo
             */
            '/\bpedo\b/i',

            /*
             * penis
             */
            '/p[e3]nn?[iu1][s\$5]/i',

            // Spacing
            '/p\s+e\s+n\s+i\s+s/i',

            // Spellings
            '/peen/i',

            '/perv(ert|s|\b)/i',

            '/phuck/i',

            /*
             * porn
             */

            // Spaces
            '/\bp\s*o\s*r\s*n/i',

            // Symbols
            '/p[o\*0][rɾ]n/i',

            // Spaces and Symbols
            '/\bp[\W_]*o\W*r[\W_]*n\b/i',

            // Spellings
            '/\bpron\b/i',

            /*
             * pp
             */

            '/(big|\bmy|small) (pp|pee ?pee)/i',

            /*
             * pussy
             */
            '/p\s*u\s*s\s*s\s*y/i',
            '/p\W*u\W*[s\$]\W*[s\$]\W*y/i',
            '/pussi(es)?/i',

            // Spellings
            '/pusay/i',

            /*
             * queef
             */
            '/[qᑫ][uᑌ][eᗴ][eᗴ][fᖴ]/iu',

            /*
             * rape
             */
            '/\brape[ds]?/i',
            '/\brapist/i',

            /*
             * retard
             */
            '/r[eе€]t[aа@]r[dɗt](?!ant)(?!ation)(?!ing)/iu',

            /*
             * rim job
             */
            '/rim job/i',

            /*
             * schlong
             */
            '/sc?hlong/i',

            /*
             * sex
             */
            '/have s[e\*]x/i',
            '/(hard|love|want) sex/i',
            '/[s\$][e\*]xy/i',

            /*
             * shit
             */

            // Phrases
            '/piece of \*\*\*\*/i',

            // Spaces
            '/(?<!m\/)\bs\s*h\s*i\s*t\b/i',

            // Spellings
            '/bull(shit|[^\w\s]{4})/i',
            '/dip ?shit/i',

            // Symbols
            '/\bs[\*\.]?h[\*]?i[\.]?t/iu',
            '/(\b[s5]|[\$\§])[h\*][i1l\!\*\-¡][t\ł]/iu',

            '/s(l|1)(u|ü)t/i',
            '/suck my/i',

            /*
             * threesome
             */
            '/threesome/i',

            /*
             * tit
             */
            '/\bt[i1]ts?\b/i',
            '/t[i1](dd?|tt)[i1]es/i',

            '/vag\s?ina/i',

            /*
             * whore
             */
            '/(wh|\bh)[o\*0]re/i',

            '/w\s+h\s+o\s+r\s+e/i',
            '/xhamster/i',
            '/xvideos/i',
        ];
    }
}
