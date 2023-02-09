<?php
/*
 * Followig class handling number input control and their
* dependencies. Do not make changes in code
* Create on: 21 May, 2014
*/

class NM_Number extends NM_Inputs_wpregisration{
	
	/*
	 * input control settings
	 */
	var $title, $desc, $settings;
	
	/*
	 * this var is pouplated with current plugin meta
	*/
	var $plugin_meta;
	
	function __construct(){
		
		$this -> plugin_meta = wpregistration_get_plugin_meta();
		
		$this -> title 		= __ ( 'Number Input', 'wp-registration' );
		$this -> desc		= __ ( 'regular number input', 'wp-registration' );
		$this -> settings	= self::get_settings();
		
	}
	
	
	
	
	private function get_settings(){
		
		return array (
						'title' => array (
								'type' => 'text',
								'title' => __ ( 'Title', 'wp-registration' ),
								'desc' => __ ( 'It will be shown as field label', 'wp-registration' ) 
						),
						'data_name' => array (
								'type' => 'text',
								'title' => __ ( 'Data name', 'wp-registration' ),
								'desc' => __ ( 'REQUIRED: The identification name of this field, that you can insert into body email configuration. Note:Use only lowercase characters and underscores.', 'wp-registration' ) 
						),
						'description' => array (
								'type' => 'text',
								'title' => __ ( 'Description', 'wp-registration' ),
								'desc' => __ ( 'Small description, it will be diplay near name title.', 'wp-registration' ) 
						),
						'error_message' => array (
								'type' => 'text',
								'title' => __ ( 'Error message', 'wp-registration' ),
								'desc' => __ ( 'Insert the error message for validation.', 'wp-registration' ) 
						),
				
						'max_value' => array (
								'type' => 'text',
								'title' => __ ( 'Max. values', 'wp-registration' ),
								'desc' => __ ( 'Max. values allowed, leave blank for default', 'wp-registration' )
						),
						
						'min_value' => array (
								'type' => 'text',
								'title' => __ ( 'Min. values', 'wp-registration' ),
								'desc' => __ ( 'Min. values allowed, leave blank for default', 'wp-registration' )
						),
						
						'step' => array (
								'type' => 'text',
								'title' => __ ( 'Steps', 'wp-registration' ),
								'desc' => __ ( 'specified legal number intervals', 'wp-registration' )
						),
						
						'default_value' => array (
								'type' => 'text',
								'title' => __ ( 'Set default value', 'wp-registration' ),
								'desc' => __ ( 'Pre-defined value for text input', 'wp-registration' )
						),
						
						'required' => array (
								'type' => 'checkbox',
								'title' => __ ( 'Required', 'wp-registration' ),
								'desc' => __ ( 'Select this if it must be required.', 'wp-registration' ) 
						),
						'class' => array (
								'type' => 'text',
								'title' => __ ( 'Class', 'wp-registration' ),
								'desc' => __ ( 'Insert an additional class(es) (separateb by comma) for more personalization.', 'wp-registration' ) 
						),
						'width' => array (
								'type' => 'text',
								'title' => __ ( 'Width', 'wp-registration' ),
								'desc' => __ ( 'Type field width in % e.g: 50%', 'wp-registration' ) 
						),
						
						
				);
	}
	
	
	/*
	 * @params: args
	*/
	function render_input($args, $content=""){
		
		$_html = '<input type="number" ';
		
		foreach ($args as $attr => $value){
			
			$_html .= $attr.'="'.stripslashes( $value ).'"';
		}
		
		if($content)
			$_html .= 'value="' . stripslashes($content	) . '"';
		
		$_html .= ' />';
		
		echo $_html;
	}
}