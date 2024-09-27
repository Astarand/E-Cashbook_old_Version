@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Create Online Order</h5>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#info" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="true" role="tab">Basic Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#details" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="true" role="tab">Item Details</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="info" role="tabpanel">
                            <div class="form-group-item">
                                <h5 class="form-title">Basic Details</h5>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Invoice Number</label>
                                            <input type="text" class="form-control" placeholder="Invoice Number" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="number" class="form-control" placeholder="Enter Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Branch">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label>Transaction Type</label>
                                        <div class="form-group">
                                            <select class="form-select">
                                                <option>Select</option>
                                                <option>B2B</option>
                                                <option>B2C</option>
                                                <option>Export</option>
                                                <option>CEZ</option>
                                                <option>Deemed Export</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label>Tax Nature</label>
                                        <div class="form-group">
                                            <select class="form-select">
                                                <option>Select</option>
                                                <option>With TAX</option>
                                                <option>Without TAX</option>
                                                <option>RCM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <ul class="nav nav-tabs nav-bordered">
                                        <li class="nav-item">
                                            <a href="#billing_details" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                <strong>Billing Details</strong>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#address" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                <strong>Billing Address</strong>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="billing_details">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <label>Branch</label>
                                                    <div class="form-group">
                                                        <select class="form-select">
                                                            <option>Branch</option>
                                                            <option>Kolkata</option>
                                                            <option>Barrackpore</option>
                                                            <option>Barasat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <label>Bill to the party</label>
                                                    <div class="form-group">
                                                        <select class="form-select">
                                                            <option>Loans & Advances to Other</option>
                                                            <option>Advance Income Tax</option>
                                                            <option>Secured Loan from Other</option>
                                                            <option>Service Tax Receivable</option>
                                                            <option>Sundry Creditors for Expenses</option>
                                                            <option>Sundry Creditors for Goods</option>
                                                            <option>Sundry Creditors for Services</option>
                                                            <option>Telephone Deposit</option>
                                                            <option>Unsecured Loan from Bank</option>
                                                            <option>Unsecured Loan From Others</option>
                                                            <option>Unsecured Loan from Relative</option>
                                                            <option>VAT Receivable</option>
                                                            <option>Bank Account</option>
                                                            <option>Advance Received from Customer</option>
                                                            <option>Advance to Staff</option>
                                                            <option>Advance to Vendor</option>
                                                            <option>Loans & Advances to Related Party</option>
                                                            <option>Machinery Loan from Bank</option>
                                                            <option>Other Bank Loan</option>
                                                            <option>Car Loan From Bank</option>
                                                            <option>Cash Credit/ Overdraft/ Credit Cards</option>
                                                            <option>Cash on Hand</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <label>Ship To Party</label>
                                                    <div class="form-group">
                                                        <select class="form-select">
                                                            <option>Loans & Advances to Other</option>
                                                            <option>Advance Income Tax</option>
                                                            <option>Secured Loan from Other</option>
                                                            <option>Service Tax Receivable</option>
                                                            <option>Sundry Creditors for Expenses</option>
                                                            <option>Sundry Creditors for Goods</option>
                                                            <option>Sundry Creditors for Services</option>
                                                            <option>Telephone Deposit</option>
                                                            <option>Unsecured Loan from Bank</option>
                                                            <option>Unsecured Loan From Others</option>
                                                            <option>Unsecured Loan from Relative</option>
                                                            <option>VAT Receivable</option>
                                                            <option>Bank Account</option>
                                                            <option>Advance Received from Customer</option>
                                                            <option>Advance to Staff</option>
                                                            <option>Advance to Vendor</option>
                                                            <option>Loans & Advances to Related Party</option>
                                                            <option>Machinery Loan from Bank</option>
                                                            <option>Other Bank Loan</option>
                                                            <option>Car Loan From Bank</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="address">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="billing-btn mb-2">
                                                        <h5 class="form-title">Billing Address</h5>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" placeholder="Enter Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 1</label>
                                                        <input type="text" class="form-control" placeholder="Enter Address 1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 2</label>
                                                        <input type="text" class="form-control" placeholder="Enter Address 2">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <input type="text" class="form-control" placeholder="Enter Country">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" class="form-control" placeholder="Enter City">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" class="form-control" placeholder="Enter State">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pincode</label>
                                                                <input type="text" class="form-control" placeholder="Enter Pincode">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="billing-btn mb-2">
                                                        <h5 class="form-title">Shipping Address</h5>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" placeholder="Enter Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 1</label>
                                                        <input type="text" class="form-control" placeholder="Enter Address 1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 2</label>
                                                        <input type="text" class="form-control" placeholder="Enter Address 2">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <input type="text" class="form-control" placeholder="Enter Country">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" class="form-control" placeholder="Enter City">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" class="form-control" placeholder="Enter State">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pincode</label>
                                                                <input type="text" class="form-control" placeholder="Enter Pincode">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-customer-btns text-end">
                                <a href="customers.html" class="btn customer-btn-cancel">Cancel</a>
                                <a href="customers.html" class="btn customer-btn-save">Save Changes</a>
                            </div>
                        </div>

                        <div class="tab-pane" id="details" role="tabpanel">
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Products</label>
                                        <div class="form-group">
                                            <ul class="form-group-plus css-equal-heights" data-select2-id="21">
                                                <li data-select2-id="20">
                                                    <div class="form-group">
                                                        <select class="form-select select2-hidden-accessible" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                                            <option data-select2-id="6">Select Product</option>
                                                            <option data-select2-id="32">Product 1</option>
                                                            <option data-select2-id="33">Product 2</option>
                                                            <option data-select2-id="34">Product 3</option>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a class="btn btn-primary form-plus-btn" href="#" onclick="addForm(this);"><i class="fas fa-plus-circle"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Discount Type</label>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <select class="form-select">
                                                    <option data-select2-id="6">Select</option>
                                                    <option data-select2-id="32">Percentage(%)</option>
                                                    <option data-select2-id="33">Fixed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Discount %</label>
                                            <input type="text" class="form-control" placeholder="Enter Discount">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Tax</label>
                                        <div class="form-group">
                                            <select class="form-select">
                                                <option data-select2-id="6">Select</option>
                                                <option data-select2-id="32">SGST</option>
                                                <option data-select2-id="33">IGST</option>
                                                <option data-select2-id="33">Both</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-item">
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
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet</td>
                                                    <td><input type="number" class="form-control" value="0"></td>
                                                    <td>Pcs</td>
                                                    <td><input type="number" class="form-control" value="120"></td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>$120.00</td>
                                                    <td class="d-flex align-items-center">
                                                        <a href="#" class="btn-action-icon me-2" data-bs-toggle="modal" data-bs-target="#add_discount"><span><i class="fe fe-edit"></i></span></a>
                                                        <a href="#" class="btn-action-icon" data-bs-toggle="modal" data-bs-target="#delete_discount"><span><i class="fe fe-trash-2"></i></span></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="form-group-bank">
                                        <div class="invoice-total-box">
                                            <div class="invoice-total-inner">
                                                <p>Taxable Amount <span>$120.00</span></p>
                                                <p>Discount <span>$13.20</span></p>
                                                <p>Vat <span>$0.00</span></p>
                                                <div class="status-toggle justify-content-between">
                                                    <div class="d-flex align-center">
                                                        <p>Round Off </p>
                                                        <input id="rating_1" class="check" type="checkbox" checked>
                                                        <label for="rating_1" class="checktoggle checkbox-bg">checkbox</label>
                                                    </div>
                                                    <span>$0.00</span>
                                                </div>
                                            </div>
                                            <div class="invoice-total-footer">
                                                <h4>Total Amount <span>$107.80</span></h4>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Signature Image</label>
                                            <div class="form-group service-upload service-upload-info mb-0">
                                                <span><i class="fe fe-upload-cloud me-1"></i>Upload Signature</span>
                                                <input type="file" multiple id="image_sign">
                                                <div id="frames"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Signature Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Signature Name">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="add-customer-btns text-end">
                                <a href="customers.html" class="btn customer-btn-cancel">Cancel</a>
                                <a href="customers.html" class="btn customer-btn-save">Save Chnages</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="add_discount" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="form-header modal-header-title text-start mb-0 align-center">
                        <h4 class="mb-0">Add Tax & Discount</h4>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="align-center" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Rate</label>
                                <input type="number" class="form-control" placeholder="120">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Discount Amount</label>
                                <input type="number" class="form-control" placeholder="0">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">

                            <div class="form-group mb-0">
                                <label>GST</label>
                                <select class="form-select">
                                    <option>N/A</option>
                                    <option>CGST</option>
                                    <option>SGST</option>
                                    <option>BOTH</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer add-tax-btns">
                    <button type="reset" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn me-2">Cancel</button>
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="delete_discount" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border-0 justify-content-center pb-0">
                    <div class="form-header modal-header-title text-center mb-0">
                        <h4 class="mb-2">Delete Product / Services</h4>
                        <p>Are you sure want to delete?</p>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Delete</a>
                            </div>
                            <div class="col-6">
                                <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

