<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray;">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Add New Category</h3>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form id="categoryForm" action="{{ route('category.store') }}" method="POST">
                            @csrf

                            {{-- NAMA KATEGORI --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">CATEGORY NAME</label>
                                <input 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    placeholder="Masukkan Nama Kategori">
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- DESKRIPSI --}}
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">DESCRIPTION</label>
                                <textarea 
                                    class="form-control @error('description') is-invalid @enderror" 
                                    name="description" 
                                    id="description" 
                                    rows="5" 
                                    placeholder="Masukkan Deskripsi Kategori">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- TOMBOL --}}
                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            <button type="button" id="resetBtn" onclick="resetForm()" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{ route('category.index') }}" class="btn btn-md btn-secondary">BACK</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');

        function resetForm() {
            document.getElementById("categoryForm").reset();
            for (var instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].setData('');
            }
        }
    </script>
</body>
</html>
