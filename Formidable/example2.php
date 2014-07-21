<?php
    include 'FormFramework.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
    <title>Form Framework Demo</title>
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
        $form = new FormFramework('demo_search_form','','GET');
        $form->fieldsets = false;
        $form->Input('','do_search','hidden','','','true');
        $form->Input('keywords','keywords','','','','','Search for...');
        $form->Submit('GO');
        $form->Display();
    }catch(FormFrameworkException $e){
        $e->displayMessage();
    }
?>
</div>

</body>
</html>
