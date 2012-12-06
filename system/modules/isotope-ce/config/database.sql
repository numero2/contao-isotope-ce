-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
  `iso_product` int(10) unsigned NOT NULL default '0',
  `iso_product_template` varchar(255) NOT NULL default '',
  `iso_buttons` blob NULL,
  `iso_overwrite_page_meta` char(1) NOT NULL default '',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

