<?php
/**
* FormidableLabel Class
* 
* @version 1.0
* @copyright     Copyright 2014, Matilis Digital Agency (Yanna Creations Ltd.)
* @author        Valery Ambroise (vambroise@matilis.mu)
* $package matilislabs.formidable
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GPL v2.0
* $Id$
*/

namespace MatilisLabs;

class FormidableLabel extends Formidable{
    
    protected $for;
    protected $text;
    
    public static function Build($for, $text = ''){
        return new FormidableLabel($for, $text);
    } 
    
    protected function __construct($for, $text = ''){
        $this->for = $for;
        $this->text = $text;
        
        Formidable::GetInstance()->PushElement($this);
        
        return Formidable::GetInstance();        
    } 
    
    /**
     * This method to creates a valid HTML markup from a FormidableLabel object
     * @param object FormidableLabel instance
     * @protected
     */      
    protected function Bake(FormidableLabel $obj){
        if(is_object($obj) && $obj instanceof FormidableLabel){
            $out = '';
            //Build element
            $out .= '<label for="' . $obj->for . '">' . $obj->text . '</label>'; 
            
            return $out; 
        }else{
            throw new FormidableException( 'Not a valid FormidableLabel object' );
        }     
    }       
}