
@foreach($pnds as $pnd)
    <div class="col-md-3 mb-3">
        <div class="card text-center">
            <img src="{{ asset($pnd['image']) }}" class="card-img-top w-50 mx-auto" alt="{{ $pnd['name'] }}">
            <div class="card-body">
                <h5 class="card-title">{{ $pnd['name'] }}</h5>
                <p class="card-text">ราคา: {{ $pnd['price'] }} บาท</p>
                <label for="quantity{{ $loop->index }}">จำนวน:</label>
                <input type="number" id="quantity{{ $loop->index }}" name="quantity{{ $loop->index }}" class="form-control mb-2" min="1" value="1">
                <button type="button" class="btn btn-primary" onclick="addToCart('{{ $pnd['name'] }}', {{ $pnd['price'] }}, 'quantity{{ $loop->index }}')">สั่งซื้อ</button>
            </div>
        </div>
    </div>
@endforeach
