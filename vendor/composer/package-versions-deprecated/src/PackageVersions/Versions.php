<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'laravel/laravel';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'botman/botman' => '2.6.1@127f7dc0aef5bc0561f8a2a8a3b246fe951b63e7',
  'box/spout' => 'v3.3.0@9bdb027d312b732515b884a341c0ad70372c6295',
  'composer/package-versions-deprecated' => '1.11.99.2@c6522afe5540d5fc46675043d3ed5a45a740b27c',
  'dnoegel/php-xdg-base-dir' => 'v0.1.1@8f8a6e48c5ecb0f991c2fdcf5f154a47d85f9ffd',
  'doctrine/annotations' => '1.13.1@e6e7b7d5b45a2f2abc5460cc6396480b2b1d321f',
  'doctrine/cache' => '1.11.3@3bb5588cec00a0268829cc4a518490df6741af9d',
  'doctrine/collections' => '1.6.7@55f8b799269a1a472457bd1a41b4f379d4cfba4a',
  'doctrine/common' => 'v2.7.3@4acb8f89626baafede6ee5475bc5844096eba8a9',
  'doctrine/dbal' => 'v2.5.13@729340d8d1eec8f01bff708e12e449a3415af873',
  'doctrine/inflector' => '1.4.4@4bd5c1cdfcd00e9e2d8c484f79150f67e5d355d9',
  'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042',
  'erusev/parsedown' => '1.7.4@cb17b6477dfff935958ba01325f2e8a2bfa6dab3',
  'evenement/evenement' => 'v3.0.1@531bfb9d15f8aa57454f5f0285b18bec903b8fb7',
  'facebook/graph-sdk' => '5.7.0@2d8250638b33d73e7a87add65f47fabf91f8ad9b',
  'graham-campbell/exceptions' => 'v10.1.0@aa191a1d5489c6243bd0533aac3d1004bf56ddd3',
  'guzzlehttp/guzzle' => '6.5.5@9d4290de1cfd701f38099ef7e183b64b4b7b0c5e',
  'guzzlehttp/oauth-subscriber' => '0.3.0@04960cdef3cd80ea401d6b0ca8b3e110e9bf12cf',
  'guzzlehttp/promises' => '1.4.1@8e7d04f1f6450fef59366c399cfad4b9383aa30d',
  'guzzlehttp/psr7' => '1.8.2@dc960a912984efb74d0a90222870c72c87f10c91',
  'intervention/image' => '2.5.1@abbf18d5ab8367f96b3205ca3c89fb2fa598c69e',
  'jakub-onderka/php-console-color' => 'v0.2@d5deaecff52a0d61ccb613bb3804088da0307191',
  'jakub-onderka/php-console-highlighter' => 'v0.4@9f7a229a69d52506914b4bc61bfdb199d90c5547',
  'jaybizzle/crawler-detect' => 'v1.2.106@78bf6792cbf9c569dc0bf2465481978fd2ed0de9',
  'jeremeamia/superclosure' => '2.4.0@5707d5821b30b9a07acfb4d76949784aaa0e9ce9',
  'kitetail/zttp' => 'v0.6.0@92662d7f9025b4c9a0b8a585e31810461fcca435',
  'kryptonit3/counter' => '5.2.11@aa69e6ce54a5d1d9009d861e0b7ed725c29fb965',
  'kylekatarnls/update-helper' => '1.2.1@429be50660ed8a196e0798e5939760f168ec8ce9',
  'lab404/laravel-impersonate' => '1.1.1@125043cd0f46adee02fb06d5451d9659e3325259',
  'laminas/laminas-diactoros' => '2.6.0@7d2034110ae18afe05050b796a3ee4b3fe177876',
  'laminas/laminas-zendframework-bridge' => '1.3.0@13af2502d9bb6f7d33be2de4b51fb68c6cdb476e',
  'laracasts/utilities' => '3.2@26b1712166a366e3f8a1fd1452d0c3b76cad612a',
  'laravel/framework' => 'v5.4.36@1062a22232071c3e8636487c86ec1ae75681bbf9',
  'laravel/socialite' => 'v3.4.0@28368c6fc6580ca1860f9b9a7f8deac1aa7d515a',
  'laravel/tinker' => 'v1.0.10@ad571aacbac1539c30d480908f9d0c9614eaf1a7',
  'laravelcollective/html' => 'v5.4.9@f04965dc688254f4c77f684ab0b42264f9eb9634',
  'lcobucci/clock' => '2.0.0@353d83fe2e6ae95745b16b3d911813df6a05bfb3',
  'lcobucci/jwt' => '4.0.3@ae4165a76848e070fdac691e773243d10cd06ce1',
  'league/flysystem' => '1.1.4@f3ad69181b8afed2c9edf7be5a2918144ff4ea32',
  'league/mime-type-detection' => '1.7.0@3b9dff8aaf7323590c1d2e443db701eb1f9aa0d3',
  'league/oauth1-client' => 'v1.9.0@1e7e6be2dc543bf466236fb171e5b20e1b06aee6',
  'lomotech/driver-telegram' => '1.5.2@32ed131c73ee09791e320557340e663d90d7b45d',
  'maatwebsite/excel' => '2.1.30@f5540c4ba3ac50cebd98b09ca42e61f926ef299f',
  'mews/captcha' => '2.3.0@2c9efa19d7d7ae56bed5f23e1c4c42ea5d01fc1a',
  'monolog/monolog' => '1.26.1@c6b00f05152ae2c9b04a448f99c7590beb6042f5',
  'mpdf/mpdf' => 'v6.1.3@7f138bf7508eac895ac2c13d2509b056ac7e7e97',
  'mpociot/pipeline' => '1.0.2@3584db4a0de68067b2b074edfadf6a48b5603a6b',
  'mtdowling/cron-expression' => 'v1.2.3@9be552eebcc1ceec9776378f7dcc085246cacca6',
  'nesbot/carbon' => '1.39.1@4be0c005164249208ce1b5ca633cd57bdd42ff33',
  'nexmo/client' => '2.0.0@664082abac14f6ab9ceec9abaf2e00aeb7c17333',
  'nexmo/client-core' => '2.9.2@5feed4876c603423c52eb751d1b46de9d60d1ceb',
  'nikic/php-parser' => 'v4.10.5@4432ba399e47c66624bc73c8c0f811e5c109576f',
  'niklasravnsborg/laravel-pdf' => 'v1.5.0@68a24e8ddc0b981f41b9b80dcae5ee3466a0a998',
  'opis/closure' => '3.6.2@06e2ebd25f2869e54a306dda991f7db58066f7f6',
  'orangehill/iseed' => 'v2.6.1@360ba1314e1dc950438bbb8006fc220de47dca00',
  'paragonie/random_compat' => 'v2.0.20@0f1f60250fccffeaf5dda91eea1c018aed1adc2a',
  'pclzip/pclzip' => '2.8.2@19dd1de9d3f5fc4d7d70175b4c344dee329f45fd',
  'php-http/guzzle6-adapter' => 'v2.0.2@9d1a45eb1c59f12574552e81fb295e9e53430a56',
  'php-http/httplug' => '2.2.0@191a0a1b41ed026b717421931f8d3bd2514ffbf9',
  'php-http/promise' => '1.1.0@4c4c1f9b7289a2ec57cde7f1e9762a5789506f88',
  'phpoffice/common' => '0.2.9@edb5d32b1e3400a35a5c91e2539ed6f6ce925e4d',
  'phpoffice/phpexcel' => '1.8.2@1441011fb7ecdd8cc689878f54f8b58a6805f870',
  'phpoffice/phpword' => 'v0.14.0@b614497ae6dd44280be1c2dda56772198bcd25ae',
  'predis/predis' => 'v1.1.7@b240daa106d4e02f0c5b7079b41e31ddf66fddf8',
  'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8',
  'psr/container' => '1.1.1@8622567409010282b7aeebe4bb841fe98b58dcaf',
  'psr/http-client' => '1.0.1@2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'psy/psysh' => 'v0.9.12@90da7f37568aee36b116a030c5f99c915267edd4',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/uuid' => '3.9.3@7e1633a6964b48589b142d60542f9ed31bd37a92',
  'react/cache' => 'v1.1.1@4bf736a2cccec7298bdf745db77585966fc2ca7e',
  'react/dns' => 'v1.7.0@a45784faebf8fbd59058fad2d8497f71a787d20c',
  'react/event-loop' => 'v1.1.1@6d24de090cd59cfc830263cfba965be77b563c13',
  'react/promise' => 'v2.8.0@f3cff96a19736714524ca0dd1d4130de73dbbbc4',
  'react/promise-timer' => 'v1.6.0@daee9baf6ef30c43ea4c86399f828bb5f558f6e6',
  'react/socket' => 'v1.7.0@5d39e3fa56ea7cc443c86f2788a40867cdba1659',
  'react/stream' => 'v1.1.1@7c02b510ee3f582c810aeccd3a197b9c2f52ff1a',
  'setasign/fpdi' => '1.6.2@a6ad58897a6d97cc2d2cd2adaeda343b25a368ea',
  'socialiteproviders/instagram' => 'v3.0.0@054dc7c8d2e4cf80e94321ee6fe316d0ef78a7f6',
  'socialiteproviders/manager' => 'v3.5@7a5872d9e4b22bb26ecd0c69ea9ddbaad8c0f570',
  'spatie/db-dumper' => '1.5.1@efdf41891a9dd4bb63fb6253044c9e51f34fff41',
  'spatie/laravel-backup' => '3.11.0@2382532ce52e3929ccb0e930539d14dfd09d22eb',
  'spatie/macroable' => '1.0.1@7a99549fc001c925714b329220dea680c04bfa48',
  'swiftmailer/swiftmailer' => 'v5.4.12@181b89f18a90f8925ef805f950d47a7190e9b950',
  'symfony/console' => 'v3.4.47@a10b1da6fc93080c180bba7219b5ff5b7518fe81',
  'symfony/css-selector' => 'v5.3.0@fcd0b29a7a0b1bb5bfbedc6231583d77fea04814',
  'symfony/debug' => 'v3.4.47@ab42889de57fdfcfcc0759ab102e2fd4ea72dcae',
  'symfony/event-dispatcher' => 'v4.4.25@047773e7016e4fd45102cedf4bd2558ae0d0c32f',
  'symfony/event-dispatcher-contracts' => 'v1.1.9@84e23fdcd2517bf37aecbd16967e83f0caee25a7',
  'symfony/finder' => 'v3.4.47@b6b6ad3db3edb1b4b1c1896b1975fb684994de6e',
  'symfony/http-foundation' => 'v3.4.47@b9885fcce6fe494201da4f70a9309770e9d13dc8',
  'symfony/http-kernel' => 'v3.4.49@5aa72405f5bd5583c36ed6e756acb17d3f98ac40',
  'symfony/polyfill-ctype' => 'v1.23.0@46cd95797e9df938fdd2b03693b5fca5e64b01ce',
  'symfony/polyfill-intl-idn' => 'v1.23.0@65bd267525e82759e7d8c4e8ceea44f398838e65',
  'symfony/polyfill-intl-normalizer' => 'v1.23.0@8590a5f561694770bdcd3f9b5c69dde6945028e8',
  'symfony/polyfill-mbstring' => 'v1.23.0@2df51500adbaebdc4c38dea4c89a2e131c45c8a1',
  'symfony/polyfill-php56' => 'v1.20.0@54b8cd7e6c1643d78d011f3be89f3ef1f9f4c675',
  'symfony/polyfill-php70' => 'v1.20.0@5f03a781d984aae42cebd18e7912fa80f02ee644',
  'symfony/polyfill-php72' => 'v1.23.0@9a142215a36a3888e30d0a9eeea9766764e96976',
  'symfony/process' => 'v3.4.47@b8648cf1d5af12a44a51d07ef9bf980921f15fca',
  'symfony/routing' => 'v3.4.47@3e522ac69cadffd8131cc2b22157fa7662331a6c',
  'symfony/translation' => 'v4.3.11@46e462be71935ae15eab531e4d491d801857f24c',
  'symfony/translation-contracts' => 'v1.1.10@84180a25fad31e23bebd26ca09d89464f082cacc',
  'symfony/var-dumper' => 'v3.4.47@0719f6cf4633a38b2c1585140998579ce23b4b7d',
  'tijsverkoyen/css-to-inline-styles' => '2.2.3@b43b05cf43c1b6d849478965062b6ef73e223bb5',
  'vlucas/phpdotenv' => 'v2.6.7@b786088918a884258c9e3e27405c6a4cf2ee246e',
  'vonage/nexmo-bridge' => '0.1.0@62653b1165f4401580ca8d2b859f59c968de3711',
  'webklex/laravel-imap' => '1.6.2@310f4630ce792fdde388e2a850a1769853241a33',
  'xethron/laravel-4-generators' => '3.1.1@526f0a07d8ae44e365a20b1bf64c9956acd2a859',
  'xethron/migrations-generator' => 'v2.0.2@a05bd7319ed808fcc3125212e37d30ccbe0d2b8b',
  'yajra/laravel-datatables-oracle' => 'v8.3.1@b5ecb425414b1baf2ce2f82fe2849e77e51230e0',
  'zendframework/zend-escaper' => '2.6.1@3801caa21b0ca6aca57fa1c42b08d35c395ebd5f',
  'zendframework/zend-stdlib' => '3.2.1@66536006722aff9e62d1b331025089b7ec71c065',
  'barryvdh/laravel-ide-helper' => 'v2.4.3@5c304db44fba8e9c4aa0c09739e59f7be7736fdd',
  'barryvdh/reflection-docblock' => 'v2.0.6@6b69015d83d3daf9004a71a89f26e27d27ef6a16',
  'doctrine/instantiator' => '1.4.0@d56bf6102915de5702778fe20f2de3b2fe570b5b',
  'filp/whoops' => '2.13.0@2edbc73a4687d9085c8f20f398eebade844e8424',
  'fzaninotto/faker' => 'v1.9.2@848d8125239d7dbf8ab25cb7f054f1a630e68c2e',
  'hamcrest/hamcrest-php' => 'v1.2.2@b37020aa976fa52d3de9aa904aa2522dc518f79c',
  'mockery/mockery' => '0.9.11@be9bf28d8e57d67883cba9fcadfcff8caab667f8',
  'myclabs/deep-copy' => '1.10.2@776f831124e9c62e1a2c601ecc52e776d8bb7220',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.2.2@069a785b2141f5bcf49f3e353548dc1cce6df556',
  'phpdocumentor/type-resolver' => '1.4.0@6a467b8989322d92aa1c8bf2bebcc6e5c2ba55c0',
  'phpspec/prophecy' => 'v1.10.3@451c3cd1418cf640de218914901e51b064abb093',
  'phpunit/php-code-coverage' => '4.0.8@ef7b2f56815df854e66ceaee8ebe9393ae36a40d',
  'phpunit/php-file-iterator' => '1.4.5@730b01bc3e867237eaac355e06a36b85dd93a8b4',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '1.0.9@3dcf38ca72b158baf0bc245e9184d3fdffa9c46f',
  'phpunit/php-token-stream' => '2.0.2@791198a2c6254db10131eecfe8c06670700904db',
  'phpunit/phpunit' => '5.7.27@b7803aeca3ccb99ad0a506fa80b64cd6a56bbc0c',
  'phpunit/phpunit-mock-objects' => '3.4.4@a23b761686d50a560cc56233b9ecf49597cc9118',
  'sebastian/code-unit-reverse-lookup' => '1.0.2@1de8cd5c010cb153fcd68b8d0f64606f523f7619',
  'sebastian/comparator' => '1.2.4@2b7424b55f5047b47ac6e5ccb20b2aea4011d9be',
  'sebastian/diff' => '1.4.3@7f066a26a962dbe58ddea9f72a4e82874a3975a4',
  'sebastian/environment' => '2.0.0@5795ffe5dc5b02460c3e34222fee8cbe245d8fac',
  'sebastian/exporter' => '2.0.0@ce474bdd1a34744d7ac5d6aad3a46d48d9bac4c4',
  'sebastian/global-state' => '1.1.1@bc37d50fea7d017d3d340f230811c9f1d7280af4',
  'sebastian/object-enumerator' => '2.0.1@1311872ac850040a79c3c058bea3e22d0f09cbb7',
  'sebastian/recursion-context' => '2.0.0@2c3ba150cbec723aa057506e73a8d33bdb286c9a',
  'sebastian/resource-operations' => '1.0.0@ce990bb21759f94aeafd30209e8cfcdfa8bc3f52',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'symfony/class-loader' => 'v3.4.47@a22265a9f3511c0212bf79f54910ca5a77c0e92c',
  'symfony/yaml' => 'v4.4.25@81cdac5536925c1c4b7b50aabc9ff6330b9eb5fc',
  'webmozart/assert' => '1.10.0@6964c76c7804814a842473e0c8fd15bab0f18e25',
  'laravel/laravel' => 'dev-master@395e7cf43b97d198676baa6d92d4902323a3d738',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!class_exists(InstalledVersions::class, false) || !(method_exists(InstalledVersions::class, 'getAllRawData') ? InstalledVersions::getAllRawData() : InstalledVersions::getRawData())) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (class_exists(InstalledVersions::class, false) && (method_exists(InstalledVersions::class, 'getAllRawData') ? InstalledVersions::getAllRawData() : InstalledVersions::getRawData())) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}
