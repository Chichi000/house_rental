{{-- <!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
</head>
<body>
    <header>
    <div align="center">
    <p class="fst-italic">Web-Base House Rental Property Management Platform System.</p>
    </div>
    <div>
    <p style="margin:0;display:inline;float:left">Tenant Name: <strong>{{ $orders->fname }}</strong></p>
    </div>
    </header>
 <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Service</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <tr>
      <th scope="row">{{ $orders->id }}</th>
      <td>{{ $orders->Description }}</td>
      <td>${{ $orders->Rent }}</td>
    </tr>
    <tr>
        <td colspan="2" align="right"><strong>Grandtotal:</strong></td>
        <td><strong>${{ $orders->Total }}</strong></td>
    </tr>
    <tr>
  </tbody>
</table>


<hr style="border: 2px solid black;">
<footer>
    <div align="center" class="d-grid gap-1">
    <p class="fw-semibold">Thanks for supporting local business!</p>
    <p class="fst-italic">For any doubts you can contact us</p>
    </div>
</footer>

</body>
</html> --}}


<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
		}

		h1 {
			font-size: 24px;
			margin-bottom: 20px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		table td, table th {
			padding: 10px;
			border: 1px solid #ddd;
		}

		table th {
			background-color: #f2f2f2;
		}

		.total {
			font-weight: bold;
			font-size: 16px;
		}

		.footer {
			margin-top: 20px;
			text-align: center;
			color: #999;
		}
	</style>
</head>
<body>
    <header>
         <h1 align="center">Receipt</h1>
        <div align="center">
    <p class="fst-italic">Web-Base House Rental Property Management Platform System.</p>
    </div>
    <div>
    <p style="margin:0;display:inline;float:left">Tenant Name: <strong>{{ $orders->lname }}, {{ $orders->fname }}</strong></p>
    </div>
    </header>
	<table>
		<thead>
			<tr>
				<th>Area</th>
				<th>Address</th>
                <th>State</th>
                <th>City</th>
                <th>Description</th>
                <th>CheckIn</th>
                <th>CheckOut</th>
                 <th>Total payment</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ $orders->Area }}</td>
				<td>{{ $orders->Address }}</td>
				<td>{{ $orders->State }}</td>
                <td>{{ $orders->City }}</td>
				<td>{{ $orders->Description }}</td>
				<td>{{ $orders->CheckIn }}</td>
                <td>{{ $orders->CheckOut }}</td>
                  <td>{{ $orders->Total }}</td>
			</tr>
		</tbody>
	</table>
<hr style="border: 2px solid black;">
<footer>
    <div align="center" class="d-grid gap-1">
    <p class="fw-semibold">Thanks for supporting local business!</p>
    <p class="fst-italic">For any doubts you can contact us</p>
    </div>
</footer>
</body>
</html>