<?php
if (!defined ('TYPO3_MODE')) {
	die('Access denied.');
}

// Set hook to indexed_search
if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['indexed_search']['pi1_hooks']['prepareResultRowTemplateData_postProc']) {
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['isdateformat']['prepareResultRowTemplateData_postProc'] = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['indexed_search']['pi1_hooks']['prepareResultRowTemplateData_postProc'];
}
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['indexed_search']['pi1_hooks']['prepareResultRowTemplateData_postProc'] = 'EXT:isdateformat/class.tx_isdateformat_hooks.php:&tx_isdateformat_hooks';
?>