<title>{{ $promotion->title }}</title>
@extends('layout')
@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./script.js"></script>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="mb-4 text-success">{{ $promotion->title }}</h2>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6 text-center">
                <img src="{{ $promotion->image }}" alt="{{ $promotion->title }}" class="img-fluid rounded"
                    style="max-height: 500px">
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center">
                <button class="btn btn-success btn-lg mb-4" id="redeemButton">แลกสิทธิ์โปรโมชั่น</button>
                <input type="text" id="promoCode" class="form-control text-center" readonly>

                <div class="mt-4">
                    <h5 class="text-success">รายละเอียดสินค้า</h5>
                    <p>{!! nl2br(e($promotion->description)) !!}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const discountData = [
            { code: 'WEBPROGRADEA', discount: 1.0, weight: 1 },
            { code: 'PUNPUN', discount: 0.69, weight: 33 },
            { code: 'WELCOMEUSER', discount: 0.5, weight: 40 },
            { code: 'LUCKYDAY', discount: 0.77, weight: 5 },
            { code: 'BADDAY', discount: 0.01, weight: 80 },
            { code: 'CSKKU', discount: 0.1, weight: 50 },   
            { code: 'CPKKU', discount: 0.1, weight: 50 },
            { code: 'SECRETDISCOUNT', discount: 1.0, weight: 1 },
            { code: 'HYUNGSEOK', discount: 0.3, weight: 30 },
            { code: 'SIGMAPLEX', discount: 0.99, weight: 2 }
        ];

        function weightedRandomSelect(discountData) {
            let totalWeight = 0;

            discountData.forEach(item => {
                totalWeight += item.weight;
            });
    
            const randomNum = Math.random() * totalWeight;
            let runningWeight = 0;

            for (const item of discountData) {
                runningWeight += item.weight;
                if (randomNum < runningWeight) {
                    return item;
                }
            }
        }
    
        document.getElementById('redeemButton').addEventListener('click', function() {
            const selectedItem = weightedRandomSelect(discountData);
            
            document.getElementById('promoCode').value = selectedItem.code;
            
            alert(`โค้ดที่สุ่มได้คือ: ${selectedItem.code} ส่วนลด: ${selectedItem.discount * 100}%`);
        });
    </script>   
@endsection
