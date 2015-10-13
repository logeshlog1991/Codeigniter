<?php
echo "<h2>Login Here</h2>";
echo form_open('crud/login_check');
$name = array(
	'name' => 'name',
	'type' => 'text',
	'placeholder' => 'pls enter the name'
	);
echo form_input($name);
echo br(2);
$email = array(
	'name' => 'email',
	'type' => 'text',
	'placeholder' => 'pls enter the name first'
	);
echo form_input($email);
echo br(2);
echo form_submit('submit','submit');
echo form_close();
echo validation_errors();