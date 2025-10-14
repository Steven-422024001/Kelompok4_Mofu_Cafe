<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #d3d3d3;">

    <div class="container mt-5 mb-5 d-flex justify-content-center">
        <div class="card border-0 shadow-sm rounded" style="max-width: 600px; width: 100%;">
            <div class="card-body">
                <h3 class="mb-4 fw-bold text-center">Show Category</h3>
                <hr>
                <p><strong>ID:</strong> {{ $category->id }}</p>
                <hr>
                <p><strong>Name:</strong> {{ $category->name }}</p>
                <hr>
                <p><strong>Description:</strong></p>
                <div class="p-2 bg-light border rounded mb-3">
                    {!! $category->description !!}
                </div>
            </div>
            <div class="card-footer bg-white border-0 text-start">
                <a href="{{ route('category.index') }}" class="btn btn-secondary btn-sm">Back To List</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
