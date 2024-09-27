@if ($tasks)
<?php $i = 1; ?>	
@foreach ($tasks as $val)
	<tr>
		<td><?php echo $i++; ?></td>
		<td>{{ $val->comp_name }}</td>
		<td>{{ $val->task_category }}</td>

		<!--<td class="d-flex align-items-center">
			<div class="dropdown dropdown-action">
				<div class="row">
					<div class="col-12">
						<a href="#" class=" btn-action-icon " data-bs-toggle="modal" data-bs-target="#delete_modal" aria-expanded="false"><i class="far fa-trash-alt"></i></a>
					</div>
				</div>
			</div>
		</td>-->
	</tr>
@endforeach

@else
	<tr>
		<td colspan="3">No data found</td>
	</tr>
@endif

