<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bulbshare TechTask - fullstack</title>
    <!-- DataTables CSS -->
    <link id="theme-style" rel="stylesheet" href="http://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link id="theme-style" rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<table id="data" class="display" style="width:100%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Company</th>
        <th>Last name</th>
        <th>First name</th>
        <th>Email</th>
        <th>Job title</th>
        <th>Business phone</th>
        <th>Address</th>
        <th>City</th>
        <th>Zip/Postal code</th>
        <th>Country/Region</th>
        <th>Orders total</th>
        <th>Orders total value</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>ID</th>
        <th>Company</th>
        <th>Last name</th>
        <th>First name</th>
        <th>Email</th>
        <th>Job title</th>
        <th>Business phone</th>
        <th>Address</th>
        <th>City</th>
        <th>Zip/Postal code</th>
        <th>Country/Region</th>
        <th>Orders total</th>
        <th>Orders total value</th>
    </tr>
    </tfoot>
</table>
<!-- DataTables JS -->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</body>
</html>
