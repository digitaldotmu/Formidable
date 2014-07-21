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
    <title>Formidable by MatilisLabs Demo 3</title>
    <link rel="stylesheet" type="text/css" href="assets/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/form.css" />
    <style type="text/css">
        body {font-family: arial, sans-serif;}
    </style>
</head>
<body>

<div style="width:500px;margin:0 auto;">
<?php
    $form_data = file_get_contents('TestData');
    
    try{
        $form = MatilisLabs\Formidable::BuildFromData($form_data)
        ->CustomHTML('some_text', '<p>Search everything</p>')
        ->Input('ok', 'ok', 'checkbox') //Add a checkbox
        ->keywords->Value('Value updated!') //Access an input element by it's ID and update it's value!
        ->Show();
        
    }catch(MatilisLabs\FormidableException $e){
        $e->displayMessage();
    }
?>
</div>

</body>
</html>
