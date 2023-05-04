<?php

defined('TYPO3') or die('Access denied.');

/**
 * Extend core tables TCA with checkbox to anable datatables.
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

    // Add checkbox element to enable datatables
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', [
        'tx_ku_tables_enable_datatable' => [
            'exclude' => true,
            'label' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:enable_datatable',
            'description' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:enable_datatable_descr',
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
    ]);

    // Add checkbox to existing tables palette
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'tableconfiguration', // table palette name
        'tx_ku_tables_enable_datatable',
        'after:table_caption' // Existing TCA
    );
});
