<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  numero2 - Agentur für Internetdienstleistungen <www.numero2.de>
 * @author     Benny Born <benny.born@numero2.de>
 * @package    Isotope eCommerce
 * @license    LGPL
 * @filesource
 */

 
$this->loadLanguageFile('tl_module');
$this->loadDataContainer('tl_module');


/**
 * Table tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['iso_product'] = '{type_legend},type;{include_legend},iso_product,iso_product_template,iso_buttons,iso_overwrite_page_meta;{protected_legend:hide},protected;{expert_legend:hide},guests,invisible,cssID,space';


$GLOBALS['TL_DCA']['tl_content']['fields']['iso_product'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['iso_product']
,	'exclude'                 => true
,	'inputType'               => 'select'
,	'options_callback'        => array( 'tl_content_iso_product', 'getIsotopeProducts' )
,	'eval'                    => array( 'mandatory'=>true, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50' )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['iso_product_template'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['iso_product_template']
,	'exclude'                 => true
,	'inputType'               => 'select'
,	'options_callback'        => array( 'tl_module_isotope', 'getReaderTemplates' )
,	'eval'                    => array( 'chosen'=>true, 'tl_class'=>'w50' )
);

$GLOBALS['TL_DCA']['tl_content']['fields']['iso_buttons'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['iso_buttons']
,	'exclude'                 => true
,	'inputType'               => 'checkboxWizard'
,	'default'				  => array('add_to_cart')
,	'options_callback'		  => array('tl_module_isotope', 'getButtons')
,	'eval'					  => array('multiple'=>true, 'tl_class'=>'clr'),
);

$GLOBALS['TL_DCA']['tl_content']['fields']['iso_overwrite_page_meta'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['iso_overwrite_page_meta']
,	'exclude'                 => true
,	'inputType'               => 'checkbox'
,	'eval'                    => array( 'tl_class'=>'w50' )
);

class tl_content_iso_product extends Backend {


	public function getIsotopeProducts() {
	
		$oProducts = NULL;
		$oProducts = $this->Database->prepare(" SELECT id, name, sku FROM `tl_iso_products` WHERE published = 1")->execute();
		
		$aProducts = array();
		
		while( $oProducts->next() ) {
			$aProducts[ $oProducts->id ] = sprintf(
				"[%s] %s"
			,	$oProducts->sku
			,	$oProducts->name
			);
		}
		
		return $aProducts;
	}
}

?>