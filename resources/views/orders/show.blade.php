@if($order->status === 'In route' || $order->status === 'Delivered')
    <h3>Upload Evidence Photo</h3>

    <form action="{{ route('orders.photos.store', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="photo">Photo:</label>
        <input type="file" name="photo" required>

        <label for="photo_type">Photo Type:</label>
        <select name="photo_type" required>
            @if($order->status === 'In route')
                <option value="route">In route evidence</option>
            @endif

            @if($order->status === 'Delivered')
                <option value="delivered">Delivered evidence</option>
            @endif
        </select>

        <button type="submit">Upload</button>
    </form>
@endif