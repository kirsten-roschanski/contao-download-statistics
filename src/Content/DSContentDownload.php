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

use Contao\ContentDownload;
use Contao\Database;
use Contao\FilesModel;
use Contao\FrontendUser;
use Contao\Input;

class DSContentDownload extends ContentDownload
{	
    public function generate()
    {   
        // Get the file model
        $objFile = FilesModel::findByUuid($this->singleSRC);

        // Check if the download link was clicked
        if (Input::get('file') && Input::get('file') === $objFile->path) {

            // Get the current user
            $user = FrontendUser::getInstance();
            
            // Determine the member ID or set to 0 for guests
            $memberId = $user->id ?? 0;

            // Insert the download statistic
            Database::getInstance()->prepare("INSERT INTO tl_download_statistic (tstamp, member, file, username, email) VALUES (?, ?, ?, ?, ?)")
                ->execute(time(), $memberId, $objFile->uuid, $memberId, $memberId);
        }

        // Call the parent method to handle the actual download
        return parent::generate();
    }
}