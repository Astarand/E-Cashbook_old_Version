<div class="card-table">
	<div class="card-body">
		<div class="table-responsive no-pagination">
			<table class="table table-center table-hover datatable">
				<thead class="thead-light">
				<tr>
					<th>Product / Service</th>
					<th>Quantity</th>
					<th>Unit</th>
					<th>Rate</th>
					<th>Discount</th>
					<th>Tax</th>
					<th>Amount</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<?php $taxableAmt = 0 ?>
				<?php $totalDisc = 0 ?>
				<?php $totalTax = 0 ?>
				<?php $totalAmount = 0 ?>
				@foreach ($vouchers_values as $value)
				<tr>
					<td>{{ $value->item_name }}</td>
					<td><input type="text" name="quantity" id="quantity_<?php echo $value->id; ?>" data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" data-prod_id="{{ $value->prod_id }}" onChange="changeQuantityCreditDebit(this)" class="form-control quantity" value="{{ $value->quantity }}"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></td>
					<td>{{ $value->base_unit }}</td>
					<td><input type="text" name="rate" id="rate_<?php echo $value->id; ?>" data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" onChange="changeRateCreditDebit(this)" class="form-control rate" value="{{ $value->rate }}"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"></td>
					<td>{{ $value->disc_amt }}</td>
					<td>{{ $value->tax_amt }}</td>
					<td>₹{{ $value->amount }}</td>
					<td class="d-flex align-items-center">
						<a href="javascript:void(0);" data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" data-rate="{{ $value->rate }}" data-discamt="{{ $value->disc_amt }}" data-taxtype="{{ $value->tax_type }}" onclick="editItemCreditDebit(this)" class="btn-action-icon me-2" data-bs-toggle="modal" data-bs-target="#add_discount"><span><i class="fe fe-edit"></i></span></a>
						<a href="javascript:void(0);" data-id="{{ $value->id }}" data-sid="{{ $value->sid }}" onclick="delItemCreditDebit(this)" class="btn-action-icon" data-bs-toggle="modal" data-bs-target="#delete_discount"><span><i class="fe fe-trash-2"></i></span></a>
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
					<p>Taxable Amount <span>₹<?php echo $taxableAmt; ?></span></p>
					<p>Discount <span>₹<?php echo $totalDisc; ?></span></p>
					<p>Vat <span>₹<?php echo $totalTax; ?></span></p>
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
			</div>
		</div>
	</div>
</div>