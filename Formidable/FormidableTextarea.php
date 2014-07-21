<?php
/**
* FormidableTextarea Class
* 
* @version 1.0
* @copyright     Copyright 2014, Matilis Digital Agency (Yanna Creations Ltd.)
* @author        Valery Ambroise (vambroise@matilis.mu)
* $package matilislabs.formidable
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GPL v2.0
* $Id$
*/

namespace MatilisLabs;

class FormidableTextarea extends Formidable{
    
    protected $id;
    protected $name;
    protected $class = '';
    protected $status;
    protected $content;
    protected $placeholder;    
    
    public static function Build($id, $name, $class = '', $status = '', $content = '', $placeholder = ''){
        return new FormidableTextarea($id, $name, $class, $status, $content, $placeholder);
    } 
    
    protected function __construct($id, $name, $class = '', $status = '', $content = '', $placeholder = ''){
        $this->id = $id;
        $this->name = $name;
        
        if(is_array($class)){
            $this->class = implode(" ", $class);
        }else{
            $this->class = $class;
        }
        
        $this->status = $status;
        $this->content = $content;
        $this->placeholder = $placeholder;                
        
        Formidable::GetInstance()->PushElement($this);
        
        return Formidable::GetInstance();        
    } 
    
    /**
     * This method to creates a valid HTML markup from a FormidableCustomHTML object
     * @param object FormidableCustomHTML instance
     * @protected
     */      
    protected function Bake(FormidableTextarea $obj){
        if(is_object($obj) && $obj instanceof FormidableTextarea){
            
            function GetStatus($status){
                return ($status == 'disabled')? 'disabled=""':'';
            }
            
            function GetPlaceholder($placeholder){
                return (!empty($placeholder))? 'placeholder="' . $placeholder . '"':'';
            }            
     
            $out = '';
            //Build element
            $out .= '<textarea name="' . $obj->name . '" class="' . $obj->class . '" id="' . $obj->id . '" ' . GetStatus($obj->status) . ' ' . GetPlaceholder($obj->placeholder) . '>' . $obj->content . '</textarea>';
             
            
            return $out;
            
        }else{
            throw new FormidableException( 'Not a valid FormidableTextarea object' );
        }     
    }       
}