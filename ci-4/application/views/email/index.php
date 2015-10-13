<?php
echo form_open('email/send');
echo "<h2>Enter the name</h2>";
$name = array(
	'name' => 'name',
	'type' => 'text',
	'placeholder' => 'pls enter the name'
	);
echo form_input($name);
echo br(2);
$from = array(
	'name' => 'email',
	'type' => 'text',
	'placeholder' => 'pls enter the email addr'
	);
echo form_input($from);
echo br(2);
echo form_submit('submit','submit');
echo form_close();
echo validation_errors();
?>