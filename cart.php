<?php
include 'header.php';
?>
 <style>
    :root{
  --primeColor: #aa7b51 !important;
  --secondaryColor: #584942;
  --radius4:4px;
}



    .cart-A {
    display: flex;
    justify-content: center;
    background-image: url(images/04.jpg);
}
.cart-B{
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    background: #fff;
    padding: 20px;
}
    .wrapo {
    display: flex;
    flex-direction: column;
    width: 70%;
  
}
    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
       
        border-radius: 8px;
        overflow: hidden;
    }
    .cart-table th, .cart-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
       
    }
    .cart-table th {
        background-color: var(--primeColor);
        color: #fff;
        font-weight: bold;
    }
    .cart-table tr:hover {
        background-color: #f2f2f2;
    }
    .cart-image {
        width: 60px;
        height: auto;
        border-radius: 4px;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
    }
    .cart-total {
        margin-top: 20px;
        font-weight: bold;
        text-align: right;
        font-size: 1.2em;
        color: black;
    }
    .quantity-control {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .quantity-control button {
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        margin: 0 5px;
        transition: background-color 0.3s ease, transform 0.1s ease;
    }
    .quantity-control button:hover {
        background-color:var(--secondaryColor);
        transform: scale(1.05);
    }
    .checkout-form {
        margin-top: 20px;
        padding: 15px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .checkout-form h2 {
        font-size: 1.5em;
        color: #333;
        margin-bottom: 15px;
    }
    .checkout-form input, .checkout-form button {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .checkout-form button {
        background-color:#aa7b51;
        color: white;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .checkout-form button:hover {
        background-color: var(--secondaryColor);
    }
    button.checkout-btn {
        width: 100%;
        max-width: 200px;
        margin: 20px auto;
        padding: 10px 0;
        background-color:;
        color: white;
        border: none;
        font-size: 1.2em;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: block;
    }
    button.checkout-btn:hover {
        background-color: var(--secondaryColor);
    }
    @media (max-width: 600px) {
        body {
            padding: 10px;
        }
        .cart-table {
            display: block;
            overflow-x: auto;
        }
        .cart-table tr {
            display: flex;
            flex-direction: column;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
            margin-bottom: 10px;
        }
        .cart-table td {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }
        .cart-table th, .cart-table td {
            border: none;
        }
        .cart-total {
            font-size: 1em;
        }
        .quantity-control {
            justify-content: flex-end;
        }
    }
</style>
  
<div class="cart-A" >
    <div class="wrapo" id="cart-A" >
    <h1 style="text-align: center;">Your Shopping Cart</h1>
    <div class="cart-B">
    <table class="cart-table" >
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="cart-items">
    
        </tbody>
    </table>
    <div class="cart-total">
        Total Items: <span id="total-items">0</span><br>
        Total Price: PKR<span id="total-price">0.00</span>
    </div>
    </div>
   
    <div class="checkout-form" id="checkout-form">
        <h2>Checkout</h2>
        <input type="text" id="name" placeholder="Full Name" required>
        <input type="text" id="address" placeholder="Address" required>
        <input type="text" id="card" placeholder="Phone Number" required>
        <button onclick="submitCheckout()">Submit Order</button>
        <button class="checkout-btn" onclick="showCheckout()" disabled>Checkout</button>

    </div>
</div>
</div>
</div>
    <script>
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const cartItemsContainer = document.getElementById('cart-items');
        const totalItems = document.getElementById('total-items');
        const totalPrice = document.getElementById('total-price');
    
        function populateCart() {
            cartItemsContainer.innerHTML = '';
            let totalCount = 0;
            let totalAmount = 0;
    
            cart.forEach(item => {
                totalCount += item.quantity;
                totalAmount += item.price * item.quantity;
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><img src="${item.image}" class="cart-image" alt="${item.name}"></td>
                    <td>${item.name}</td>
                    <td>
                        <div class="quantity-control">
                            <button onclick="changeQuantity('${item.name}', -1)">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="changeQuantity('${item.name}', 1)">+</button>
                        </div>
                    </td>
                    <td>PKR ${item.price.toFixed(2)}</td>
                    <td>PKR ${(item.price * item.quantity).toFixed(2)}</td>
                    <td><button onclick="removeItem('${item.name}')">Remove</button></td>
                `;
                cartItemsContainer.appendChild(row);
            });
    
            totalItems.innerText = totalCount;
            totalPrice.innerText = totalAmount.toFixed(2);
        }
    
        function changeQuantity(name, change) {
            const item = cart.find(cartItem => cartItem.name === name);
            if (item) {
                item.quantity += change;
                if (item.quantity <= 0) {
                    cart.splice(cart.indexOf(item), 1);
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                populateCart();
            }
        }
    
        function removeItem(name) {
            const itemIndex = cart.findIndex(cartItem => cartItem.name === name);
            if (itemIndex !== -1) {
                cart.splice(itemIndex, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                populateCart();
            }
        }
    
        function showCheckout() {
            const checkoutForm = document.getElementById('cart-A');
            checkoutForm.style.display = checkoutForm.style.display === 'none' ? 'block' : 'none';
        }

    function submitCheckout() {
        const name = document.getElementById('name').value.trim();
        const address = document.getElementById('address').value.trim();
        const card = document.getElementById('card').value.trim();

        if (!name || !address || !card) {
            alert('Please fill in all fields before submitting.');
            return;
        }


        const data = {
            user_name: name,
            user_address: address,
            phone_number: card,
            cart_items: cart
        };

        fetch('backend/Cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            localStorage.removeItem('cart'); 
            populateCart(); 


            document.getElementById('name').value = '';
            document.getElementById('address').value = '';
            document.getElementById('card').value = '';

            
            if (cart.length === 0) {
                alert('Your cart is empty. Add items before placing a new order.');
                location.reload(); 
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function toggleCheckoutButton() {
        const checkoutButton = document.querySelector('.checkout-btn');
        checkoutButton.disabled = cart.length === 0;
        checkoutButton.style.opacity = cart.length === 0 ? '0.5' : '1';
    }

    function populateCart() {
        cartItemsContainer.innerHTML = '';
        let totalCount = 0;
        let totalAmount = 0;

        cart.forEach(item => {
            totalCount += item.quantity;
            totalAmount += item.price * item.quantity;
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><img src="${item.image}" class="cart-image" alt="${item.name}"></td>
                <td>${item.name}</td>
                <td>
                    <div class="quantity-control">
                        <button onclick="changeQuantity('${item.name}', -1)">-</button>
                        <span>${item.quantity}</span>
                        <button onclick="changeQuantity('${item.name}', 1)">+</button>
                    </div>
                </td>
                <td>PKR ${item.price.toFixed(2)}</td>
                <td>PKR ${(item.price * item.quantity).toFixed(2)}</td>
                <td><button onclick="removeItem('${item.name}')">Remove</button></td>
            `;
            cartItemsContainer.appendChild(row);
        });

        totalItems.innerText = totalCount;
        totalPrice.innerText = totalAmount.toFixed(2);

        toggleCheckoutButton(); 
    }

    window.onload = () => {
        populateCart();
    };
</script>

</body>
</html>
<footer style="background-color: #333; color: white; padding: 40px 20px; text-align: center;">
    <div class="footer-content" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; max-width: 1200px; margin: 0 auto;">
       
        <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
            <img src="logoTa.jpg" alt="Company Logo" style="height: 100px; width: auto;">
        </div>
 
        
        <div style="flex: 1; min-width: 200px; margin-bottom: 20px; text-align: left;">
            <h3 style="margin-bottom: 10px;">Company Name</h3>
            <p>Your one-stop shop for all kinds of tiles. Quality and style guaranteed.</p>
        </div>
 
       
        <div style="flex: 1; min-width: 200px; margin-bottom: 20px; text-align: left;">
            <h4 style="margin-bottom: 10px;">Quick Links</h4>
            <ul style="list-style: none; padding: 0; line-height: 1.8; display: flex; flex-direction: column;">
                <li style="margin-bottom: 10px;"><a href="index.php" style="color: white; text-decoration: none;">Home</a></li>
                <li style="margin-bottom: 10px;"><a href="Gallery.php" style="color: white; text-decoration: none;">Gallery</a></li>
                <li style="margin-bottom: 10px;"><a href="calculator.php" style="color: white; text-decoration: none;">Tile Calculator</a></li>
                <li style="margin-bottom: 10px;"><a href="#aboutus" style="color: white; text-decoration: none;">About Us</a></li>
                <li style="margin-bottom: 10px;"><a href="#contactform" style="color: white; text-decoration: none;">Contact Us</a></li>
            </ul>
        </div>
 
         
        <div style="flex: 1; min-width: 200px; margin-bottom: 20px; text-align: left;">
          <h4 style="margin-bottom: 10px;">Services</h4>
          <ul style="list-style: none; padding: 0; line-height: 1.8; display: flex; flex-direction: column;">
              <li style="margin-bottom: 10px;"><a href="Gallery.php#kitchen" style="color: white; text-decoration: none;">Kitchen Tiles</a></li>
              <li style="margin-bottom: 10px;"><a href="Gallery.php#bath" style="color: white; text-decoration: none;">Bath Tiles</a></li>
              <li style="margin-bottom: 10px;"><a href="Gallery.php#living" style="color: white; text-decoration: none;">Living Room Tiles</a></li>
              <li style="margin-bottom: 10px;"><a href="Gallery.php#bath" style="color: white; text-decoration: none;">Bed Room Tiles</a></li>
              <li style="margin-bottom: 10px;"><a href="Gallery.php#walls" style="color: white; text-decoration: none;">Walls Tiles</a></li>
          </ul>
      </div>
 
       
        <div style="flex: 1; min-width: 200px; margin-bottom: 20px;">
            <h4 style="margin-bottom: 10px;">Follow Us</h4>
            <div style="display: flex; justify-content: center; align-items: center;">
                <a href="#" style="color: white; margin: 0 10px; text-decoration: none;">
                    <img src="facebook.png" alt="Facebook" style="width: 30px; height: 30px;">
                </a>
                <a href="#" style="color: white; margin: 0 10px; text-decoration: none;">
                    <img src="instagram.png" alt="Instagram" style="width: 30px; height: 30px;">
                </a>
                <a href="#" style="color: white; margin: 0 10px; text-decoration: none;">
                    <img src="linkedin.png" alt="LinkedIn" style="width: 30px; height: 30px;">
                </a>
            </div>
        </div>
    </div>
 
   
    <div style="margin-top: 30px; border-top: 1px solid #555; padding-top: 20px;">
        <p>&copy; 2024 Company Name. All rights reserved.</p>
    </div>
 </footer>
   
