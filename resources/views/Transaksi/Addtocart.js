
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

            // Kurangi stok barang
            var stok = parseInt(product.siblings('#stokbrg').text().trim().split(':')[1].trim());
            stok--;
            product.siblings('#stokbrg').text('Stok : ' + stok);
        } else {
            // Jika produk belum ada di keranjang, tambahkan produk baru
            var formattedPrice = 'Rp. ' + productPrice.toLocaleString('id-ID');

            // Append product details to cart
            $('#card-details').append(
                '<div class="mb-1">' +
                '<div class="row">' +
                '<div class="col-md-5">' +
                '<input type="text" class="form-control-plaintext border-0 product-name" value="' + productName +
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

            // Kurangi stok barang
            var stok = parseInt(product.siblings('#stokbrg').text().trim().split(':')[1].trim());
            stok--;
            product.siblings('#stokbrg').text('Stok : ' + stok);
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
    $('.add-to-cart-button').click(function() {
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
        $("#totalPayment").val(''); // Reset total payment
        $("#change").val(''); // Reset change
        // Reset stok barang ke nilai awal
        $('.add-to-cart-button').each(function() {
            var stock = $(this).data('stock');
            $(this).siblings('#stokbrg').text('Stok : ' + stock);
        });
        resetCartItems();
    });
});
