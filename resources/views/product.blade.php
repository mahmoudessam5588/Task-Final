<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product Filter</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
</head>
<body>
    <select name="category" id="category">
        <option value="">Select Category</option>
        @if (count($categories) > 0)
            @foreach ($categories as $category)
             <option value="{{ $category['id'] }}">{{ $category->name }}</option>
            @endforeach      
        @endif
    </select>
    <br></br>
    <table border=1 width="50%">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Category_id</th>
        </tr>
        <tbody id="tbody">
        @if (count($products) > 0)
            @foreach ($products as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['price'] }}</td>
                <td>{{ $product['description'] }}</td>
                <td>{{ $product['category_id'] }}</td>
            </tr>
            @endforeach      
        @endif
        </tbody>    
    </table>
    <br></br>
    <script>
        $(document).ready(function(){
            $("#category").on('change',function(){
                var category = $(this).val();
                $.ajax({
                    url:"{{ route('filter') }}",
                    type:"GET",
                    data:{'category':category},
                    success:function(data){ 
                        console.log(data);
                        var products =  data.products;
                        var html = '';
                        if(products.length > 0){
                            for(let i=0 ; i<products.length; i++){
                                html +='<tr>\
                                        <td>'+(products[i]['id'])+'</td>\
                                        <td>'+products[i]['name']+'</td>\
                                        <td>'+products[i]['price']+'</td>\
                                        <td>'+products[i]['description']+'</td>\
                                        <td>'+products[i]['category_id']+'</td>\
                                        </tr>';
                            }
                        }
                        else{
                            html += '<tr>\
                                     <td>No Product Found<\td>\
                                    </tr>';

                        }
                        $("#tbody").html(html);
                    }
                }); 
            });
        });
    </script>
    
</body>
</html>