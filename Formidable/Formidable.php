<?php
/**
* Formidable Class
* 
* @version 1.0
* @copyright     Copyright 2014, Matilis Digital Agency (Yanna Creations Ltd.)
* @author        Valery Ambroise (vambroise@matilis.mu)
* $package matilislabs.formidable
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GPL v2.0
* $Id$
*/

namespace MatilisLabs;

require 'FormidableException.php';

class Formidable{
    /**
     * ID attribute for the form
     * @protected
     */    
    protected $form_id;
    
    /**
     * Form method (GET or POST)
     * @protected
     */     
    protected $form_method = 'get';
    
    /**
     * List of valid form methods
     * @protected
     */      
    protected $valid_form_methods = array('get','post');
    
    /**
     * Form action (Leave blank to post on same page)
     * @protected
     */     
    protected $form_action;
    
    /**
     * Flag to enable file uploads by adding the enctype attribute to the form
     * @protected
     */      
    protected $enable_file_uploads = false;  
    
    /**
     * Helper array to hold all form element objects
     * @private
     */     
    private $raw_content = array(); 
    
    /**
     * Form output
     * @private
     */     
    protected $output;
    
    /**
     * Current Formidable instance
     * @private
     */     
    private static $_instance;
    
    /**
     * You can choose to use fieldsets in the form (bool)
     * @public
     */     
    public $fieldsets = true;

    
    /**
     * Factory Method
     * @public
     */      
    public static function Build($id = '', $action = '', $method = 'GET', $enable_file_uploads = false){
        return new Formidable($id, $action, $method, $enable_file_uploads);
    }
    
    /**
     * Factory Method to buid form from data
     * @public
     */      
    public static function BuildFromData($data){
        $formidable_instance = @unserialize($data);
        
        if($formidable_instance instanceof Formidable){
            self::SetInstance($formidable_instance);
            return $formidable_instance;
        }else{
            throw new FormidableException('Invalid data supplied. Form cannot be built');
        }
        
    }    
    
    
    /**
     * This is the class constructor.
     * @param string An ID for the form
     * @param string The url to which the form will be submitted
     * @param string Method used to submit the form (default = POST)
     * @param bool Will the form contain a file upload element?
     * @protected
     */    
    protected function __construct($id = '', $action = '', $method = 'GET', $enable_file_uploads = false){

        if(!in_array(strtolower($method), $this->valid_form_methods)){
            throw new FormidableException('Invalid form method. Valid methods are: GET and POST');
        }
        
        //Set basic properties for the form
        $this->form_id = empty($id)? 'formidable_form': $id;
        $this->method = $method;
        $this->action = $action;
        $this->enable_file_uploads = $enable_file_uploads;
        
        self::SetInstance($this);

    }
    
    protected static function GetInstance(){
        return self::$_instance;
    }
    
    protected static function SetInstance($obj){
        self::$_instance = $obj;
    }
    
    protected function PushElement($obj, $replace = false){
        if(is_object($obj)){
            
            $obj_id = $obj->id;
            
            //Check if the supplied ID is valid
            if(empty($obj_id) || preg_match('/\s/', $obj_id)){
                throw new FormidableException('All form elements must have a valid ID');
            }
            
            //Check if an element with this ID already exists
            if(!$replace){
                foreach($this->raw_content as $cached_obj){
                    $id = $cached_obj->id;
                    
                    if($id == $obj_id){
                        throw new FormidableException('An element with the following ID already exists: ' . $id);
                    }
                }
            }
            
            $this->raw_content[$obj_id] = $obj;
            
            //If the element has a valid id, let's create a new class attribute containing the object
            $this->$obj_id = $obj;
        }
    }    
    
    /**
     * Use this method to add a label to an element
     * @param string Name of the element attached to this label
     * @param string Text for the label
     * @public
     */    
    function Label($for, $text){
        FormidableLabel::Build($for, $text);
        
        return $this;
    }    

    /**
     * Use this method to add an input element
     * @param string Input type
     * @param string Name attribute
     * @param string Class attribute
     * @param string ID attribute
     * @param string Element status. Leave blank for default behaviour (enabled) or set to 'disabled' to ... you guessed it disable. ;-)
     * @param string Value for the element
     * @param string Text for the placeholder
     * @public
     */     
    function Input($id, $name, $type = 'text', $class = 'input', $status = '', $value = '', $placeholder = ''){
        FormidableInput::Build($id, $name, $type, $class, $status, $value, $placeholder);
        
        return $this;      
    }
    
    function Textarea($id, $name, $class = '', $status = '', $content = '', $placeholder = ''){
        FormidableTextarea::Build($id, $name, $class, $status, $content, $placeholder);
        
        return $this; 
    }
    
    function Select($id, $name, $options, $class = 'input', $status = '', $selected = ''){
        FormidableSelect::Build($id, $name, $options, $class, $status, $selected);
        
        return $this;
    }
    
    function CustomHTML($id, $html_content){
        FormidableCustomHTML::Build($id, $html_content);
        
        return $this;        
    }

    /**
     * This method creates a valid HTML form
     * @protected
     */       
    protected function BakeForm(){
        $this->output = '<form class="form" id="' . $this->form_id . '" method="' . $this->method . '" action="' . $this->action . '"';
        if($this->enable_file_uploads){
            $this->output .= ' enctype="multipart/form-data" ';
        }
        $this->output .= '>';
                
        foreach($this->raw_content as $obj){
            if(is_object($obj)){
                if(method_exists($obj, 'Bake')){
                    $this->output .= $obj->Bake($obj);
                }else{
                    throw new FormidableException('Bake method not found for the following class: ' . get_class($obj));
                }
            }
        }
        
        $this->output .= '</form>';
    }


    /**
     * Use this method to display the form
     * @public
     */      
    function Show(){

        $this->BakeForm();
//        print '<pre>';
//        print_r($this->raw_content);
//        print '</pre>';
        print $this->output;

    }

    /**
     * Use this method to get the html output
     * @public
     */     
    function Get(){
        $this->BakeForm();
        return $this->output;
    } 
    
    /**
     * Use this method to get the raw form objects
     * @public
     */     
    function GetRaw(){
        return serialize($this);
    }
           
} 