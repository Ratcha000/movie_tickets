@extends('layout')

@section('content')

    <div class="container mt-4">
        <div class="text-left mb-4">
            <a href="{{ route('booking.index', ['id' => $selectedMovie->id]) }}" class="btn btn-secondary">
                กลับไปสู่การจอง
            </a>
        </div>
        <h1 class="text-center my-4">ชำระเงิน</h1>


        <!-- หน้ารายละเอียดหนัง
        
    ___ooooooo_____________oooooo
    __oo_____oooo________ooo____oo
    _oo_________oo____ooo________oo
    _oo__________oooooo___________oo
    __oo___________oo_____________oo
    ___oo_________________________oo
    ____o_________________________oo
    ____oo_______________________oo
    _____oo_____________________oo
    ______oo___________________oo
    ________oo________________oo
    _________oo_____________oo
    __________ooo_________ooo
    ____________oo_______oo
    ______________oo____oo
    ________________ooooo
    _________________oo-->
        <div class="container mt-4" id="DETAIL">
            <form id="paymentForm" action="{{ route('payment.submit') }}" method="POST">
                @csrf
                <div class="movie-item my-4 border rounded shadow-sm p-4 bg-light">
                    <h3 class="text-center"><b>รายละเอียดหนัง</b></h3>
                    <img src="{{ $selectedMovie->poster }}" alt="Movie Poster"
                        class="imgd d-block mx-auto"style="max-width: 300px;"">
                    <p class="name_m2 mt-4"><b>หนัง {{ $selectedMovie->name }}</b></p>
                    <p><b><span class="date_m2">รอบฉาย:</span> <span class="date_m2_2">{{ $selectedMovie->date }}</span></b></p>
                    <p><b><span class="time_m2">เวลา:</span> <span class="time_m2_2">{{ $selectedMovie->time }}</span></b></p>
                    <p class="loca_m2"><b>สถานที่:</b> {{ $selectedMovie->location }}</p>
                    <p class="map_m2"><b>แผนที่:</b> {{ $selectedMovie->map }}</p>
                    <p id="selectedSeats"><b>ที่นั่งที่เลือก: {{ implode(', ', $selectedTickets) }}</b></p>
                    <p id="PriceTicket"><b>ราคาตั๋วทั้งหมด: {{ $totalPrice }} บาท</b></p>
                    <p id="popcornDrinkSummary"><b>รายการป๊อปคอร์นและเครื่องดื่ม:</b></p>
                    <p id="totalPriceDisplay"><b>ราคาป๊อปคอร์นและเครื่องดี่มทั้งหมด: </b></p>
                    <p id="totalPriceDisplayx"><b>ราคารวมทั้งหมด: {{ $totalPrice }} บาท</b></p>

                    <!-- เก็บข้อมูลปอปตอน -->
                    <input type="hidden" id="popcornSummary" name="popcornSummary">
                    <input type="hidden" id="pricepopcornSummary" name="pricepopcornSummary">


                    <button type="button" class="btn btn-secondary mt-4 w-50 my-4 d-block mx-auto" onclick="buypop()">ซื้อป็อปคอนและเครื่องดื่ม</button>
                    

                    <div class="mb-4 border rounded shadow-sm p-4 bg-light">
                        <h4 class="text-center"><b>วิธีชำระเงิน</b></h4>
                        <!-- ฟิลด์สำหรับกรอกโค้ดส่วนลด -->
                        <label for="discountCode" class="form-label">ใส่โค้ดส่วนลด (ถ้ามี):</label>
                        <input type="text" id="discountCode" class="form-control mb-3" placeholder="กรอกโค้ดส่วนลด">
                        <button type="button" class="btn btn-primary w-100 mb-3" onclick="applyDiscount()">ใช้โค้ดส่วนลด</button>

                        <!-- ตัวเลือกการชำระเงิน -->
                        <label for="payment_method" class="form-label">เลือกวิธีชำระเงิน:</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="promptpay">Promptpay</option>
                            <option value="paypal">PayPal</option>
                        </select>

                        <button type="button" class="btn btn-success mt-3 w-100" onclick="submitPayment()">ชำระเงิน</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- แถวรายการป๊อปคอร์น และ แถวรายการเครื่องดื่ม -->
        <div class="d-none" id='CART'>
            <div class="row" id="menuContainer">
                <h3 class="mb-4">เลือกซื้อป๊อปคอร์นและเครื่องดื่ม</h3>
                @include('jame/menu', ['pnd' => $pnds])
            </div>
        
            <!-- ตะกร้าแสดงรายการที่เลือกและราคารวม -->
            <div class="container mt-5" id="cartContainer">
                <h4>รายการที่คุณเลือก:</h4>
                <ul id="cartItems" class="list-group mb-3">
                    <!-- รายการจะถูกแสดงที่นี่ -->
                </ul>
                <h4>ราคารวมทั้งหมด: <span id="totalPrice">0</span> บาท</h4>
            
                <button class="btn btn-success mt-3" onclick="poped()">ต่อไป</button>

            </div>
        </div>
        <script>
            let cart = [];
            let totalPrice = 0;
            let ticketPrice = {{ $totalPrice }};
            let tcost = ticketPrice + totalPrice;
            /*
             */

            function addToCart(item, price, quantityInputId) {
                const quantity = parseInt(document.getElementById(quantityInputId).value);

                if (!isNaN(quantity) && quantity > 0) {
                    const existingItemIndex = cart.findIndex(cartItem => cartItem.item === item);

                    if (existingItemIndex !== -1) {
                        const existingItem = cart[existingItemIndex];
                        existingItem.quantity += quantity;
                        existingItem.total = existingItem.price * existingItem.quantity;
                        totalPrice += existingItem.price * quantity;
                    } else {
                        const itemTotal = price * quantity;
                        cart.push({
                            item: item,
                            price: price,
                            quantity: quantity,
                            total: itemTotal
                        });
                        totalPrice += itemTotal;
                    }

                    updateCart();
                } else {
                    alert("กรุณาเลือกจำนวนสินค้าที่ถูกต้อง");
                }
            }

            function updateCart() {
                const cartItems = document.getElementById('cartItems');
                const totalPriceDisplay = document.getElementById('totalPrice');

                cartItems.innerHTML = '';

                cart.forEach((cartItem, index) => {
                    const li = document.createElement('li');
                    li.classList.add('list-group-item');
                    li.textContent = `${cartItem.item} x ${cartItem.quantity} = ${cartItem.total} บาท`;

                    const removeButton = document.createElement('button');
                    removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-3');
                    removeButton.textContent = 'ลบ';
                    removeButton.onclick = () => removeFromCart(index);

                    li.appendChild(removeButton);
                    cartItems.appendChild(li);
                });

                totalPriceDisplay.textContent = totalPrice;
                tcost = ticketPrice + totalPrice; // อัปเดตราคารวมตั๋วและป๊อปคอร์น

                // อัปเดตรายการป๊อปคอร์นในฟิลด์ซ่อน
                document.getElementById('popcornSummary').value = cart.map(item => `${item.item} x ${item.quantity}`).join(
                '\n');
                document.getElementById('pricepopcornSummary').value = totalPrice;

            }

            function removeFromCart(index) {
                const itemToRemove = cart[index];
                totalPrice -= itemToRemove.total;
                cart.splice(index, 1);
                updateCart();
            }

            function poped() {
                document.getElementById('DETAIL').classList.remove('d-none'); // ซ่อนตะกร้า// แสดงรายละเอียดหนัง
                document.getElementById('CART').classList.add('d-none'); // ซ่อนตะกร้า

                const totalPriceDisplay = document.getElementById('totalPriceDisplay');
                totalPriceDisplay.innerHTML = `<b>ราคาป๊อปคอร์นและเครื่องดี่มทั้งหมด: </b>${totalPrice} บาท`;


                //คำนวณราคารวมทั้งหมด
                tcost = ticketPrice + totalPrice;

                const totalPriceDisplayx = document.getElementById('totalPriceDisplayx');
                totalPriceDisplayx.innerHTML = `<b>ราคารวมทั้งหมด: </b>${tcost} บาท`;

                // แสดงรายการป๊อปคอร์นและเครื่องดื่มที่สั่งซื้อ
                const popcornDrinkSummary = document.getElementById('popcornDrinkSummary');
                popcornDrinkSummary.innerHTML =
                    `<b>รายการป๊อปคอร์นและเครื่องดื่ม:</b><br>${cart.map(item => `${item.item} x ${item.quantity}`).join('<br>')}`;
            }

            let discount = 0;

            function applyDiscount() {
                const discountCode = document.getElementById('discountCode').value.trim();
                const validDiscountCodes = {
                    'WEBPROGRADEA': 1.0,
                    'PUNPUN': 0.69,
                    'WELCOMEUSER': 0.5,
                    'LUCKYDAY': 0.77,
                    'BADDAY': 0.01,
                    'CSKKU': 0.1,
                    'CPKKU': 0.1,
                    'SECRETDISCOUNT': 1.0,
                    'HYUNGSEOK': 0.3,
                    'SIGMAPLEX': 0.99
                };

                if (validDiscountCodes.hasOwnProperty(discountCode)) {
                    discount = validDiscountCodes[discountCode];
                    const discountAmount = tcost * discount;
                    const finalPrice = tcost - discountAmount;

                    // อัปเดตราคารวมใหม่หลังจากใช้ส่วนลด
                    document.getElementById('totalPriceDisplayx').textContent =
                        `ราคารวมทั้งหมด: ${finalPrice.toFixed(2)} บาท (ลด ${discountAmount.toFixed(2)} บาท)`;

                    alert(`โค้ดส่วนลดถูกใช้! คุณได้ลด ${discountAmount.toFixed(2)} บาท`);
                } else {
                    alert('โค้ดส่วนลดไม่ถูกต้อง หรือไม่มีโค้ดนี้');
                }
            }



            function submitPayment() {
                // ตรวจสอบราคาหลังหักส่วนลด
                const finalPrice = tcost - (tcost * discount);
                const discountAmount = tcost * discount;

                // อัปเดต hidden input fields เพื่อส่งข้อมูลไปยัง server
                const finalPriceInput = document.createElement('input');
                finalPriceInput.type = 'hidden';
                finalPriceInput.name = 'final_price';
                finalPriceInput.value = finalPrice.toFixed(2);
                document.getElementById('paymentForm').appendChild(finalPriceInput);

                const discountAmountInput = document.createElement('input');
                discountAmountInput.type = 'hidden';
                discountAmountInput.name = 'discount_amount';
                discountAmountInput.value = discountAmount.toFixed(2);
                document.getElementById('paymentForm').appendChild(discountAmountInput);

                // แสดงการยืนยันการชำระเงิน
                if (confirm(`ยืนยันการชำระเงิน ยอดชำระเงินทั้งหมด: ${finalPrice.toFixed(2)} บาท`)) {
                    // หากผู้ใช้ยืนยัน ให้ส่งฟอร์มการชำระเงิน
                    document.getElementById('paymentForm').submit();
                } else {
                    // หากผู้ใช้กด Cancel ไม่ต้องดำเนินการใด ๆ
                    return;
                }
            }

            function buypop() {
                document.getElementById('CART').classList.remove('d-none'); // ซ่อนรายละเอียด
                document.getElementById('DETAIL').classList.add('d-none'); // แสดงตะกร้า
            }
        </script>
@endsection
