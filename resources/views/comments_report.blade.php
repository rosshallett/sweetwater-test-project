<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Customer Comments</title>
	</head>

	<body>
		<h1>Customer Comments:</h1>
		<table id="customer_comments_table">
			<tr>
				<th>Start</th>
			</tr>
			@foreach ($data as $row)
				<tr>
					<td>{{ $row->orderid }}
				</tr>
			@endforeach
		</table>
	</body>
</html>