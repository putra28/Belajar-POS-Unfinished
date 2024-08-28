@extends('app')
@section('content')
    <!-- content -->
    <title>{{ $title }}</title>
    <div class="row">
        <div class="col-md-8">
            <!-- Bagian kiri untuk menampilkan card produk -->
            <h2>{{ $title }}</h2>
            <hr>
            <div class="btn-group mb-3" role="group" aria-label="Filter By Category"
                style="background: linear-gradient(to right, #2D3250, #424769);">
                <button type="button" class="btn btn-outline-light" data-bs-toggle="button" data-bs-category="all"
                    id="all">Semua</button>
                <button type="button" class="btn btn-outline-light" data-bs-toggle="button" data-bs-category="Main Course"
                    id="main-course">Main Course</button>
                <button type="button" class="btn btn-outline-light" data-bs-toggle="button" data-bs-category="Snack"
                    id="snack">Snack</button>
                <button type="button" class="btn btn-outline-light" data-bs-toggle="button" data-bs-category="Rice"
                    id="rice">Rice</button>
                <button type="button" class="btn btn-outline-light" data-bs-toggle="button" data-bs-category="Noodle"
                    id="noodle">Noodle</button>
                <button type="button" class="btn btn-outline-light" data-bs-toggle="button" data-bs-category="Beverages"
                    id="beverages">Beverages</button>
                <button type="button" class="btn btn-outline-light" data-bs-toggle="button" data-bs-category="Desserts"
                    id="desserts">Desserts</button>
                <button type="button" class="btn btn-outline-light" data-bs-toggle="button"
                    data-bs-category="Special Series" id="special-series">Special Series</button>
            </div>
            <table class="table table-bordered table-hovered table-striped" id="productTable" style="font-size: 80%">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $categoryName => $subcategories)
                        @foreach ($subcategories as $subCategoryName => $products)
                            @foreach ($products as $product)
                                <tr style="cursor: pointer" class="add-to-cart-button"
                                    data-name="{{ $product['nama_produk'] }}" data-price="{{ $product['harga_produk'] }}">
                                    <td>{{ $categoryName }}</td>
                                    <td>{{ $subCategoryName }}</td>
                                    <td>{{ $product['nama_produk'] }}</td>
                                    <td>Rp. {{ number_format($product['harga_produk'], 0, ',', '.') }}</td>
                                    <td>{{ $product['stok_produk'] }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <h3>Keranjang</h3>
            <div class="card sticky-top" style="top: 50px">
                <div class="card-body">
                    <h5 class="card-title">Detail Keranjang</h5>
                    <form action="{{ URL::asset('/kasir/transaksi/add') }}" method="POST" enctype="multipart/form-data"
                        id="checkoutForm">
                        @csrf
                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" id="member_transaksi"
                                name="member_transaksi" required>
                                <option selected value="1">Non - Member</option>
                                <option value="1" data-db-value="1">Test</option>
                                <option value="2" data-db-value="2">Test2</option>
                            </select>
                            <label for="member_transaksi">Member</label>
                        </div>
                        <!-- Informasi barang -->
                        <div class="mb-1" id="card-details">
                            <label class="form-label">Barang</label>
                        </div>
                        <hr>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <div class="form-floating is-invalid">
                                <input type="hidden" class="form-control-plaintext border-0" id="totalPriceRaw"
                                    name="totalharga_transaksi" readonly>
                                <input type="text" class="form-control-plaintext border-0" id="totalPrice" readonly>
                                <label for="harga_addproduk">Total Harga :</label>
                            </div>
                        </div>
                        <hr>
                        <!-- Total Bayar dan Kembalian -->
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <div class="form-floating is-invalid">
                                <input type="text" class="form-control-plaintext border-0" id="totalPayment"
                                    name="totalbayar_transaksi">
                                <label for="harga_addproduk">Total Bayar :</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <div class="form-floating is-invalid">
                                <input type="hidden" class="form-control-plaintext border-0" id="changeRaw"
                                    name="kembalian_transaksi" readonly>
                                <input type="text" class="form-control-plaintext border-0" id="change" readonly>
                                <label for="harga_addproduk">Kembalian :</label>
                            </div>
                        </div>
                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                        <!-- Tombol Clear Keranjang -->
                        <button type="button" class="btn btn-danger" id="clearCart">Clear Keranjang</button>
                        <input type="hidden" id="cartData" name="cartData">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        new DataTable('#productTable');
        $(document).ready(function() {
            var cartItems = [];

            // Function to add product to cart
            function addToCart(product) {
                var productName = product.data('name');
                var productPrice = parseInt(product.data('price'));
                var discountPrice = parseInt(product.data('diskon'));

                // Inisialisasi kuantitas produk baru dengan 1
                var quantity = 1;

                // Cari produk yang sudah ada di keranjang
                var existingProduct = $('#card-details').find('input[value="' + productName + '"]').closest('.row');

                if (existingProduct.length) {
                    // Jika produk sudah ada di keranjang, tambahkan kuantitasnya
                    var quantity = parseInt(existingProduct.find('.product-quantity').val().replace('x', ''));
                    quantity++;
                    existingProduct.find('.product-quantity').val(quantity + 'x');
                } else {
                    // Jika produk belum ada di keranjang, tambahkan produk baru
                    var formattedPrice = 'Rp. ' + productPrice.toLocaleString('id-ID');

                    // Append product details to cart
                    $('#card-details').append(
                        '<div class="mb-1">' +
                        '<div class="row">' +
                        '<div class="col-md-5">' +
                        '<input type="text" class="form-control-plaintext border-0 product-name" value="' +
                        productName +
                        '" readonly>' +
                        '</div>' +
                        '<div class="col-md-5">' +
                        '<input type="text" class="form-control-plaintext border-0 product-priceshow" value="' +
                        formattedPrice + '"  readonly>' +
                        '<input type="hidden" class="product-price" value="' +
                        productPrice.toFixed(0) + '"  readonly>' +
                        '<input type="hidden" class="product-discount" value="' +
                        discountPrice + '"  readonly>' +
                        '</div>' +
                        '<div class="col-md-2">' +
                        '<input type="text" class="form-control-plaintext border-0 product-quantity" value="1x" readonly>' +
                        '</div>' +
                        '</div>'
                    );
                }

                // Recalculate total price
                calculateTotalPrice();
            };

            // Function to calculate total price
            function calculateTotalPrice() {
                var totalPrice = 0;
                $('.product-price').each(function() {
                    var price = parseInt($(this).val().replace('Rp. ', ''));
                    var quantity = parseInt($(this).closest('.row').find('.product-quantity').val());
                    totalPrice += price * quantity;
                });
                $('#totalPrice').data('raw-value', totalPrice);
                $('#totalPriceRaw').val(totalPrice.toFixed(0));
                $('#totalPrice').val(totalPrice.toLocaleString('id-ID'));
            }

            // Event listener for 'Tambahkan ke Keranjang' button click
            $(document).on('click', '.add-to-cart-button', function() {
                var product = $(this);
                addToCart(product);
            });

            // Function to collect cart data into an array
            function collectCartData() {
                var cartData = [];
                $('.row').each(function() {
                    var productName = $(this).find('.product-name').val();
                    var productPrice = parseFloat($(this).find('.product-price').val());
                    var quantity = parseInt($(this).find('.product-quantity').val());
                    var discount = parseInt($(this).find('.product-discount').val());
                    if (productName) { // Add check if productName is not empty
                        cartData.push({
                            namaproduk_transaksi: productName,
                            hargaproduk_transaksi: productPrice,
                            kuantitas_transaksi: quantity,
                            potongan_transaksi: discount
                        });
                    }
                });
                // Update the value of the hidden input field
                $('#cartDataInput').val(JSON.stringify(cartData));
                return cartData;
            }

            // Event listener for change in product quantity
            $(document).on('input', '.product-quantity', function() {
                calculateTotalPrice();
            });

            // Event listener for total payment change
            $("#totalPayment").on("input", function() {
                calculateChange();
            });

            // Function to calculate change
            function calculateChange() {
                var totalPayment = parseFloat($("#totalPayment").val());
                if (isNaN(totalPayment) || totalPayment === 0) {
                    $('#change').val('');
                    $("#changeRaw").val('');
                    return;
                }
                var totalPriceRaw = parseFloat($("#totalPrice").data('raw-value'));
                var change = totalPayment - totalPriceRaw;
                $('#change').val(change.toLocaleString('id-ID'));
                $("#changeRaw").val(change.toFixed(0));
            }

            // Event listener for form submission
            $("#checkoutForm").submit(function(event) {
                event.preventDefault(); // Prevent form submission
                // Collect cart data into array
                var cartData = collectCartData();

                // Set value of hidden input fields
                $("#cartData").val(JSON.stringify(cartData.length > 0 ? cartData : []));

                this.submit();

                // Perform any other action you need here, like submitting the data to the server
                // // For now, let's just log the data
                // console.log("Cart Data: " + $("#cartData").val());
                // console.log("Total Price: " + $("#totalPrice").val());
                // console.log("Total Payment: " + $("#totalPayment").val());
                // console.log("Change: " + $("#change").val());
            });


            // Function to reset cart items array
            function resetCartItems() {
                cartItems = [];
            }

            // Event listener for Clear Keranjang button click
            $("#clearCart").click(function() {
                $('#card-details').children(':not(:first-child)').remove(); // Clear the cart details
                $('#totalPrice').val(''); // Reset total price
                $(".product-price").val(''); // Reset total product-price
                $("#totalPayment").val(''); // Reset total payment
                $("#change").val(''); // Reset change
                // Reset stok barang ke nilai awal
                $('.add-to-cart-button').each(function() {
                });
                resetCartItems();
            });
        });
    </script>
@endsection
