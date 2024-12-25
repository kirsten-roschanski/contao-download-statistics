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

use Contao\Module;
use Contao\Database;
use Contao\FrontendTemplate;
use Contao\MemberModel;
use Contao\FilesModel;
use Contao\FrontendUser;

class ModuleMemberDownloads extends Module
{
    protected $strTemplate = 'mod_member_downloads';

    protected function compile(): void
    {
        // Get the current user
        $user = FrontendUser::getInstance();

        // Check if the user is logged in
        if (!$user->id) {
            $this->Template->data = [];
            return;
        }

        // Fetch download statistics for the logged-in member from the database
        $objDownloads = Database::getInstance()->prepare("SELECT file, tstamp FROM tl_download_statistic WHERE member=? ORDER BY tstamp DESC")
                                               ->execute($user->id);

        // Prepare data
        $data = [];
        while ($objDownloads->next()) {
            // Get file information
            $file = FilesModel::findByUuid($objDownloads->file);
            $fileName = $file ? $file->name : 'Unknown';

            $data[] = [
                'file' => $fileName,
                'tstamp' => date('Y-m-d H:i:s', $objDownloads->tstamp)
            ];
        }

        // Pass data to the template
        $this->Template->data = $data;
    }
}