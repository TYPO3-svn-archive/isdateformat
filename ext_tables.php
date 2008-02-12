<?php
if (!defined ('TYPO3_MODE')) {
	die('Access denied.');
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'static/indexed_search_date_format/', 'Indexed Search Date Format');
?>