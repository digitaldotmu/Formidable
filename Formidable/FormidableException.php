<?php
/**
* Formidable Exception Class
* 
* @version 1.0
* @copyright     Copyright 2014, Yanna Creations Ltd.
* @author        Valery Ambroise (vambroise@matilis.mu)
* $package matilislabs.formidable
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GPL v2.0
* $Id$
*/

namespace MatilisLabs;

class FormidableException extends \Exception{

    public function __construct($message, $code = 0, Exception $previous = null) {

        parent::__construct($message, $code, $previous);
    }
    
    public function displayMessage(){
        print '<div class="error">';
        print 'FORM FRAMEWORK ERROR : ' . $this->message;
        print '</div>';
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
