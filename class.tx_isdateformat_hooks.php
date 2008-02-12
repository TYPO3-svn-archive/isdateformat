<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2007 Dmitry Dulepov (dmitry@typo3.org)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
* class.tx_isdateformat_hooks.php
*
* Hooks to indexed search to alternate CSS classes
*
* $Id: $
*
* @author Dmitry Dulepov <dmitry@typo3.org>
*/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 */

/**
 * Hook class for indexed_search extension. See indexed_search for each
 * public function in this extension.
 *
 * @author Dmitry Dulepov <dmitry@typo3.org>
 */
class tx_isdateformat_hooks {

	/**
	 * Parent reference for this class. Set directly by indexed search plugin
	 *
	 * @see	tx_indexedsearch.hookRequest
	 * @var	tx_indexedsearch
	 */
	public $pObj;

	/**
	 * Reformats date/time in the $tmplContent.
	 *
	 * @param	array	$tmplContent	Array with markers
	 * @param	array	$row	Row data
	 * @param	boolean	$headerOnly	Unused
	 * @return	array	Modified $tmplContent
	 */
	public function prepareResultRowTemplateData_postProc(array $tmplContent, array $row, $headerOnly) {
		// Call previous hook (if any)
		if (isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['isdateformat']['prepareResultRowTemplateData_postProc'])) {
			$userObj = t3lib_div::getUserObj($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['isdateformat']['prepareResultRowTemplateData_postProc']);
			if ($userObj && is_callable(array($userObj, 'prepareResultRowTemplateData_postProc'))) {
				$tmplContent = $userObj->prepareResultRowTemplateData_postProc($tmplContent, $row, $headerOnly);
			}
		}
		// Format date and time
		if ($this->pObj->conf['createdDateFormat'] & $this->pObj->conf['modifiedDateFormat']) {
			switch ($this->pObj->conf['dateFormatMethod']) {
				case 'date':
					$tmplContent['created'] = date($this->pObj->conf['createdDateFormat'], $row['item_crdate']);
					$tmplContent['modified'] = date($this->pObj->conf['modfiedDateFormat'], $row['item_mtime']);
					break;
				case 'strftime':
					$tmplContent['created'] = strftime($this->pObj->conf['createdDateFormat'], $row['item_crdate']);
					$tmplContent['modified'] = strftime($this->pObj->conf['modfiedDateFormat'], $row['item_mtime']);
					break;
				default:
					die(sprintf('isdateformat: bad date format method(%s). Please, fix this error in yout TS configuration', htmlspecialchars($this->pObj->conf['dateFormatMethod'])));
			}
		}
		return $tmplContent;
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/isdateformat/class.tx_isdateformat_hooks.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/isdateformat/class.tx_isdateformat_hooks.php']);
}

?>