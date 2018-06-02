@extends('layouts.app')
@section('content')
<div class="container">
	<div class="col-md-7">
		<h4>Category Tree</h4>
		<em>Click any category to edit or add sub category under</em>
		<div id="categoryTree">
			{!! $render !!}
		</div>
	</div>
	<div class="col-md-5">
		<div class="panel panel-primary">
			<div class="panel-body">
				<h4>New Category</h4>
				<form method="POST" action="/category/create">
					{{csrf_field()}}
					<div class='form-group'>
						<label>Category name</label>
						<input type='text' class='form-control' name='category_name' value='' required />
					</div>
					<div class='form-group'>
						<input type='submit' class='btn btn-primary' value='CREATE'/>
					</div>
				</form>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-body">
				<div id="updateForm">
					
				</div>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-body">
				<div id="subCategoryForm">
					
				</div>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-body">
				<div id="moveCategoryForm">
					
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function()
{
$('body').on('click', '.category-link', function(e)
{
	e.preventDefault();
	var id = $(this).attr('data-id');
	var cat = $(this).text();
var csrf = '<?= csrf_field(); ?>';
var form = "<h4>Update "+cat+"</h4>"+"<form method='POST' action='/category/update'>"+ csrf +"<div class='form-group'><input type='text' name='category_id' class='hidden' value='"+id+"' required /></div>" + "<div class='form-group'><label>Category name</label><input type='text' class='form-control' name='category_name' value='"+cat+"' required /></div>" + "<div class='form-group'><input type='submit' class='btn btn-primary' value='UPDATE'/></div></form>";
var form2 = "<h4>Create sub category under "+cat+"</h4>"+"<form method='POST' action='/category/sub_create'>"+ csrf +"<div class='form-group'><input type='text' name='category_id' class='hidden' value='"+id+"' required /></div>" + "<div class='form-group'><label>Category name</label><input type='text' class='form-control' name='category_name' value='' required /></div>" + "<div class='form-group'><input type='submit' class='btn btn-primary' value='CREATE'/></div></form>";
$("#updateForm").empty();
$("#updateForm").append(form);
$("#subCategoryForm").empty();
$("#subCategoryForm").append(form2);
$.ajax(
{
url:"/category/other_category/"+id,
method:"GET",
dataType: "JSON",
//data: {"id": id},
success:function(data)
{
var select = "<select class='form-control' name='category_id' required>";
	select += "<option selected disabled>Select Category</option>";
	for(var i = 1; i<data.length; i++)
	{
	select += "<option value='"+data[i].category_id+"'>"+data[i].category_name+"</option>";
	}
select += "</select>";
var form3 = "<h4>Move category "+cat+"</h4>"+"<form method='POST' action='/category/move_category'>"+ csrf +"<div class='form-group'><input type='text' name='category_old' class='hidden' value='"+id+"' required /></div>" + "<div class='form-group'><label>Category</label>"+select+"</div>" + "<div class='form-group'><input type='submit' class='btn btn-primary' value='CREATE'/></div></form>";
$("#moveCategoryForm").empty();
$("#moveCategoryForm").append(form3);
}
});
});

setInterval(function()
{
	$.get('/category/getCategoryTree', function(data)
	{
		$("#categoryTree").empty();
		$("#categoryTree").html(data);
	});
}, 1000);






});
</script>
@endsection