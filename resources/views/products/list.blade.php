<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product List | Laravel CRUD</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .strikethrough {
            text-decoration: line-through;
            color: gray;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid #ddd;
        }
        .table th {
            background-color: #343a40;
            color: white;
            text-align: center;
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
                <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>

        <div class="row justify-content-center">
            @if (Session::has('success'))
                <div class="col-md-10 mt-4">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
            
            <div class="col-md-10">
                <div class="card shadow-lg my-4">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Product List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Sku</th>
                                    <th>Price</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($products->isNotEmpty())
                                    @foreach($products as $product)
                                        <tr id="row{{ $product->id }}">
                                            <td>{{ $product->id }}</td>                                
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                @if(!empty($product->image))
                                                    <img class="product-image" width="50" src="{{ asset('/uploads/products/'.$product->image) }}" alt="Product Image">
                                                @endif
                                            </td>
                                            <td>{{ $product->sku }}</td>
                                            <td>${{ number_format($product->price, 2) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                            <td>
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-dark">Edit</a>
                                                <button class="btn btn-sm btn-danger deleteProduct" data-id="{{ $product->id }}">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-muted">No products found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>                 
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".deleteProduct").click(function () {
                var productId = $(this).data("id");
                var row = $("#row" + productId);

                if(confirm("Are you sure you want to delete this product?")){
                    $(this).closest("tr").addClass("strikethrough");
                    // $.ajax({
                    //     url: "/products/" + productId,
                    //     type: "POST",
                    //     data: {
                    //         _method: "DELETE",
                    //         _token: "{{ csrf_token() }}"
                    //     },
                    //     success: function(response) {
                    //         row.fadeOut(500, function() {
                    //             $(this).remove();
                    //         });
                    //     },
                    //     error: function(response) {
                    //         alert("Error deleting product. Please try again.");
                    //     }
                    // });
                }
            });
        });
    </script>
</body>
</html>
