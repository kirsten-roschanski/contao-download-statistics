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

namespace KirstenRoschanski\ContaoDSBundle\Content;

use Contao\ContentDownloads;
use Contao\Database;
use Contao\FilesModel;
use Contao\FrontendUser;
use Contao\Input;
use Contao\StringUtil;

class DSContentDownloads extends ContentDownloads
{	
    public function generate()
    {   
        $this->multiSRC = StringUtil::deserialize($this->multiSRC);

        // Get the file model
        $this->objFiles = FilesModel::findMultipleByUuids($this->multiSRC);

        // Check if the download link was clicked
        while ($this->objFiles->next())
		{
            if (Input::get('file') && Input::get('file') === $this->objFiles->path) {

                // Get the current user
                $user = FrontendUser::getInstance();
                
                // Determine the member ID or set to 0 for guests
                $memberId = $user->id ?? 0;

                // Insert the download statistic
                Database::getInstance()->prepare("INSERT INTO tl_download_statistic (tstamp, member, file, username, email) VALUES (?, ?, ?, ?, ?)")
                    ->execute(time(), $memberId, $this->objFiles->uuid, $memberId, $memberId);
            }
        }

        // Call the parent method to handle the actual download
        return parent::generate();
    }
}