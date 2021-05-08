<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Bulbshare TechTask - fullstack</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/b-1.7.0/datatables.min.css"/>
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
    </tr>
    </tfoot>
</table>

<div id="modifyData" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <div class="modalHeader">
            <span class="close">&times;</span>
            <p>Update entry</p>
        </div>
        <div class="modalBody">
            @include('modalForm')
        </div>
        <div class="modalFooter">
            <input type="button" id="update" value="Update" class="button.dt-button">
        </div>
    </div>

</div>
<!-- DataTables JS -->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/b-1.7.0/datatables.min.js"></script>
</body>
</html>
