<?php

declare(strict_types=1);

/*
 * This file is part of contao download statistics.
 *
 * (c) Kirsten Roschanski 2024 <github@kirsten-rocshanski.de>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/kirsten-roschanski/contao-download-statistics
 */

namespace KirstenRoschanski\ContaoDSBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use ErdmannFreunde\ContaoGridBundle\ContaoGridBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create('KirstenRoschanski\ContaoDSBundle\CDSBundle')
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    ErdmannFreundeContaoGridBundle::class,
                ]),
        ];
    }
}
