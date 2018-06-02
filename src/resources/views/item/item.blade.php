@extends('layouts.app')
@section('content')
<div class="container">
	<div class="col-md-8">
		<h4>Items</h4>
		<table class="table table-condensed table-hover table-responsive">
			<thead>
				<tr>
					<th>Name</th>
					<th>Category</th>
				</tr>
			</thead>
			<tbody id="itemRows">
				@forelse($items as $i)
				<tr>
					<td><a href="#" data-id="{{ $i->item_id }}" class="item-link">{{ $i->item_name }}</a></td>
					<td>{{ $i->category_name }}</td>
				</tr>
				@empty
				<tr><td>No items</td></tr>
				@endforelse
			</tbody>
		</table>
	</div>
	<div class="col-md-4">
		<div class="panel panel-primary">
			<div class="panel-body">
				<h4>New Item</h4>
				<form method="POST" action="/item/create">
					{{csrf_field()}}
					<div class="form-group">
						<label>Select category</label>
						<select name="category_id" class="form-control" required>
							<option selected disabled>Select Category</option>
							@forelse($categories as $category)
							<option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
							@empty
							<option selected disabled>No category in database</option>
							@endforelse
						</select>
					</div>
					<div class='form-group'>
						<label>Item Name</label>
						<input type='text' class='form-control' name='item_name' value='' required />
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
	</div>
</div>
<script>
$(document).ready(function()
{
$('body').on('click', '.item-link', function(e)
{
	e.preventDefault();
	var id = $(this).attr('data-id');
	var cat = $(this).text();
var csrf = '<?= csrf_field(); ?>';
var form = "<h4>Update "+cat+"</h4>"+"<form method='POST' action='/item/update'>"+ csrf +"<div class='form-group'><input type='text' name='item_id' class='hidden' value='"+id+"' required /></div>" + "<div class='form-group'><label>Item name</label><input type='text' class='form-control' name='item_name' value='"+cat+"' required /></div>" + "<div class='form-group'><input type='submit' class='btn btn-primary' value='UPDATE'/></div></form>";

$("#updateForm").empty();
$("#updateForm").append(form);


});



setInterval(function()
{
	$.get('/item/getItems', function(data)
	{
		$("#itemRows").empty();
		if(data.length > 0)
		{

			for(var i=0; i<=data.length; i++)
			{
			var html = "<tr>";
			html += "<td><a href='#' data-id='"+data[i].item_id+"' class='item-link'>"+data[i].item_name+"</td>";
			html += "<td>"+data[i].category_name+"</td>";
			html += "</tr>";
			$("#itemRows").append(html);
			}
		}
		else
		{
			$("#itemRows").append("<tr><td>No items</td></tr>");
		}
	});
}, 2000);


});
</script>
@endsection