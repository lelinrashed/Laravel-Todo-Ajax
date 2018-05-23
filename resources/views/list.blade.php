<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ajax Todo with Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
	<style rel="stylesheet">
		a {
			outline: 0;
		}
		a:hover {
			text-decoration: none;
		}
	</style>
</head>
<body>
	
	<div class="container">
		<br>
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-6 col-12">
				<div class="card">
					<div class="card-header">Ajax Todo List <a id="addNew" data-toggle="modal" data-target="#exampleModal" href="" class="i fa fa-plus float-right"></a></div>
					<div class="card-body">
						<ul class="list-group" id="items">
							@foreach($items as $item)
								<li class="list-group-item ourItem" data-toggle="modal" data-target="#exampleModal">{{ $item->item }} <input type="hidden" value="{{ $item->id }}" id="itemId"></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>

			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="title">Add New Item</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<input type="hidden" id="id">
							<input type="text" class="form-control" name="" id="addItem" placeholder="Write item here">
							{{ csrf_field() }}
						</div>
						<div class="modal-footer">
							<button style="display: none;" type="button" id="delete" class="btn btn-danger" data-dismiss="modal">Delete</button>
							<button style="display: none;" type="button" id="saveChanges" class="btn btn-warning" data-dismiss="modal">saveChanges</button>
							<button id="addButton" type="button" class="btn btn-primary" data-dismiss="modal">Add</button>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>

	

	
	{{-- Javascript file --}}
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
	<script>
		jQuery(document).ready(function($) {
			$(document).on('click', '.ourItem', function(event) {
				var text = $(this).text();
				var id = $(this).find('#itemId').val();
				$('#title').text('Edit Item');
				$('#delete').show('400');
				$('#saveChanges').show('400');
				$('#addButton').hide('fast');
				$('#addItem').val(text);
				$('#id').val(id);
			});

			$(document).on('click', '#addNew', function(event) {
				$('#title').text('Add New Item');
				$('#delete').hide('400');
				$('#saveChanges').hide('400');
				$('#addButton').show('400');
				$('#addItem').val("");
			});

			$('#addButton').click(function(event) {
				var text = $('#addItem').val();
				if (text == "") {
					alert("Please type something");
				}else{
					$.post('list', {'text': text, '_token':$('input[name=_token]').val()}, function(data) {
						$('#items').load(location.href + ' #items');
						console.log(data);
					});
				}			
			});

			$('#delete').click(function(event) {
				var id = $('#id').val();
				$.post('delete', {'id': id, '_token':$('input[name=_token]').val()}, function(data) {		
									
					$('#items').load(location.href + ' #items');
					console.log(data);
				});
			});

			$('#saveChanges').click(function(event) {
				var id = $('#id').val();
				var value = $('#addItem').val();
				if (value == "") {
					alert("Please type something.");
				}else{					
					$.post('update', {'id': id, 'value':value, '_token':$('input[name=_token]').val()}, function(data) {
						$('#items').load(location.href + ' #items');
						console.log(data);
					});
				};
			});


		});
	</script>
	<script>
		@if (session('status'))
            toastr.success('{{ session('status') }}')
        @endif
	</script>
</body>
</html>