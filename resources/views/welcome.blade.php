<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container my-4">
    <div class="row my-3">
        <h3 class="text-center text-primary">Repetar Example</h3>
        <form class="repeater" action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="card p-0">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="text-center">Add Category Product</h3>
                    <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add" />
                </div>
                <div class="card-body">
                    <div class="my-3">

                    </div>
                    <div data-repeater-list="categoryProduct">
                        <div data-repeater-item class="row my-3">
                            <div class="col-md-3">
                                <select name="fatchData[0][categoryName]" id="category_id"
                                    class="form-control category_class">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="fatchData[0][productName]" id="product_id" class="form-control product_class">
                                <option value="">Select Product</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="fatchData[0][priceName]" class="form-control"
                                    placeholder="Product Price">
                            </div>
                            <div class="col-md-3">
                                <input data-repeater-delete type="button" class="btn btn-danger" value="X" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('form-repeater.int.js') }}"></script>

    <script>
        $(document).on('change', '.category_class', function () {
            let category_id = $(this).val();
            let tr = $(this).parent().parent();
            let url = "{{ route('category.product') }}";
            if (category_id) {
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        category_id: category_id
                    },
                    success: function (data) {
                        tr.find('.product_class').html('');
                        tr.find('.product_class').append(
                        `<option value="">Select Product</option>`);
                        $.each(data, function (key, value) {
                            tr.find('.product_class').append(
                                `<option value="${value.id}">${value.product_name}</option>`
                                );
                        });
                    }
                });
            } else {
                console.log('Category Not Found');
            }
        });
    </script>

<script>
    @if (Session::has('success'))
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '{{ Session::get('success') }}',
            showConfirmButton: false,
            timer: 1500
        })
    @endif
</script>
</body>

</html>
