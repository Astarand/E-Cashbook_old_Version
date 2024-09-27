<table class="table table-bordered">
	<thead>
		<tr>
			<th>Order ID</th>
			<th>Name</th>
			<th>Email</th>
			
			
		</tr>
	</thead>
	<tbody>
			<?php $i = 0; ?>
			@foreach ($users as $val)
			
			<tr>
				<td>
				{{ $val->id }}
				</td>
				<td>
				{{ $val->name }}
				</td>
				<td>
				{{ $val->email }}
				</td>

			</tr>
			
			
			
			
			
			<?php $i++; ?>
			@endforeach
	</tbody>
</table>
							
				
				
			  
			




  




