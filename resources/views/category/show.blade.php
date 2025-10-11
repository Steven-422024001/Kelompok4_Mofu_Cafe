<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <h3>Show Category</h3>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <hr/>
                        <p><strong>ID:</strong> {{ $category->id }}</p>
                        <hr/>
                        <p><strong>Name:</strong>{{ $category->name }}</p>
                        <hr/>
                        <p><strong>Description:</strong></p>
                        <div class="p-2 bg-light border rounded">
                            {!! $category->description !!}
                        </div>
                        <hr/>
                        <a href="{{ route('category.index') }}" class="btn btn-secondary mt-3">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
