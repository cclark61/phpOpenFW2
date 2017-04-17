<?php
//**************************************************************************************
//**************************************************************************************
/**
 * XML Nav Class
 *
 * @package		phpOpenFW
 * @author 		Christian J. Clark
 * @copyright	Copyright (c) Christian J. Clark
 * @license		https://mit-license.org
 * @access		private
 **/
//**************************************************************************************
//**************************************************************************************

namespace phpOpenFW\Framework\App\Security;
use phpOpenFW\XML\GenElement;

//**************************************************************************************
/**
 * XML Nav Class
 */
//**************************************************************************************
class XMLNav
{

	//***********************************************************************************
	//***********************************************************************************
	// Class variables
	//***********************************************************************************
	//***********************************************************************************
	/**
	* @var string XML NAV data
	**/
	private $xml;

	/**
	* @var string The type of Nav format we are using (numeric, rewrite, long_url). Default is 'numeric'.
	**/
	private $nav_type;

	/**
	* Constructor function
	* @param string base directory of modules
	**/
	//***********************************************************************************
	//***********************************************************************************
	// Constructor function
	//***********************************************************************************
	//***********************************************************************************
	public function __construct($menu)
	{
		//-------------------------------------------------------------
		// Nav Type / Format
		//-------------------------------------------------------------
		if (isset($_SESSION['nav_xml_format'])) {
			$valid_formats = array(
				'numeric' => 'numeric', 
				'rewrite' => 'rewrite', 
				'long_url' => 'long_url'
			);
			$this->nav_type = (isset($valid_formats[$_SESSION['nav_xml_format']])) ? ($valid_formats[$_SESSION['nav_xml_format']]) : ('numeric');
		}
		else { $this->nav_type = 'numeric'; }

		//-------------------------------------------------------------
		// Build the XML version of the Nav
		//-------------------------------------------------------------
		$tmp = new GenElement('nav');
		$tmp->display_tree();
		$tmp->set_tabs(1);
		$tmp->add_child(new GenElement('nav_xml_format', $this->nav_type));
		$this->build_xml_nav($tmp, $menu, '/', 0, 0, '-1');
		$this->xml = $tmp->render(true);
	}

	/**
	* Builds a Full XML NAV for the current user (recursive)
	* @param string directory structure at the current module level
	* @param string the URL for this module
	* @param integer depth at the current module level
	* @param integer the index of this module in its parent's sub module set
	**/
	//***********************************************************************************
	//***********************************************************************************
	// build_xml_nav function (recursive)
	// Builds a full XML NAV for the current user
	//***********************************************************************************
	//***********************************************************************************
	private function build_xml_nav(&$obj, $dir_structure, $url, $depth, $index, $mod_string)
	{
		//-------------------------------------------------------------
		// Initialize basic variables
		//-------------------------------------------------------------
		$mod_depth = $depth / 2;
		$num_elements = count($dir_structure['mods']);

		//-------------------------------------------------------------
		// Start XML for this module
		//-------------------------------------------------------------
		$tmp = new GenElement('module', '', array('index' => $index, 'depth' => $depth));
		$tmp->display_tree();

		//-------------------------------------------------------------
		// Output all necessary data for this module
		//-------------------------------------------------------------
		$tmp->add_child(new GenElement('url', $url));
		$tmp->add_child(new GenElement('mod_string', $mod_string));
		$tmp->add_child(new GenElement('title', $dir_structure['title']));
		$tmp->add_child(new GenElement('dir', $dir_structure['dir']));
		$depth += 2;

		//-------------------------------------------------------------
		// Recursively build the module XML for all submodules of this module
		//-------------------------------------------------------------
		if ($num_elements > 0) {
			$tmp2 = new GenElement('sub_modules');
			$tmp2->display_tree();
			foreach ($dir_structure['mods'] as $key => $value) {
				$tmp_dir = $value['dir'];

				//------------------------------------------------------
				// Build URL
				//------------------------------------------------------
				if ($url == '/') {
					if ($this->nav_type == 'rewrite') {
						$new_url = $url . "{$tmp_dir}/";
						$new_mod_string = $tmp_dir;
					}
					else if ($this->nav_type == 'long_url') {
						$new_url = $url . "index.php/{$tmp_dir}/";
						$new_mod_string = $tmp_dir;					
					}
					else {
						$new_url = $url . "?mod={$key}";
						$new_mod_string = $key;
					}
				}
				else {
					if ($this->nav_type == 'rewrite' || $this->nav_type == 'long_url') {
						$new_url = $url . "{$tmp_dir}/";
						$new_mod_string = $mod_string . "/{$tmp_dir}";
					}
					else if ($this->nav_type == 'long_url') {
						$new_url = $url . "index.php/{$tmp_dir}/";
						$new_mod_string = $tmp_dir;					
					}
					else {
						$new_url = $url . "-{$key}";
						$new_mod_string = $mod_string . "-{$key}";
					}
				}
				$this->build_xml_nav($tmp2, $dir_structure['mods'][$key], $new_url, $depth, $key, $new_mod_string);
			}
			$tmp->add_child($tmp2);
		}

		//-------------------------------------------------------------
		// End the XML for this module
		//-------------------------------------------------------------
		$obj->add_child($tmp);
	}
	
	/**
	* Export the Navigation Array in XML format
	* @return string XML representation of the navigation
	**/
	//***********************************************************************************
	//***********************************************************************************
	// Export Nav Function
	//***********************************************************************************
	//***********************************************************************************
	public function export() { return $this->xml; }

}
