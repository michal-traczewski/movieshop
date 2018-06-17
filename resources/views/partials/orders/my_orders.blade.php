@if (count($orders) == 0)
    <h3> Nothing to display </h3>
@else
    <div class="container my-orders">          
        <table class="table table-bordered">
            <tr>
                <th>No. </th>
                <th>Order number</th>
                <th>Status</th>
                <th>Created</th>
                <th></th>
            </tr>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->order_id }}</td>
                    <td>{{ $order->description }}</td>
                    <td>{{ $order->created }}</td>
                    <td><a href="/myorders/{{ $order->order_id }}"><button class="btn btn-primary">Show</button></a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endif

@if (count($order_details))
    <div class="container order-details">          
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
            @foreach($order_details as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->title }}</td>
                    <td>{{ $detail->description }}</td>
                    <td>{{ $detail->price }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div id="btn-cancel-order">
        <a href="/myorders/{{ $current_order }}/cancel">
            <button class="btn btn-danger">
                <span class="glyphicon glyphicon-remove" ></span>Cancel order
            </button>
        </a>
    </div>
@endif
