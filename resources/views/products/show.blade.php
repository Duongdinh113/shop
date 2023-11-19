<h1>Thông tin chi tiết sản phẩm</h1>
<li>Name        : {{$product->name}}</li>
<li>Thumbnail   : <img src="{{\Storage::url($product->thumbnail)}}" width="50" style="align-items: " alt=""></li>
<li>Price       : {{$product->price}}</li>
<li>Status      : {{$product->status}}</li>
<li>Created     : {{$product->createds}}</li>
<a href="{{route('products.index')}}">Quay lại</a>
