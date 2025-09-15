@extends('panel.layouts.app')
@include('panel.layouts.navbar')
@include('panel.layouts.sidebar')
@include('panel.layouts.footer')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <h1 class="h3 mb-3"><strong>Analytics</strong> Product</h1>
    <div class="row">
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Products</h5>
                </div>
                <div class="card-body">
                    <table id="products-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SKU</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#products-table').DataTable({
        serverSide: true,
        ajax: {
            url: '{{ route("panel.get.product") }}',
            type: 'GET'
        },
        pageLength: 10,
        columns: [
            { data: 'id' },
            { data: 'sku' },
            { data: 'name' },
            { data: 'price' },
            { data: 'category_name' },
            { data: 'status' }
        ]
    });
});
</script>
@endsection
