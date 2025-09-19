@extends('panel.layouts.app')
@include('panel.layouts.navbar')
@include('panel.layouts.sidebar')
@include('panel.layouts.footer')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <style>
        .product-detail-card {
            transition: all 0.3s ease;
        }

        .product-detail-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .modal-xl {
            max-width: 1200px;
        }

        .detail-btn {
            transition: all 0.2s ease;
        }

        .detail-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* AdminKit compatible styles */
        .table th {
            border-top: none;
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .card {
            border: 1px solid #dee2e6;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
        }

        .modal-header {
            border-bottom: 1px solid #dee2e6;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
        }

        /* Custom modal styling for AdminKit */
        .modal-content {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Loading spinner */
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
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
                        <thead class="table-light">
                            <tr>
                                <th>Action</th>
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

    <!-- Product Detail Modal -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold" id="productDetailModalLabel">
                        <i class="align-middle me-2" data-feather="package"></i>
                        Product Detail
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="productDetailContent">
                    <!-- Content will be loaded here -->
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-muted">Loading product details...</p>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="align-middle me-2" data-feather="x"></i>
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Feather icons
            feather.replace();

            var table = $('#products-table').DataTable({
                serverSide: true,
                ajax: {
                    url: '{{ route('panel.get.product') }}',
                    type: 'GET'
                },
                pageLength: 10,
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                     '<"row"<"col-sm-12"tr>>' +
                     '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                columns: [{
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'sku'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'category_name'
                    },
                    {
                        data: 'status'
                    }
                ],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });

            // Handle detail button click
            $('#products-table').on('click', '.detail-btn', function() {
                var productId = $(this).data('id');
                $.get('{{ url('/panel-get-product-detail') }}/' + productId)
                    .done(function(data) {
                        populateModal(data);
                        $('#productDetailModal').modal('show');
                    })
                    .fail(function() {
                        alert('Failed to load product details');
                    });
            });

            function populateModal(data) {
                var content = `
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card product-detail-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="align-middle me-2" data-feather="info"></i>
                                Basic Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">ID</label>
                                    <p class="text-muted mb-2">${data.id}</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">SKU</label>
                                    <p class="text-muted mb-2">${data.sku}</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Code</label>
                                    <p class="text-muted mb-2">${data.code}</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Name</label>
                                    <p class="text-muted mb-2">${data.name}</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Price</label>
                                    <p class="text-success fw-bold mb-2">Rp ${parseFloat(data.price).toLocaleString('id-ID')}</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Weight</label>
                                    <p class="text-muted mb-2">${data.weight || 'N/A'}</p>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold">Description</label>
                                    <p class="text-muted mb-2">${data.description || 'N/A'}</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Status</label>
                                    <p class="mb-2">${data.is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'}</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Created</label>
                                    <p class="text-muted mb-2">${new Date(data.created_at).toLocaleDateString('id-ID')}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card product-detail-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="align-middle me-2" data-feather="folder"></i>
                                Category
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Name</label>
                                    <p class="text-muted mb-2">${data.category ? data.category.name : 'N/A'}</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold">Code</label>
                                    <p class="text-muted mb-2">${data.category ? data.category.code : 'N/A'}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card product-detail-card mt-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="align-middle me-2" data-feather="dollar-sign"></i>
                                HPP Values
                            </h5>
                        </div>
                        <div class="card-body">
                            ${data.hpp_values && data.hpp_values.length > 0 ? data.hpp_values.map(hpp => `
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                        <div>
                                            <strong>${hpp.hpp_percentage}%</strong>
                                            <br><small class="text-muted">Rp ${parseFloat(hpp.hpp_value).toLocaleString('id-ID')}</small>
                                        </div>
                                        <span class="badge ${hpp.is_active ? 'bg-success' : 'bg-secondary'}">${hpp.is_active ? 'Active' : 'Inactive'}</span>
                                    </div>
                                `).join('') : '<p class="text-muted mb-0">No HPP values</p>'}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12 col-lg-6">
                    <div class="card product-detail-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="align-middle me-2" data-feather="shopping-cart"></i>
                                Channel Pricings
                            </h5>
                        </div>
                        <div class="card-body">
                            ${data.channel_pricings && data.channel_pricings.length > 0 ? data.channel_pricings.map(cp => `
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                        <div>
                                            <strong>Qty: ${cp.min_qty} - ${cp.max_qty}</strong>
                                            <br><small class="text-muted">Rp ${parseFloat(cp.selling_price).toLocaleString('id-ID')}</small>
                                        </div>
                                    </div>
                                `).join('') : '<p class="text-muted mb-0">No channel pricings</p>'}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card product-detail-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="align-middle me-2" data-feather="layers"></i>
                                Product Channels
                            </h5>
                        </div>
                        <div class="card-body">
                            ${data.product_channels && data.product_channels.length > 0 ? data.product_channels.map(pc => `
                                    <div class="border-bottom py-2">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>${pc.name}</strong>
                                                <br><small class="text-muted">${pc.code}</small>
                                            </div>
                                            <div class="text-end">
                                                <small class="text-muted">Qty: ${pc.pivot.min_qty} - ${pc.pivot.max_qty || '∞'}</small>
                                                <br><strong class="text-primary">Rp ${parseFloat(pc.pivot.selling_price).toLocaleString('id-ID')}</strong>
                                            </div>
                                        </div>
                                    </div>
                                `).join('') : '<p class="text-muted mb-0">No product channels</p>'}
                        </div>
                    </div>
                </div>
            </div>

            ${data.bundles && data.bundles.length > 0 ? `
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card product-detail-card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="align-middle me-2" data-feather="package"></i>
                                    Bundles
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    ${data.bundles.map(b => `
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="card border">
                                            <div class="card-body">
                                                <h6 class="card-title">${b.name}</h6>
                                                <p class="card-text">
                                                    <strong>SKU:</strong> ${b.sku}<br>
                                                    <strong>Price:</strong> Rp ${parseFloat(b.price).toLocaleString('id-ID')}<br>
                                                    <strong>Qty in Bundle:</strong> ${b.pivot.qty}<br>
                                                    <strong>Price in Bundle:</strong> <span class="text-success">Rp ${parseFloat(b.pivot.price).toLocaleString('id-ID')}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                `).join('')}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ` : ''}
        `;
                $('#productDetailContent').html(content);

                // Re-initialize Feather icons for the modal
                feather.replace();
            }
        });
    </script>
@endsection
