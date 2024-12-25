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

namespace KirstenRoschanski\ContaoDSBundle\Module;

use Contao\BackendModule;
use Contao\Database;
use Contao\BackendTemplate;
use Contao\FilesModel;

class ShowGraph extends BackendModule
{
    protected $strTemplate = 'be_show_graph';

    protected function compile(): void
    {
        // Fetch download statistics from the database
        $objDownloads = Database::getInstance()->execute("SELECT file, COUNT(*) AS download_count FROM tl_download_statistic GROUP BY file");

        // Prepare data for Chart.js
        $data = [];
        while ($objDownloads->next()) {
            // Get file information
            $file = FilesModel::findByUuid($objDownloads->file);
            $fileName = $file ? $file->name : 'Unknown';

            $data[] = [
                'file' => $fileName,
                'download_count' => $objDownloads->download_count
            ];
        }

        // Pass data to the template
        $this->Template->data = json_encode($data);
    }
}