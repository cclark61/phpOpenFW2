<?php
//**************************************************************************************
//**************************************************************************************
/**
 * Load Global Database Functions Plugin
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 **/
//**************************************************************************************
//**************************************************************************************

//=============================================================================
// Check for Excluded Classes / Functions Array
//=============================================================================
if (!isset($excluded)) {
	$excluded = [];
}

//=============================================================================
// Function Declarations
//=============================================================================

//=============================================================================
// Class Aliases
//=============================================================================

//********************************************************************
// Forms
//********************************************************************
if (!in_array('form', $excluded)) {
	class_alias('\phpOpenFW\Form\Forms\Form', '\form');
}
if (!in_array('form_too', $excluded)) {
	class_alias('\phpOpenFW\Form\Forms\FormToo', '\form_too');
}

//********************************************************************
// Form Elements
//********************************************************************
if (!in_array('button', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\button', '\button');
}
if (!in_array('cga', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\cga', '\cga');
}
if (!in_array('checkbox', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\checkbox', '\checkbox');
}
if (!in_array('file', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\file', '\file');
}
if (!in_array('hidden', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\hidden', '\hidden');
}
if (!in_array('image', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\image', '\image');
}
if (!in_array('radio', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\radio', '\radio');
}
if (!in_array('rga', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\rga', '\rga');
}
if (!in_array('rgt', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\rgt', '\rgt');
}
if (!in_array('secret', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\secret', '\secret');
}
if (!in_array('ssa', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\ssa', '\ssa');
}
if (!in_array('sst', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\sst', '\sst');
}
if (!in_array('submit', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\submit', '\submit');
}
if (!in_array('textarea', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\textarea', '\textarea');
}
if (!in_array('textbox', $excluded)) {
	class_alias('\phpOpenFW\Form\Elements\textbox', '\textbox');
}

//********************************************************************
// Server Side Validation
//********************************************************************
if (!in_array('server_side_validation', $excluded)) {
	class_alias('\phpOpenFW\Form\Validation\SSV', '\server_side_validation');
}
