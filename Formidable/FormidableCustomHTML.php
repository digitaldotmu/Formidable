<?php
/**
* FormidableCustomHTML Class
* 
* @version 1.0
* @copyright     Copyright 2014, Matilis Digital Agency (Yanna Creations Ltd.)
* @author        Valery Ambroise (vambroise@matilis.mu)
* $package matilislabs.formidable
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GPL v2.0
*/

namespace MatilisLabs;

class FormidableCustomHTML extends Formidable{
    
    protected $html_content;
    
    public static function Build($html_content){
        return new FormidableCustomHTML($html_content);
    } 
    
    protected function __construct($html_content){
        $this->html_content = $html_content;
        
        Formidable::GetInstance()->PushElement($this);
        
        return Formidable::GetInstance();        
    } 
    
    /**
     * This method to creates a valid HTML markup from a FormidableCustomHTML object
     * @param object FormidableCustomHTML instance
     * @protected
     */      
    protected function Bake(FormidableCustomHTML $obj){
        if(is_object($obj) && $obj instanceof FormidableCustomHTML){
     
            return $this->html_content; 
        }else{
            throw new FormidableException( 'Not a valid FormidableCustomHTML object' );
        }     
    }       
}