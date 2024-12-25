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


 
 /**
 * Backend modules
 */
$GLOBALS['BE_MOD']['system']['download_statistic'] = [
    'tables' => ['tl_download_statistic'],
    'showGraph' => ['KirstenRoschanski\ContaoDSBundle\Module\ShowGraph', 'generate']    
];

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['files']['download'] = 'KirstenRoschanski\ContaoDSBundle\Content\DSContentDownload';
$GLOBALS['TL_CTE']['files']['downloads'] = 'KirstenRoschanski\ContaoDSBundle\Content\DSContentDownloads';

/**
 * Frontend modules
 */
$GLOBALS['FE_MOD']['downloads']['memberDownloads'] = 'KirstenRoschanski\ContaoDSBundle\Module\ModuleMemberDownloads';