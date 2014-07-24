Formidable
==========

A PHP Framework to create HTML forms programmatically.

###Usage:

```
MatilisLabs\Formidable::Build('formidable_demo')
  ->Label('for_first_name','first_name','First Name: ')
  ->Input('first_name','first_name','',array('input', 'text'),'','','First Name')
  ->Label('for_address','address','Address: ')
  ->Textarea('address', 'address')
  ->Input('submit', '', 'submit', '', '', 'Submit Form')
  ->Show();
```

http://matilis.mu
