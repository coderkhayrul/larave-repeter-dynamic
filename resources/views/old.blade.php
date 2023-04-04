<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container my-4">
    <div class="row">
        <h2 class="text-center">Repetar Example</h2>
        <div class="col-md-12">
            <form action="{{ route('product.store') }}" method="POST">
                @csrf
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Category Name</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody class="tab">
                    <tr>
                        <th scope="row">
                            <select name="fatchData[0][categoryName]" id="category_id" class="form-control category_class">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th scope="row">
                            <select name="fatchData[0][productName]" id="product_id" class="form-control product_class"></select>
                        <td><input type="number" name="fatchData[0][priceName]" class="form-control" placeholder="Product Price"></td>
                        <td><button class="btn btn-success" name="add" id="add">Add</button></td>
                    </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        // Repeter Add Row Button
        $('#add').click(function (e) {
            let i = 0;
            e.preventDefault();
            $('.tab').append(
                `<tr>
                    <th>
                        <select name="category[${i}][categoryName]" id="category_id" class="form-control category_class">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <select name="product[${i}][productName]" id="product_id" class="form-control product_class">
                            <option value="">Select Product</option>
                        </select>
                    </th>
                    <td>
                        <input type="number" name="price[${i}][priceName]" class="form-control" placeholder="Product Price">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-table-row">X</button>
                    </td>
                </tr>`);
                i++;
            });
        // Repetar Remove Row Button
        $(document).on('click', '.remove-table-row', function () {
            $(this).closest('tr').remove();
        });
        // Repetar Category Select
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
                data: {category_id: category_id},
                success: function (data) {
                    tr.find('.product_class').html('');
                    tr.find('.product_class').append(`<option value="">Select Product</option>`);
                    $.each(data, function (key, value) {
                        tr.find('.product_class').append(`<option value="${value.id}">${value.product_name}</option>`);
                    });
                }
            });
            }else{
                console.log('Category Not Found');
            }
        });
    });
</script>
</body>
</html>
