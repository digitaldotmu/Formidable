<?php
/**
* FormidableInput Class
* 
* @version 1.0
* @copyright     Copyright 2014, Matilis Digital Agency (Yanna Creations Ltd.)
* @author        Valery Ambroise (vambroise@matilis.mu)
* $package matilislabs.formidable
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GPL v2.0
*/

namespace MatilisLabs;

class FormidableInput extends Formidable{
    
    protected $id;
    protected $name;
    protected $type = 'text';
    protected $class = '';
    protected $status;
    protected $value;
    protected $placeholder;
    
    /**
     * List of valid HTML input types. List taken from: http://www.w3schools.com/tags/tag_input.asp
     * $param array
     * @private
     */    
    private $valid_types = array(
        'button',
        'checkbox',
        'color',
        'date',
        'datetime',
        'datetime-local',
        'email',
        'file',
        'hidden',
        'image',
        'month',
        'number',
        'password',
        'radio',
        'range',
        'reset',
        'search',
        'submit',
        'tel',
        'text',
        'time',
        'url',
        'week'
    );
    

    public static function Build($id, $name, $type = 'text', $class = '', $status = '', $value = '', $placeholder = ''){
        return new FormidableInput($id, $name, $type, $class, $status, $value, $placeholder);
    }
        
    /**
     * This method creates an input element
     * @param string Input type
     * @param string Name attribute
     * @param mixed Class attribute. Can be a string or an array of classes
     * @param string ID attribute
     * @param string Element status. Leave blank for default behaviour (enabled) or set to 'disabled' to ... you guessed it disable. ;-)
     * @param string Value for the element
     * @param string Text for the placeholder
     * @public
     */     
    protected function __construct($id, $name, $type = 'text', $class = '', $status = '', $value = '', $placeholder = ''){
        
        $this->id = $id;
        $this->name = $name;
        
        if(empty($type)){
            $type = 'text';
        }else{
            if(!in_array($type, $this->valid_types)){
                throw new FormidableException( 'Invalid HTML input type: ' . $type );
            }
        }
        
        $this->type = $type;
        
        if(is_array($class)){
            $this->class = implode(" ", $class);
        }else{
            $this->class = $class;
        }
        
        $this->status = $status;
        $this->value = $value;
        $this->placeholder = $placeholder;
        
        //Formidable::GetInstance()->output .= $this->Bake($this);
        Formidable::GetInstance()->PushElement($this);
        
        return Formidable::GetInstance();
        
    } 
    
    /**
     * This method to creates a valid HTML markup from a FormidableInput object
     * @param object FormidableInput instance
     * @protected
     */      
    protected function Bake(FormidableInput $obj){
        if(is_object($obj) && $obj instanceof FormidableInput){
            $out = '';
            //Build element
            $out .= '<input type="' . $obj->type . '" name="' . $obj->name . '" class="' . $obj->class . '" id="' . $obj->id . '" ';
            
            if($obj->status == 'disabled'){
                $out .= ' disabled = ""';
            }
            
            if(!empty($obj->placeholder)){
                $out .= ' placeholder = "' . $obj->placeholder . '"';
            }
            
            if(!empty($obj->value)){
                $out .= ' value = "' . $obj->value . '"';
            }        
            
            $out .= '/>';  
            
            return $out; 
        }else{
            throw new FormidableException( 'Not a valid FormidableInput object' );
        }     
    }   
}