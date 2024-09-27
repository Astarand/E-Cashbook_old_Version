@extends('layouts.default')
@section('content')
<div class="page-wrapper invoice-one">
    <div class="container">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Poppins, sans-serif;
            margin: 0;
            padding: 0;
            width: 210mm;
            height: 297mm;
            padding: 20mm;
            box-sizing: border-box;
        }
        .invoice-box {
            width: 240%;
            border: 1px solid #eee;
            padding:20px 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            margin: 0;
            font-size: 18x;
        }
        .invoice-details {
            width: 100%;
            margin-bottom: 20px;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details table td {
            padding: 8px;
            vertical-align: top;
        }
        .invoice-details table td:nth-child(2) {
            text-align: right;
        }
        .invoice-items {
            width: 100%;
            margin-bottom: 20px;
        }
        .invoice-items table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-items table th, .invoice-items table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-items table th {
            background-color: #f2f2f2;
        }
        .invoice-summary {
            width: 100%;
            margin-bottom: 20px;
        }
        .invoice-summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-summary table td {
            padding: 8px;
            text-align: right;
        }
        .invoice-summary table td:first-child {
            text-align: left;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="invoice-header">
       <div class="row">
        <div class="col-7"></div>
        <div class="col-5"></div>
       </div>
    </div>
    <div class="row">
        <div class="col-7">
            <h6>Invoice No: </h6>
        </div>
        <div class="col-5">
            <h6>Date:</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="border: 1px solid #000">
            <tr>
                <td>
                    <strong>From:</strong><br>
                    Name:<br>
                    Pan No:<br>
                    GST No:<br>
                    Address:
                    
                </td>
            </tr>
        </div>
        <div class="col-6" style="border: 1px solid #000">
            <tr>
                <td>
                    <strong>To:</strong><br>
                    Name:<br>
                    Pan No:<br>
                    GST No:<br>
                    Address:
                    
                </td>
            </tr>
        </div>
    </div>

    <div class="invoice-items mt-3">
        <table>
            <tr style="font-size: 14px;">
                <th>Sl.</th>
                <th>Product / Service Details</th>
                <th>Rate</th>
                <th>Number</th>
                <th>HSN / SAC</th>
                <th>Amount (Rs)</th>
            </tr>
            <tr>
                <td>1</td>
                <td><!-- Product / Service details --></td>
                <td><!-- Rate --></td>
                <td><!-- Number --></td>
                <td><!-- HSN / SAC --></td>
                <td><!-- Amount --></td>
            </tr>
            <tr>
                <td>2</td>
                <td><!-- Product / Service details --></td>
                <td><!-- Rate --></td>
                <td><!-- Number --></td>
                <td><!-- HSN / SAC --></td>
                <td><!-- Amount --></td>
            </tr>
            <tr>
                <td>3</td>
                <td><!-- Product / Service details --></td>
                <td><!-- Rate --></td>
                <td><!-- Number --></td>
                <td><!-- HSN / SAC --></td>
                <td><!-- Amount --></td>
            </tr>
            <tr>
                <td>4</td>
                <td><!-- Product / Service details --></td>
                <td><!-- Rate --></td>
                <td><!-- Number --></td>
                <td><!-- HSN / SAC --></td>
                <td><!-- Amount --></td>
            </tr>
            <tr>
                <td>5</td>
                <td><!-- Product / Service details --></td>
                <td><!-- Rate --></td>
                <td><!-- Number --></td>
                <td><!-- HSN / SAC --></td>
                <td><!-- Amount --></td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px;">Total Taxable Value</td>
                <td colspan="3"></td>
                <td></td>
            </tr> 
            <tr>
                <td colspan="2" style="font-size: 14px;">Add: CGST</td>
                <td colspan="3"></td>
                <td></td>
            </tr> 
            <tr>
                <td colspan="2" style="font-size: 14px;">Add: GST</td>
                <td colspan="3"></td>
                <td></td>
            </tr>  
            <tr>
                <td colspan="2" style="font-size: 14px;"><strong>Total Invoice Value</strong></td>
                <td colspan="3"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 14px;"><strong>Total in Words</strong></td>
                <td colspan="4" style="font-size: 10px;"></td>
            </tr>
            <tr>
                <td colspan="6" style="font-size: 9px;">Note : The invoice will be legally accepted after payment only. Any Compliances, Subject of Kolkata Jurisdiction only.</td>
            </tr>          
        </table>
    </div>
    <div class="row mt-3">
        <div class="col-7" style="border: 1px solid #000">
            <tr>
                <td>
                    <strong>Account Details:</strong><br>
                    A/C Holder Name:<br>
                    Bank Name:<br>
                    A/C No:<br>
                    IFSC Code:<br>
                    UPI No:
                </td>
            </tr>
        </div>
        <div class="col-5" style="border: 1px solid #000">
            <img src=""/>
            <p style="font-size: 8px; text-align: center;">Authorize Signeture With Seal</p>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
</body>
</html>
</div>
</div>
@endsection
