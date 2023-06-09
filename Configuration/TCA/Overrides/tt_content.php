<?php

defined('TYPO3') or die('Access denied.');

/**
 * Extend core tables TCA with checkbox to enable datatables.
 */

call_user_func(function ($extKey ='ku_tables', $contentType ='table') {
    // Add Content Element
    if (!is_array($GLOBALS['TCA']['tt_content']['types'][$contentType] ?? false)) {
        $GLOBALS['TCA']['tt_content']['types'][$contentType] = [];
    }

    // Add content element PageTSConfig
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        $contentType,
        'Configuration/TsConfig/Page/Table.tsconfig',
        'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:title'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', [
        // Add datatables checkbox element to enable datatables
        'tx_ku_tables_enable_datatable' => [
            'exclude' => true,
            'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:enable_datatable',
            'onChange' => 'reload',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                    ],
                ],
            ],
        ],
        'tx_ku_tables_datatable_columnpicker' => [
            'displayCond' =>'FIELD:tx_ku_tables_enable_datatable:=:1',
            'exclude' => true,
            'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:column_picker',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        '1 (default)',
                        0,
                    ],
                    [
                        '2',
                        1,
                    ],
                    [
                        '3',
                        2,
                    ],
                    [
                        '4',
                        3,
                    ],
                    [
                        '5',
                        4,
                    ],
                    [
                        '6',
                        5,
                    ]
                ],
                'default' => 0
            ],
        ],
        'tx_ku_tables_datatable_columnsort' => [
            'displayCond' =>'FIELD:tx_ku_tables_enable_datatable:=:1',
            'exclude' => true,
            'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:column_sort',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:column_sort_asc',
                        'asc',
                    ],
                    [
                        'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:column_sort_desc',
                        'desc',
                    ]
                ],
                'default' => 'asc'
            ],
        ],
    ]);

    // Add checkbox to existing tables palette
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'tableconfiguration', // table palette name
        '--linebreak--,tx_ku_tables_enable_datatable,tx_ku_tables_datatable_columnpicker,tx_ku_tables_datatable_columnsort', // New TCA
        'after:table_caption' // Existing TCA
    );
});
