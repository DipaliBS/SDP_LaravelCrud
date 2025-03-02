<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Product | Laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-lg {
            border-radius: 8px;
        }
    </style>
  </head>
  <body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Laravel CRUD</h3>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg my-4">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Create Product</h4>
                    </div>
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Product Name" name="name">
                                @error('name')
                                <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">SKU</label>
                                <input type="text" value="{{ old('sku') }}" class="form-control @error('sku') is-invalid @enderror" placeholder="Product SKU" name="sku">
                                @error('sku')
                                <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="text" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror" placeholder="Product Price" name="price">
                                @error('price')
                                <p class="invalid-feedback"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea placeholder="Product Description" class="form-control" name="description" rows="4">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Availability</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="availability" value="yes" {{ old('availability') == 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="availability" value="no" {{ old('availability') == 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Country</label>
                                <select class="form-control" name="country">
                                    <option value="">Select Country</option>
                                    <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>USA</option>
                                    <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                    <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Product Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
