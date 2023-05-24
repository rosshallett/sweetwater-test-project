<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href="{{ asset('css/app.css') }}" rel="stylesheet">

		<style>
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}

		</style>

		<title>Customer Comments</title>
	</head>

	<body>
		<h1>Customer Comments:</h1>
		<table id="customer_comments_table">
			<tr>
				<th>'Call Me' Comments: {{ count($call_me_rows) }} rows</th>
			</tr>
			@foreach ($call_me_rows as $row)
				<tr>
					<td>{{ $row->orderid }}</td>
					<td>{{ $row->comments }}</td>
					<td>{{ $row->shipdate_expected }}</td>
				</tr>
			@endforeach
			<tr>
				<th>'Referral' Comments: {{ count($referred_rows) }} rows</th>
			</tr>
			@foreach ($referred_rows as $r_row)
				<tr>
					<td>{{ $r_row->orderid }}</td>
					<td>{{ $r_row->comments }}</td>
					<td>{{ $r_row->shipdate_expected }}</td>
				</tr>
			@endforeach
			<tr>
				<th>'Signature' Comments: {{ count($signature_rows) }} rows</th>
			</tr>
			@foreach ($signature_rows as $s_row)
				<tr>
					<td>{{ $s_row->orderid }}</td>
					<td>{{ $s_row->comments }}</td>
					<td>{{ $s_row->shipdate_expected }}</td>
				</tr>
			@endforeach
			<tr>
				<th>'Candy' Comments: {{ count($candy_rows) }} rows</th>
			</tr>
			@foreach ($candy_rows as $c_row)
				<tr>
					<td>{{ $c_row->orderid }}</td>
					<td>{{ $c_row->comments }}</td>
					<td>{{ $c_row->shipdate_expected }}</td>
				</tr>
			@endforeach
			<tr>
				<th>'Miscellaneous' Comments: {{ count($misc_rows) }} rows</th>
			</tr>
			@foreach ($misc_rows as $m_row)
				<tr>
					<td>{{ $m_row->orderid }}</td>
					<td>{{ $m_row->comments }}</td>
					<td>{{ $m_row->shipdate_expected }}</td>
				</tr>
			@endforeach
		</table>
	</body>
</html>