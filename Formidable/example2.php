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
    <title>Formidable by MatilisLabs Demo 2</title>
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
        $form = MatilisLabs\Formidable::Build('formidable_demo2')
        ->Input('do_search','do_search','hidden')   
        ->Input('keywords','keywords','',array('input', 'text'),'','','Search for...')
        ->Input('submit', '', 'submit', '', '', 'GO')
        ->keywords->Value('New value!') //Access an input element by it's ID and update it's value!
        ->Show();
        
    }catch(MatilisLabs\FormidableException $e){
        $e->displayMessage();
    }
?>
</div>

</body>
</html>
