<?php

class MooLangISOConvert {
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new MooLangISOConvert();
        }

        return $instance;
    }
    /**
     * Convert an ISO 639-2 terminology living language code into its ISO 639-1 equivalent
     *
     * @link http://www.sil.org/iso639-3/codes.asp ISO 639-2 tables
     * @param string $iso639_2t ISO 639-2 terminology living language code
     * @return string ISO 639-1 code or null if none found
     */
    function lang_iso639_2t_to_1( $iso639_2t ) {
        static $language_codes = array(
            'aar'=>'aa', // Afar
            'abk'=>'ab', // Abkhazian
            'afr'=>'af', // Afrikaans
            'aka'=>'ak', // Akan
            'amh'=>'am', // Amharic
            'ara'=>'ar', // Arabic
            'arg'=>'an', // Aragonese
            'asm'=>'as', // Assamese
            'ava'=>'av', // Avaric
            'aym'=>'ay', // Aymara
            'aze'=>'az', // Azerbaijani
            'bak'=>'ba', // Bashkir
            'bam'=>'bm', // Bambara
            'bel'=>'be', // Belarusian
            'ben'=>'bn', // Bengali
            'bis'=>'bi', // Bislama
            'bos'=>'bs', // Bosnian
            'bre'=>'br', // Breton
            'bul'=>'bg', // Bulgarian
            'cat'=>'ca', // Catalan
            'ces'=>'cs', // Czech
            'cha'=>'ch', // Chamorro
            'che'=>'ce', // Chechen
            'chv'=>'cv', // Chuvash
            'cor'=>'kw', // Cornish
            'cos'=>'co', // Corsican
            'cre'=>'cr', // Cree
            'cym'=>'cy', // Welsh
            'dan'=>'da', // Danish
            'deu'=>'de', // German
            'div'=>'dv', // Dhivehi
            'dzo'=>'dz', // Dzongkha
            'ell'=>'el', // Modern Greek (1453-)
            'eng'=>'en', // English
            'est'=>'et', // Estonian
            'eus'=>'eu', // Basque
            'ewe'=>'ee', // Ewe
            'fao'=>'fo', // Faroese
            'fas'=>'fa', // Persian
            'fij'=>'fj', // Fijian
            'fin'=>'fi', // Finnish
            'fra'=>'fr', // French
            'fry'=>'fy', // Western Frisian
            'ful'=>'ff', // Fulah
            'ger'=>'de', // German bibliographic
            'gla'=>'gd', // Scottish Gaelic
            'gle'=>'ga', // Irish
            'glg'=>'gl', // Galician
            'glv'=>'gv', // Manx
            'grn'=>'gn', // Guarani
            'guj'=>'gu', // Gujarati
            'hat'=>'ht', // Haitian
            'hau'=>'ha', // Hausa
            'heb'=>'he', // Hebrew
            'her'=>'hz', // Herero
            'hin'=>'hi', // Hindi
            'hmo'=>'ho', // Hiri Motu
            'hrv'=>'hr', // Croatian
            'hun'=>'hu', // Hungarian
            'hye'=>'hy', // Armenian
            'ibo'=>'ig', // Igbo
            'iii'=>'ii', // Sichuan Yi
            'iku'=>'iu', // Inuktitut
            'ind'=>'id', // Indonesian
            'ipk'=>'ik', // Inupiaq
            'isl'=>'is', // Icelandic
            'ita'=>'it', // Italian
            'jav'=>'jv', // Javanese
            'jpn'=>'ja', // Japanese
            'kal'=>'kl', // Kalaallisut
            'kan'=>'kn', // Kannada
            'kas'=>'ks', // Kashmiri
            'kat'=>'ka', // Georgian
            'kau'=>'kr', // Kanuri
            'kaz'=>'kk', // Kazakh
            'khm'=>'km', // Central Khmer
            'kik'=>'ki', // Kikuyu
            'kin'=>'rw', // Kinyarwanda
            'kir'=>'ky', // Kirghiz
            'kom'=>'kv', // Komi
            'kon'=>'kg', // Kongo
            'kor'=>'ko', // Korean
            'kua'=>'kj', // Kuanyama
            'kur'=>'ku', // Kurdish
            'lao'=>'lo', // Lao
            'lav'=>'lv', // Latvian
            'lim'=>'li', // Limburgan
            'lin'=>'ln', // Lingala
            'lit'=>'lt', // Lithuanian
            'ltz'=>'lb', // Luxembourgish
            'lub'=>'lu', // Luba-Katanga
            'lug'=>'lg', // Ganda
            'mah'=>'mh', // Marshallese
            'mal'=>'ml', // Malayalam
            'mar'=>'mr', // Marathi
            'mkd'=>'mk', // Macedonian
            'mlg'=>'mg', // Malagasy
            'mlt'=>'mt', // Maltese
            'mon'=>'mn', // Mongolian
            'mri'=>'mi', // Maori
            'msa'=>'ms', // Malay (macrolanguage)
            'mya'=>'my', // Burmese
            'nau'=>'na', // Nauru
            'nav'=>'nv', // Navajo
            'nbl'=>'nr', // South Ndebele
            'nde'=>'nd', // North Ndebele
            'ndo'=>'ng', // Ndonga
            'nep'=>'ne', // Nepali
            'nld'=>'nl', // Dutch
            'nno'=>'nn', // Norwegian Nynorsk
            'nob'=>'nb', // Norwegian BokmÎl
            'nor'=>'no', // Norwegian
            'nya'=>'ny', // Nyanja
            'oci'=>'oc', // Occitan (post 1500)
            'oji'=>'oj', // Ojibwa
            'ori'=>'or', // Oriya
            'orm'=>'om', // Oromo
            'oss'=>'os', // Ossetian
            'pan'=>'pa', // Panjabi
            'pol'=>'pl', // Polish
            'por'=>'pt', // Portuguese
            'pus'=>'ps', // Pushto
            'que'=>'qu', // Quechua
            'roh'=>'rm', // Romansh
            'ron'=>'ro', // Romanian
            'run'=>'rn', // Rundi
            'rus'=>'ru', // Russian
            'sag'=>'sg', // Sango
            'sin'=>'si', // Sinhala
            'slk'=>'sk', // Slovak
            'slv'=>'sl', // Slovenian
            'sme'=>'se', // Northern Sami
            'smo'=>'sm', // Samoan
            'sna'=>'sn', // Shona
            'snd'=>'sd', // Sindhi
            'som'=>'so', // Somali
            'sot'=>'st', // Southern Sotho
            'spa'=>'es', // Spanish
            'sqi'=>'sq', // Albanian
            'srd'=>'sc', // Sardinian
            'srp'=>'sr', // Serbian
            'ssw'=>'ss', // Swati
            'sun'=>'su', // Sundanese
            'swa'=>'sw', // Swahili
            'swe'=>'sv', // Swedish
            'tah'=>'ty', // Tahitian
            'tam'=>'ta', // Tamil
            'tat'=>'tt', // Tatar
            'tel'=>'te', // Telugu
            'tgk'=>'tg', // Tajik
            'tgl'=>'tl', // Tagalog
            'tha'=>'th', // Thai
            'tir'=>'ti', // Tigrinya
            'ton'=>'to', // Tonga (Tonga Islands)
            'tsn'=>'tn', // Tswana
            'tso'=>'ts', // Tsonga
            'tuk'=>'tk', // Turkmen
            'tur'=>'tr', // Turkish
            'twi'=>'tw', // Twi
            'uig'=>'ug', // Uighur
            'ukr'=>'uk', // Ukrainian
            'urd'=>'ur', // Urdu
            'uzb'=>'uz', // Uzbek
            'ven'=>'ve', // Venda
            'vie'=>'vi', // Vietnamese
            'wln'=>'wa', // Walloon
            'wol'=>'wo', // Wolof
            'xho'=>'xh', // Xhosa
            'yid'=>'yi', // Yiddish
            'yor'=>'yo', // Yoruba
            'zha'=>'za', // Zhuang
            'zho'=>'zh', // Chinese
            'zul'=>'zu' // Zulu
        );
        return isset($language_codes[$iso639_2t]) ? $language_codes[$iso639_2t] : 'en';
    }


    /**
     * Convert an ISO 639-2 bibliography living language code into its ISO 639-1 equivalent
     *
     * @link http://www.sil.org/iso639-3/codes.asp ISO 639-2 tables
     * @param string $iso639_2b ISO 639-2 bibliography living language code
     * @return string ISO 639-1 code or null if none found
     */
    function lang_iso639_2b_to_1( $iso639_2b ) {
        static $language_codes = array(
            'aar'=>'aa', //Afar
            'abk'=>'ab', //Abkhazian
            'afr'=>'af', //Afrikaans
            'aka'=>'ak', //Akan
            'amh'=>'am', //Amharic
            'arg'=>'an', //Aragonese
            'ara'=>'ar', //Arabic
            'asm'=>'as', //Assamese
            'ava'=>'av', //Avaric
            'aym'=>'ay', //Aymara
            'aze'=>'az', //Azerbaijani
            'bak'=>'ba', //Bashkir
            'bel'=>'be', //Belarusian
            'bul'=>'bg', //Bulgarian
            'bis'=>'bi', //Bislama
            'bam'=>'bm', //Bambara
            'ben'=>'bn', //Bengali
            'tib'=>'bo', //Tibetan
            'bre'=>'br', //Breton
            'bos'=>'bs', //Bosnian
            'cat'=>'ca', //Catalan
            'che'=>'ce', //Chechen
            'cha'=>'ch', //Chamorro
            'cos'=>'co', //Corsican
            'cre'=>'cr', //Cree
            'cze'=>'cs', //Czech
            'chv'=>'cv', //Chuvash
            'wel'=>'cy', //Welsh
            'dan'=>'da', //Danish
            'ger'=>'de', //German
            'div'=>'dv', //Dhivehi
            'dzo'=>'dz', //Dzongkha
            'ewe'=>'ee', //Ewe
            'gre'=>'el', //Modern Greek (1453-)
            'eng'=>'en', //English
            'spa'=>'es', //Spanish
            'est'=>'et', //Estonian
            'baq'=>'eu', //Basque
            'per'=>'fa', //Persian
            'ful'=>'ff', //Fulah
            'fin'=>'fi', //Finnish
            'fij'=>'fj', //Fijian
            'fao'=>'fo', //Faroese
            'fre'=>'fr', //French
            'fry'=>'fy', //Western Frisian
            'gle'=>'ga', //Irish
            'gla'=>'gd', //Scottish Gaelic
            'glg'=>'gl', //Galician
            'grn'=>'gn', //Guarani
            'guj'=>'gu', //Gujarati
            'glv'=>'gv', //Manx
            'hau'=>'ha', //Hausa
            'heb'=>'he', //Hebrew
            'hin'=>'hi', //Hindi
            'hmo'=>'ho', //Hiri Motu
            'hrv'=>'hr', //Croatian
            'hat'=>'ht', //Haitian
            'hun'=>'hu', //Hungarian
            'arm'=>'hy', //Armenian
            'her'=>'hz', //Herero
            'ind'=>'id', //Indonesian
            'ibo'=>'ig', //Igbo
            'iii'=>'ii', //Sichuan Yi
            'ipk'=>'ik', //Inupiaq
            'ice'=>'is', //Icelandic
            'ita'=>'it', //Italian
            'iku'=>'iu', //Inuktitut
            'jpn'=>'ja', //Japanese
            'jav'=>'jv', //Javanese
            'geo'=>'ka', //Georgian
            'kon'=>'kg', //Kongo
            'kik'=>'ki', //Kikuyu
            'kua'=>'kj', //Kuanyama
            'kaz'=>'kk', //Kazakh
            'kal'=>'kl', //Kalaallisut
            'khm'=>'km', //Central Khmer
            'kan'=>'kn', //Kannada
            'kor'=>'ko', //Korean
            'kau'=>'kr', //Kanuri
            'kas'=>'ks', //Kashmiri
            'kur'=>'ku', //Kurdish
            'kom'=>'kv', //Komi
            'cor'=>'kw', //Cornish
            'kir'=>'ky', //Kirghiz
            'ltz'=>'lb', //Luxembourgish
            'lug'=>'lg', //Ganda
            'lim'=>'li', //Limburgan
            'lin'=>'ln', //Lingala
            'lao'=>'lo', //Lao
            'lit'=>'lt', //Lithuanian
            'lub'=>'lu', //Luba-Katanga
            'lav'=>'lv', //Latvian
            'mlg'=>'mg', //Malagasy
            'mah'=>'mh', //Marshallese
            'mao'=>'mi', //Maori
            'mac'=>'mk', //Macedonian
            'mal'=>'ml', //Malayalam
            'mon'=>'mn', //Mongolian
            'mar'=>'mr', //Marathi
            'may'=>'ms', //Malay (macrolanguage)
            'mlt'=>'mt', //Maltese
            'bur'=>'my', //Burmese
            'nau'=>'na', //Nauru
            'nob'=>'nb', //Norwegian BokmŒl
            'nde'=>'nd', //North Ndebele
            'nep'=>'ne', //Nepali
            'ndo'=>'ng', //Ndonga
            'dut'=>'nl', //Dutch
            'nno'=>'nn', //Norwegian Nynorsk
            'nor'=>'no', //Norwegian
            'nbl'=>'nr', //South Ndebele
            'nav'=>'nv', //Navajo
            'nya'=>'ny', //Nyanja
            'oci'=>'oc', //Occitan (post 1500)
            'oji'=>'oj', //Ojibwa
            'orm'=>'om', //Oromo
            'ori'=>'or', //Oriya
            'oss'=>'os', //Ossetian
            'pan'=>'pa', //Panjabi
            'pol'=>'pl', //Polish
            'pus'=>'ps', //Pushto
            'por'=>'pt', //Portuguese
            'que'=>'qu', //Quechua
            'roh'=>'rm', //Romansh
            'run'=>'rn', //Rundi
            'rum'=>'ro', //Romanian
            'rus'=>'ru', //Russian
            'kin'=>'rw', //Kinyarwanda
            'srd'=>'sc', //Sardinian
            'snd'=>'sd', //Sindhi
            'sme'=>'se', //Northern Sami
            'sag'=>'sg', //Sango
            'sin'=>'si', //Sinhala
            'slo'=>'sk', //Slovak
            'slv'=>'sl', //Slovenian
            'smo'=>'sm', //Samoan
            'sna'=>'sn', //Shona
            'som'=>'so', //Somali
            'alb'=>'sq', //Albanian
            'srp'=>'sr', //Serbian
            'ssw'=>'ss', //Swati
            'sot'=>'st', //Southern Sotho
            'sun'=>'su', //Sundanese
            'swe'=>'sv', //Swedish
            'swa'=>'sw', //Swahili (macrolanguage)
            'tam'=>'ta', //Tamil
            'tel'=>'te', //Telugu
            'tgk'=>'tg', //Tajik
            'tha'=>'th', //Thai
            'tir'=>'ti', //Tigrinya
            'tuk'=>'tk', //Turkmen
            'tgl'=>'tl', //Tagalog
            'tsn'=>'tn', //Tswana
            'ton'=>'to', //Tonga (Tonga Islands)
            'tur'=>'tr', //Turkish
            'tso'=>'ts', //Tsonga
            'tat'=>'tt', //Tatar
            'twi'=>'tw', //Twi
            'tah'=>'ty', //Tahitian
            'uig'=>'ug', //Uighur
            'ukr'=>'uk', //Ukrainian
            'urd'=>'ur', //Urdu
            'uzb'=>'uz', //Uzbek
            'ven'=>'ve', //Venda
            'vie'=>'vi', //Vietnamese
            'wln'=>'wa', //Walloon
            'wol'=>'wo', //Wolof
            'xho'=>'xh', //Xhosa
            'yid'=>'yi', //Yiddish
            'yor'=>'yo', //Yoruba
            'zha'=>'za', //Zhuang
            'chi'=>'zh', //Chinese
            'zul'=>'zu'  //Zulu
        );
        return $language_codes[$iso639_2b];
    }


    /**
     * Convert a dotSUB language code, similar to ISO 639-2 bibliography into its ISO 639-1 equivalent
     *
     * @link http://dev.dotsub.com/api/language List of dotSUB languages
     * @link http://www.sil.org/iso639-3/codes.asp ISO 639-2 tables
     * @param string $dotsub_language dotSUB language code
     * @return string ISO 639-1 code or null if none found
     */
    function lang_dotsub_to_rfc_1766( $dotsub_language ) {
        static $language_codes = array(
            'abk'=>'ab', //	Abkhazian
            'afr'=>'af', //	Afrikaans
            'aka'=>'ak', //	Akan
            'alb'=>'sq', //	Albanian
            'amh'=>'am', //	Amharic
            'ara'=>'ar', //	Arabic
            'arg'=>'an', //	Aragonese
            'arm'=>'hy', //	Armenian
            'asm'=>'as', //	Assamese
            'ava'=>'av', //	Avaric
            'aym'=>'ay', //	Aymara
            'aze'=>'az', //	Azerbaijani
            'bam'=>'bm', //	Bambara
            'baq'=>'eu', //	Basque
            'bel'=>'be', //	Belarusian
            'ben'=>'bn', //	Bengali
            'bos'=>'bs', //	Bosnian
            'bre'=>'br', //	Breton
            'bul'=>'bg', //	Bulgarian
            'bur'=>'my', //	Burmese
            'cat'=>'ca', //	Catalan
            'cha'=>'ch', //	Chamorro
            'che'=>'ce', //	Chechen
            'chi_hans'=>'zh-CN', //	Chinese (Simplified)
            'chi_hant'=>'zh-TW', //	Chinese (Traditional)
            'chv'=>'cv', //	Chuvash
            'cor'=>'kw', //	Cornish
            'cos'=>'co', //	Corsican
            'cre'=>'cr', //	Cree
            'cze'=>'cs', //	Czech
            'dan'=>'da', //	Danish
            'div'=>'dv', //	Dhivehi
            'dut'=>'nl', //	Dutch
            'dzo'=>'dz', //	Dzongkha
            'eng'=>'en', //	English
            'est'=>'et', //	Estonian
            'ewe'=>'ee', //	Ewe
            'fao'=>'fo', //	Faroese
            'fij'=>'fj', //	Fijian
            'fin'=>'fi', //	Finnish
            'fre_ca'=>'fr-CA', //	French (Canadian)
            'fre_fr'=>'fr-FR', //	French (French)
            'fry'=>'fy', //	Western Frisian
            'ful'=>'ff', //	Fulah
            'geo'=>'ka', //	Georgian
            'ger'=>'de', //	German
            'gla'=>'gd', //	Scottish Gaelic
            'gle'=>'ga', //	Irish
            'glg'=>'gl', //	Galician
            'glv'=>'gv', //	Manx
            'gre'=>'el', //	Modern Greek (1453-)
            'grn'=>'gn', //	Guarani
            'guj'=>'gu', //	Gujarati
            'hat'=>'ht', //	Haitian
            'hau'=>'ha', //	Hausa
            'heb'=>'he', //	Hebrew
            'her'=>'hz', //	Herero
            'hin'=>'hi', //	Hindi
            'hmo'=>'ho', //	Hiri Motu
            'hun'=>'hu', //	Hungarian
            'ibo'=>'ig', //	Igbo
            'ice'=>'is', //	Icelandic
            'iii'=>'ii', //	Sichuan Yi
            'iku'=>'iu', //	Inuktitut
            'ind'=>'id', //	Indonesian
            'ipk'=>'ik', //	Inupiaq
            'ita'=>'it', //	Italian
            'jav'=>'jv', //	Javanese
            'jpn'=>'ja', //	Japanese
            'kal'=>'kl', //	Kalaallisut
            'kan'=>'kn', //	Kannada
            'kas'=>'ks', //	Kashmiri
            'kau'=>'kr', //	Kanuri
            'kaz'=>'kk', //	Kazakh
            'khm'=>'km', //	Central Khmer
            'kik'=>'ki', //	Kikuyu
            'kin'=>'rw', //	Kinyarwanda
            'kir'=>'ky', //	Kirghiz
            'kom'=>'kv', //	Komi
            'kon'=>'kg', //	Kongo
            'kor'=>'ko', //	Korean
            'kua'=>'kj', //	Kuanyama
            'kur'=>'ku', //	Kurdish
            'lao'=>'lo', //	Lao
            'lav'=>'lv', //	Latvian
            'lim'=>'li', //	Limburgan
            'lin'=>'ln', //	Lingala
            'lit'=>'lt', //	Lithuanian
            'ltz'=>'lb', //	Luxembourgish
            'lub'=>'lu', //	Luba-Katanga
            'lug'=>'lg', //	Ganda
            'mac'=>'mk', //	Macedonian
            'mah'=>'mh', //	Marshallese
            'mal'=>'ml', //	Malayalam
            'mao'=>'mi', //	Maori
            'mar'=>'mr', //	Marathi
            'may'=>'ms', //	Malay (macrolanguage)
            'mlg'=>'mg', //	Malagasy
            'mlt'=>'mt', //	Maltese
            'mon'=>'mn', //	Mongolian
            'nau'=>'na', //	Nauru
            'nav'=>'nv', //	Navajo
            'nbl'=>'nr', //	South Ndebele
            'nde'=>'nd', //	North Ndebele
            'ndo'=>'ng', //	Ndonga
            'nep'=>'ne', //	Nepali
            'nob'=>'nb', //	Norwegian BokmŒl
            'nor'=>'no', //	Norwegian
            'nya'=>'ny', //	Nyanja
            'oci'=>'oc', //	Occitan (post 1500)
            'oji'=>'oj', //	Ojibwa
            'ori'=>'or', //	Oriya
            'orm'=>'om', //	Oromo
            'oss'=>'os', //	Ossetian
            'pan'=>'pa', //	Panjabi
            'per'=>'fa', //	Persian
            'pol'=>'pl', //	Polish
            'por_br'=>'pt-BR', //	Portuguese (Brazil)
            'por_pt'=>'pt-PT', //	Portuguese (Portugal)
            'pus'=>'ps', //	Pushto
            'que'=>'qu', //	Quechua
            'roh'=>'rm', //	Romansh
            'rum'=>'ro', //	Romanian
            'run'=>'rn', //	Rundi
            'rus'=>'ru', //	Russian
            'sag'=>'sg', //	Sango
            'sin'=>'si', //	Sinhala
            'slo'=>'sk', //	Slovak
            'slv'=>'sl', //	Slovenian
            'sme'=>'se', //	Northern Sami
            'smo'=>'sm', //	Samoan
            'sna'=>'sn', //	Shona
            'snd'=>'sd', //	Sindhi
            'som'=>'so', //	Somali
            'sot'=>'st', //	Southern Sotho
            'spa'=>'es', //	Spanish
            'srd'=>'sc', //	Sardinian
            'ssw'=>'ss', //	Swati
            'sun'=>'su', //	Sundanese
            'swa'=>'sw', //	Swahili (macrolanguage)
            'swe'=>'sv', //	Swedish
            'tah'=>'ty', //	Tahitian
            'tam'=>'ta', //	Tamil
            'tat'=>'tt', //	Tatar
            'tel'=>'te', //	Telugu
            'tgk'=>'tg', //	Tajik
            'tgl'=>'tl', //	Tagalog
            'tha'=>'th', //	Thai
            'tib'=>'bo', //	Tibetan
            'tir'=>'ti', //	Tigrinya
            'ton'=>'to', //	Tonga (Tonga Islands)
            'tsn'=>'tn', //	Tswana
            'tso'=>'ts', //	Tsonga
            'tuk'=>'tk', //	Turkmen
            'tur'=>'tr', //	Turkish
            'twi'=>'tw', //	Twi
            'uig'=>'ug', //	Uighur
            'ukr'=>'uk', //	Ukrainian
            'urd'=>'ur', //	Urdu
            'uzb'=>'uz', //	Uzbek
            'ven'=>'ve', //	Venda
            'vie'=>'vi', //	Vietnamese
            'wel'=>'cy', //	Welsh
            'wln'=>'wa', //	Walloon
            'wol'=>'wo', //	Wolof
            'xho'=>'xh', //	Xhosa
            'yid'=>'yi', //	Yiddish
            'yor'=>'yo', //	Yoruba
            'zha'=>'za', //	Zhuang
            'zul'=>'zu' //	Zulu
        );
        return $language_codes[$dotsub_language];
    }


    /**
     * Convert a RFC 1766 lang (ISO 639-2 langauge code with optional ISO 3166 country localization) into dotSUB's language code.
     *
     * @link http://dev.dotsub.com/api/language List of dotSUB languages
     * @param string $language RFC 1766 language (ex: en, fr-CA)
     * @return string dotSUB language code or null if not found.
     */
    function lang_rfc_1766_to_dotsub( $language ) {
        static $language_codes = array(
            'ab'=>'abk', //	Abkhazian
            'af'=>'afr', //	Afrikaans
            'ak'=>'aka', //	Akan
            'sq'=>'alb', //	Albanian
            'am'=>'amh', //	Amharic
            'ar'=>'ara', //	Arabic
            'an'=>'arg', //	Aragonese
            'hy'=>'arm', //	Armenian
            'as'=>'asm', //	Assamese
            'av'=>'ava', //	Avaric
            'ay'=>'aym', //	Aymara
            'az'=>'aze', //	Azerbaijani
            'bm'=>'bam', //	Bambara
            'eu'=>'baq', //	Basque
            'be'=>'bel', //	Belarusian
            'bn'=>'ben', //	Bengali
            'bs'=>'bos', //	Bosnian
            'br'=>'bre', //	Breton
            'bg'=>'bul', //	Bulgarian
            'my'=>'bur', //	Burmese
            'ca'=>'cat', //	Catalan
            'ch'=>'cha', //	Chamorro
            'ce'=>'che', //	Chechen
            'zh-CN'=>'chi_hans', //	Chinese (Simplified)
            'zh-TW'=>'chi_hant', //	Chinese (Traditional)
            'cv'=>'chv', //	Chuvash
            'kw'=>'cor', //	Cornish
            'co'=>'cos', //	Corsican
            'cr'=>'cre', //	Cree
            'cs'=>'cze', //	Czech
            'da'=>'dan', //	Danish
            'dv'=>'div', //	Dhivehi
            'nl'=>'dut', //	Dutch
            'dz'=>'dzo', //	Dzongkha
            'en'=>'eng', //	English
            'et'=>'est', //	Estonian
            'ee'=>'ewe', //	Ewe
            'fo'=>'fao', //	Faroese
            'fj'=>'fij', //	Fijian
            'fi'=>'fin', //	Finnish
            'fr-CA'=>'fre_ca', //	French (Canadian)
            'fr-FR'=>'fre_fr', //	French (French)
            'fy'=>'fry', //	Western Frisian
            'ff'=>'ful', //	Fulah
            'ka'=>'geo', //	Georgian
            'de'=>'ger', //	German
            'gd'=>'gla', //	Scottish Gaelic
            'ga'=>'gle', //	Irish
            'gl'=>'glg', //	Galician
            'gv'=>'glv', //	Manx
            'el'=>'gre', //	Modern Greek (1453-)
            'gn'=>'grn', //	Guarani
            'gu'=>'guj', //	Gujarati
            'ht'=>'hat', //	Haitian
            'ha'=>'hau', //	Hausa
            'he'=>'heb', //	Hebrew
            'hz'=>'her', //	Herero
            'hi'=>'hin', //	Hindi
            'ho'=>'hmo', //	Hiri Motu
            'hu'=>'hun', //	Hungarian
            'ig'=>'ibo', //	Igbo
            'is'=>'ice', //	Icelandic
            'ii'=>'iii', //	Sichuan Yi
            'iu'=>'iku', //	Inuktitut
            'id'=>'ind', //	Indonesian
            'ik'=>'ipk', //	Inupiaq
            'it'=>'ita', //	Italian
            'jv'=>'jav', //	Javanese
            'ja'=>'jpn', //	Japanese
            'kl'=>'kal', //	Kalaallisut
            'kn'=>'kan', //	Kannada
            'ks'=>'kas', //	Kashmiri
            'kr'=>'kau', //	Kanuri
            'kk'=>'kaz', //	Kazakh
            'km'=>'khm', //	Central Khmer
            'ki'=>'kik', //	Kikuyu
            'rw'=>'kin', //	Kinyarwanda
            'ky'=>'kir', //	Kirghiz
            'kv'=>'kom', //	Komi
            'kg'=>'kon', //	Kongo
            'ko'=>'kor', //	Korean
            'kj'=>'kua', //	Kuanyama
            'ku'=>'kur', //	Kurdish
            'lo'=>'lao', //	Lao
            'lv'=>'lav', //	Latvian
            'li'=>'lim', //	Limburgan
            'ln'=>'lin', //	Lingala
            'lt'=>'lit', //	Lithuanian
            'lb'=>'ltz', //	Luxembourgish
            'lu'=>'lub', //	Luba-Katanga
            'lg'=>'lug', //	Ganda
            'mk'=>'mac', //	Macedonian
            'mh'=>'mah', //	Marshallese
            'ml'=>'mal', //	Malayalam
            'mi'=>'mao', //	Maori
            'mr'=>'mar', //	Marathi
            'ms'=>'may', //	Malay (macrolanguage)
            'mg'=>'mlg', //	Malagasy
            'mt'=>'mlt', //	Maltese
            'mn'=>'mon', //	Mongolian
            'na'=>'nau', //	Nauru
            'nv'=>'nav', //	Navajo
            'nr'=>'nbl', //	South Ndebele
            'nd'=>'nde', //	North Ndebele
            'ng'=>'ndo', //	Ndonga
            'ne'=>'nep', //	Nepali
            'nb'=>'nob', //	Norwegian BokmŒl
            'no'=>'nor', //	Norwegian
            'ny'=>'nya', //	Nyanja
            'oc'=>'oci', //	Occitan (post 1500)
            'oj'=>'oji', //	Ojibwa
            'or'=>'ori', //	Oriya
            'om'=>'orm', //	Oromo
            'os'=>'oss', //	Ossetian
            'pa'=>'pan', //	Panjabi
            'fa'=>'per', //	Persian
            'pl'=>'pol', //	Polish
            'pt-BR'=>'por_br', //	Portuguese (Brazil)
            'pt-PT'=>'por_pt', //	Portuguese (Portugal)
            'ps'=>'pus', //	Pushto
            'qu'=>'que', //	Quechua
            'rm'=>'roh', //	Romansh
            'ro'=>'rum', //	Romanian
            'rn'=>'run', //	Rundi
            'ru'=>'rus', //	Russian
            'sg'=>'sag', //	Sango
            'si'=>'sin', //	Sinhala
            'sk'=>'slo', //	Slovak
            'sl'=>'slv', //	Slovenian
            'se'=>'sme', //	Northern Sami
            'sm'=>'smo', //	Samoan
            'sn'=>'sna', //	Shona
            'sd'=>'snd', //	Sindhi
            'so'=>'som', //	Somali
            'st'=>'sot', //	Southern Sotho
            'es'=>'spa', //	Spanish
            'sc'=>'srd', //	Sardinian
            'ss'=>'ssw', //	Swati
            'su'=>'sun', //	Sundanese
            'sw'=>'swa', //	Swahili (macrolanguage)
            'sv'=>'swe', //	Swedish
            'ty'=>'tah', //	Tahitian
            'ta'=>'tam', //	Tamil
            'tt'=>'tat', //	Tatar
            'te'=>'tel', //	Telugu
            'tg'=>'tgk', //	Tajik
            'tl'=>'tgl', //	Tagalog
            'th'=>'tha', //	Thai
            'bo'=>'tib', //	Tibetan
            'ti'=>'tir', //	Tigrinya
            'to'=>'ton', //	Tonga (Tonga Islands)
            'tn'=>'tsn', //	Tswana
            'ts'=>'tso', //	Tsonga
            'tk'=>'tuk', //	Turkmen
            'tr'=>'tur', //	Turkish
            'tw'=>'twi', //	Twi
            'ug'=>'uig', //	Uighur
            'uk'=>'ukr', //	Ukrainian
            'ur'=>'urd', //	Urdu
            'uz'=>'uzb', //	Uzbek
            've'=>'ven', //	Venda
            'vi'=>'vie', //	Vietnamese
            'cy'=>'wel', //	Welsh
            'wa'=>'wln', //	Walloon
            'wo'=>'wol', //	Wolof
            'xh'=>'xho', //	Xhosa
            'yi'=>'yid', //	Yiddish
            'yo'=>'yor', //	Yoruba
            'za'=>'zha', //	Zhuang
            'zu'=>'zul'  //	Zulu
        );
        return $language_codes[$language];
    }
}