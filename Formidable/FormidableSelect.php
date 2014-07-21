<?php
/**
* FormidableSelect Class
* 
* @version 1.0
* @copyright     Copyright 2014, Matilis Digital Agency (Yanna Creations Ltd.)
* @author        Valery Ambroise (vambroise@matilis.mu)
* $package matilislabs.formidable
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GPL v2.0
*/

namespace MatilisLabs;

class FormidableSelect extends Formidable{
    
    protected $id;
    protected $name;
    protected $options = array();
    protected $class;
    protected $status;
    protected $selected;
    
    public static function Build($id, $name, $options, $class = 'input', $status = '', $selected = ''){
        return new FormidableSelect($id, $name, $options, $class, $status, $selected);
    } 
    
    protected function __construct($id, $name, $options, $class = 'input', $status = '', $selected = ''){
        $this->id = $id;
        $this->name = $name;
        
        if(is_array($options)){
            $this->options = $options;
            
            if(is_array($class)){
                $this->class = implode(" ", $class);
            }else{
                $this->class = $class;
            }
            
            $this->status = $status;
            
            $this->selected = $selected;
                  
        }else{
            throw new FormidableException('Options attribute for FormidableSelect should be an array');
            //$this->errors[] = 'FORM FRAMEWORK ERROR : Please review options for the following select element: ' . $id;
        }        
        
        Formidable::GetInstance()->PushElement($this);
        
        return Formidable::GetInstance();        
    } 
    
    /**
     * This method to creates a valid HTML markup from a FormidableLabel object
     * @param object FormidableLabel instance
     * @protected
     */      
    protected function Bake(FormidableSelect $obj){
        if(is_object($obj) && $obj instanceof FormidableSelect){
            $out = '';
            
            $out .= '<select name="' . $obj->name . '" class="' . $obj->class . '" id="' . $obj->id . '"';
            
            if($obj->status == 'disabled'){
                $out .= ' disabled = "">';
            }else{
                $out .= '>';
            }
            
            //Add options
            foreach($obj->options as $option => $value){
                $out .= '<option value="' . $value . '"';
                if(!empty($obj->selected) && ($obj->selected == $value || $obj->selected == $option)){
                    $out .= ' selected=""';
                }
                $out .= '>' . $option . '</option>';
            }
            
            $out .= '</select>'; 
            
            return $out; 
        }else{
            throw new FormidableException( 'Not a valid FormidableSelect object' );
        }     
    }       
}