function addFun()
{
	var service='<div>Service:<input type="text" id="service[]" name="service[]" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mode:<select name="mode[]" id="mode[]" style="width:120px;"><option value="">Select Option</option><option value="1">Included</option><option value="2">Not Included</option></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cost: <input type="text" id="cost[]" name="cost[]" size="8" value=""/>&nbsp;&nbsp;&nbsp;<input class="btn btn-danger" type="button" value="Remove" onclick="removeFun(this)"><br /><br /></div>';
	$('#addservice').append(service);
}
function removeFun(id)
{
	$(id).parent().remove();
}
