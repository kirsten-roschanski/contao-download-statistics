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

use Contao\Backend;
use Contao\DataContainer;
use Contao\DC_Table;
use Contao\System;
use Contao\Database;
use Contao\FilesModel;
use Contao\MemberModel;
use Contao\Date;
use Contao\Config;

 /**
 * Table tl_download_statistic
 */
$GLOBALS['TL_DCA']['tl_download_statistic'] = array
(

    // Config
    'config' => array
    (
		'dataContainer'               => DC_Table::class,
		'closed'                      => true,
		'notEditable'                 => true,
		'notCopyable'                 => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
				'tstamp' => 'index',
                'member' => 'index'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => DataContainer::MODE_SORTABLE,
			'fields'                  => array('tstamp', 'id'),
			'panelLayout'             => 'filter;sort,search,limit',
			'defaultSearchField'      => 'text'
        ),
        'label' => array
        (
            'fields'                  => array('member', 'file'),
            'format'                  => '%s hat %s heruntergeladen.',
            'label_callback'          => array('tl_download_statistic', 'generateLabel')
        ),
        'operations' => array
        (
            'delete',
            'show'
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
            ),        
            'showGraph' => array
            (
                'href'                => 'key=showGraph',
                'icon'                => 'bundles/contaods/images/icon.png',
                'attributes'          => 'onclick="Backend.getScrollOffset();"'
            )

        )        
    ),

    //Palettes
    'palettes' => array
    (
        'default'                     => '{download_legend},member,file,username,email'
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
			'flag'                    => 12,
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => DataContainer::SORT_DAY_DESC,
			'sql'                     => "int(10) unsigned NOT NULL default 0"
        ),
        'member' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'foreignKey'              => 'tl_member.id',
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'label_callback'          => array('tl_download_statistic', 'getMemberLabel')
        ),
        'username' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'foreignKey'              => 'tl_member.username',
            'sql'                     => "varchar(64) BINARY NULL"
        ),
        'email' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'foreignKey'              => 'tl_member.email',
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'file' => array
        (
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'fileTree',
            'sql'                     => "binary(16) NULL"
        )
    )
);

class tl_download_statistic extends Backend
{
    public function generateLabel($row, $label, DataContainer $dc, $args)
    {
        $member = MemberModel::findByPk($row['member']);
        $file = FilesModel::findByUuid($row['file']);
        $args[0] = $member->firstname . ' ' . $member->lastname;
        $args[1] = $file->path;
        return vsprintf($GLOBALS['TL_DCA']['tl_download_statistic']['list']['label']['format'], $args);
    }

    public function getMemberLabel($row, $label, DataContainer $dc, $args)
    {
        $member = \MemberModel::findByPk($row['member']);
        return $member->firstname . ' ' . $member->lastname;
    }
}