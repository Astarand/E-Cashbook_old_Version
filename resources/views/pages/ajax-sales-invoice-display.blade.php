<div class="card-table">
	<div class="card-body">
		<div class="table-responsive no-pagination">
			<table class="table table-center table-hover datatable">
				<thead class="thead-light">
				<tr>
					<th>#</th>
					<th>Product / Service</th>
					<th>HSN / SAC</th>
					<th>Quantity</th>
					<th>Rate</th>
					<th>Discount</th>
					<th>Amount</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php $i = 1; ?>
				<?php $taxableAmt = 0 ?>
				<?php $totalDisc = 0 ?>
				<?php $totalTax = 0 ?>
				<?php $totalAmount = 0 ?>
				@foreach ($sales_values as $value)
				<tr>
					<td>{{ $i = $i+1 }}</td>
					<td>{{ $value->item_name }}</td>
					<td>{{ ($value->sac_code !="")?$value->sac_code:$value->hsn_code }}</td>
					<td><input type="text" name="quantity" id="quantity_<?php echo $value->id; ?>" data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" data-prod_id="{{ $value->prod_id }}" onChange="changeQuantity(this)" class="form-control quantity" value="{{ $value->quantity }}" onChange="changeQuantity(this)" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></td>
					<td><input type="text" name="rate" id="rate_<?php echo $value->id; ?>" data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" onChange="changeRate(this)" class="form-control rate" value="{{ $value->rate }}"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></td>
					<td>{{ $value->disc_amt }}</td>
					<td>₹{{ $value->amount }}</td>
					<td class="d-flex align-items-center">
						<a href="javascript:void(0);" data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" data-rate="{{ $value->rate }}" data-discamt="{{ $value->disc_amt }}" data-taxtype="{{ $value->tax_type }}" onclick="editItem(this)" class="btn-action-icon me-2" data-bs-toggle="modal" data-bs-target="#add_discount"><span><i class="fe fe-edit"></i></span></a>
						<a href="javascript:void(0);" data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" onclick="delItem(this)" class="btn-action-icon" data-bs-toggle="modal" data-bs-target="#delete_discount"><span><i class="fe fe-trash-2"></i></span></a>
					</td>
				</tr>
				<?php $taxableAmt += ($value->rate * $value->quantity); ?>
				<?php $totalDisc += $value->disc_amt; ?>
				<?php $totalTax += $value->tax_amt; ?>
				<?php $totalAmount += $value->amount; ?>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row mb-4">
	<div class="col-xl-12 col-lg-12">
		<div class="form-group-bank">

			<div class="invoice-total-box">
				<div class="invoice-total-inner">
					<p>Taxable Amount <span><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $taxableAmt; ?></span></p>
					<p>Discount <span><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $totalDisc; ?></span></p>
					<p>GST<span><i class="fa-solid fa-indian-rupee-sign"></i> <?php echo $totalTax; ?></span></p>
					<!--<div class="status-toggle justify-content-between">
						<div class="d-flex align-center">
							<p>Round Off </p>
							<input id="rating_1" class="check" type="checkbox" checked>
							<label for="rating_1" class="checktoggle checkbox-bg">checkbox</label>
						</div>
						<span>₹0.00</span>
					</div>-->
				</div>
				<div class="invoice-total-footer">
					<h4>Total Amount <span>₹<?php echo $totalAmount; ?></span></h4>
				</div>
				<p>Amount in words<span> {{ Helper::convert_number_to_words($totalAmount) }} Only</span></p>
			</div>
		</div>
	</div>
</div>