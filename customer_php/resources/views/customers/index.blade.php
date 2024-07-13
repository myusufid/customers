<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS for Datatables -->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>

<div class="container bg-white p-3 rounded mt-5 col-lg-10">
    <h2 class="fw-bold">CUSTOMERS</h2>
    <button id="add-customer" class="btn btn-primary mb-2">Add Customer</button>
    <table id="customers-table" class="display" style="width:100%"></table>
</div>

<!-- Include JQuery from CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<!-- Include DataTables Js from CDN -->
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("customers.data") }}',
            columns: [
                { title: 'ID', data: 'cst_id' },
                { title: 'Name', data: 'cst_name' },
                { title: 'Email', data: 'cst_email' },
                { title: 'Phone', data: 'cst_phoneNum' },
                { title: 'Actions', data: 'action', orderable: false, searchable: false }
            ]
        });

        $('#add-customer').click(function() {
            window.location.href = '{{ route("customers.create") }}';
        });
    });
</script>
</body>
</html>
