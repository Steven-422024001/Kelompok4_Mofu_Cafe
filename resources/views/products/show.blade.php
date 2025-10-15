<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #d3d3d3;">

    <div class="container mt-5 mb-5 d-flex justify-content-center">
        <div class="row w-100" style="max-width: 900px;">
            <h3 class="mb-4 text-center fw-bold">Show Product</h3>

            {{-- Kolom Gambar --}}
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('/storage/images/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->title }}">
                    </div>
                </div>
            </div>

            {{-- Kolom Detail --}}
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3">{{ $product->title }}</h4>
                        <hr>
                        <p><strong>Category:</strong> {{ $product->product_category_name ?? 'N/A' }}</p>
                        <hr>
                        <p><strong>Supplier:</strong> {{ $product->supplier_name ?? 'N/A' }}</p>
                        <hr>
                        <p><strong>Price:</strong> {{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</p>
                        <hr>
                        <p><strong>Description:</strong></p>
                        <div class="p-2 bg-light rounded border">{!! $product->description ?? '<em>No description provided.</em>' !!}</div>
                        <hr>
                        <p><strong>Stock:</strong> {{ $product->stock }}</p>
                    </div>
                    <div class="card-footer bg-white border-0 text-end">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">
                            Back To List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
