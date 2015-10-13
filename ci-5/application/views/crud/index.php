<?php
if(isset($value)){
	foreach($value as $row){
		echo "<p>$row->name</p>";
		echo "<a href='http://localhost/ci-5/crud/delete/$row->id'>delete</a>";
	}
}
echo "<h2>Crud Method</h2>";
echo form_open('crud/creat');
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

echo "<a href='http://localhost/ci-5/crud/logout'>logout</a>";
?>