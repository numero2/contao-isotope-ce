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


class ContentIsotopeProduct extends ModuleIsotopeProductReader {

	
	/**
	 * Parse the template
	 * @return string
	 */
	public function generate() {

		$this->Input->setGet( 'product', $this->iso_product );

		return parent::generate();
	}


	/**
	 * Generate the content element
	 */
	protected function compile() {
		
		$objProduct = IsotopeFrontend::getProductByAlias( $this->iso_product, IsotopeFrontend::getReaderPageId() );

		if( !$objProduct ){
			$this->Template = new FrontendTemplate('mod_message');
			$this->Template->type = 'empty';
			$this->Template->message = $GLOBALS['TL_LANG']['MSC']['invalidProductInformation'];
			return;
		}

		$this->Template->product = $objProduct->generate( (strlen($this->iso_product_template) ? $this->iso_product_template : $objProduct->reader_template), $this );
		$this->Template->referer = 'javascript:history.go(-1)';
		$this->Template->back = $GLOBALS['TL_LANG']['MSC']['goBack'];

		if( $this->iso_overwrite_page_meta ) {

			global $objPage;

			$objPage->pageTitle = strip_insert_tags($objProduct->name);
			$objPage->description = $this->prepareMetaDescription($objProduct->description_meta);
		}

		$GLOBALS['TL_KEYWORDS'] .= (strlen($GLOBALS['TL_KEYWORDS']) ? ', ' : '') . $objProduct->keywords_meta;
	}
}

?>