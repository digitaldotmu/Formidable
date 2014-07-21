<?php
    include 'Formidable.php';
    include 'FormidableLabel.php';
    include 'FormidableInput.php';
    include 'FormidableTextarea.php';
    include 'FormidableSelect.php';
    include 'FormidableCustomHTML.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
    <title>Formidable by MatilisLabs Demo</title>
    <link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/form.css" />
    <style type="text/css">
        body {font-family: arial, sans-serif;}
    </style>
</head>
<body>

<div style="width:500px;margin:0 auto;">
<?php

    try{
        $title_options = array('Mr'=>'Mr','Mrs'=>'Mrs','Ms'=>'Ms');
        //$title_options = '';
        
        $form = MatilisLabs\Formidable::Build('formidable_demo')
        ->Label('title','Title: ')
        ->Select('title','title',$title_options, '','','Mrs')  
        ->Label('first_name','First Name: ')
        ->Input('first_name','first_name','',array('input', 'text'),'','','First Name')
        ->CustomHTML('<p>Some custom content in a paragraph</p>')
        ->Label('address','Address: ')
        ->Textarea('address', 'address')
        ->Label('ok', 'I accept....')
        ->Input('ok', 'ok', 'checkbox')
        ->Input('yes', 'radio_status', 'radio', '', '', 'yes') 
        ->Input('no', 'radio_status', 'radio', '', '', 'no')    
        ->Input('', '', 'submit', '', '', 'Submit Form')
        ->Show();
        
    }catch(MatilisLabs\FormidableException $e){
        $e->displayMessage();
    }
?>
</div>

</body>
</html>
