
<?php
include 'header.php';

$conn = new mysqli("localhost", "root", "", "tile");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM gallery LIMIT 100";
$result = $conn->query($sql);



$sqlBath = "SELECT * FROM bath_tiles LIMIT 100";
$resultBath = $conn->query($sqlBath);

$sqlliving = "SELECT * FROM living_room_tiles LIMIT 100";
$resultliving = $conn->query($sqlliving);

$sqlbed = "SELECT * FROM bedroom_tiles LIMIT 100";
$resultbed = $conn->query($sqlbed);
$sqlwall = "SELECT * FROM wall_tiles LIMIT 100";
$resultwall = $conn->query($sqlwall);
?>
<?php

$conn->close();
?>


 
  
 <form action="cart.php" method="POST">
    <div id="kitchen" class="header">
        <h1>Modern Kitchen Tiles Images Gallery</h1>
        <p>Multi style for <b>Kitchen Modern</b> types of tiles.</p>
    </div>

    <div class="flexDroW">
    <div class="x60 imgbord">
        <div class="image-viewer gallery-item">
            <img id="largeImage" src="images/color.png" alt="Click on a thumbnail to view" style="width: 100%; border: 2px solid #ccc;">
            <div id="imageDetails">
                <div class="overlay flexAlJustcent flexDCol">
                    <p id="tileName">Kitchen Tiles 24x48</p>
                    <input type="number" class="quantity" id="quantity" min="1" value="1">
                    <button class="add-to-cart" onclick="addToCart('Kitchen Tiles', document.getElementById('quantity').value, 'images/color.png', 20)">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <div class="x40 imgbord">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="column">
                        <img class="thumbnail" onclick="showImage(\'' . $row['image_url'] . '\', \'' . $row['name'] . '\', \'' . $row['price'] . '\')" src="' . $row['image_url'] . '" style="width: 100%;">
                        <p>' . $row['name'] . ' - PKR ' . $row['price'] . '<br>Size: ' . $row['size'] . '</p>
                        <button onclick="addToCart(\'' . $row['name'] . '\', 1, \'' . $row['image_url'] . '\', ' . $row['price'] . ')">Add to Cart</button>
                    </div>';
                }
            } else {
                echo '<p>No tiles found in the database.</p>';
            }
            ?>
        </div>
    </div>
</div>

<div id="bath" class="header">
    <h1>Modern Bath Tiles Images Gallery</h1>
    <p>Multi style for <b>Bath Tiles Modern</b> types of tiles.</p>
</div>

<div class="flexDroW">
    <div class="x60 imgbord">
        <div class="image-viewer gallery-item">
            <img id="largeImage2" src="images/color.png" alt="Click on a thumbnail to view">
            <div id="imageDetails">
                <div class="overlay flexAlJustcent flexDCol">
                    <p>Bath Tiles 24x48</p>
                    <input type="number" class="quantity" id="quantity" min="1" value="1">
                    <button class="add-to-cart" onclick="addToCart('Bath Tiles', document.getElementById('quantity').value, 'images/color.png', 20)">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <div class="x40 imgbord">
        <div class="row">
            <?php
            if ($resultBath->num_rows > 0) {
                while ($row = $resultBath->fetch_assoc()) {
                    echo '
                    <div class="column">
                        <img class="thumbnail" onclick="showImage2(\'' . $row['image_url'] . '\', \'' . $row['name'] . '\', \'' . $row['price'] . '\')" src="' . $row['image_url'] . '" style="width: 100%;">
                        <p>' . $row['name'] . ' - PKR ' . $row['price'] . '<br>Size: ' . $row['size'] . '</p>
                        <button onclick="addToCart(\'' . $row['name'] . '\', 1, \'' . $row['image_url'] . '\', ' . $row['price'] . ')">Add to Cart</button>
                    </div>';
                }
            } else {
                echo '<p>No bath tiles found in the database.</p>';
            }
            ?>
        </div>
    </div>
</div>
    
    <div id="living" class="header">
      <h1>Modern living Room Tiles Images Gallery</h1>
      <p>Multi style for <b>Living Room Tiles Modern</b> types of tiles.</p>
  </div>

  <div class="flexDroW">
      <div class="x60 imgbord">
          <div class="image-viewer gallery-item">
              <img id="largeImage3" src="images/color.png" alt="Click on a thumbnail to view">
              <div id="imageDetails">
                  <div class="overlay flexAlJustcent flexDCol">
                      <p>Living Room Tilesn 24x24</p>
                      <input type="number" class="quantity" id="quantity" min="1" value="1">
                      <button class="add-to-cart" onclick="addToCart('Living Room Tiles', document.getElementById('quantity').value, 'images/color.png', 20)">Add to Cart</button>
                  </div>
              </div> 
          </div>
      </div>

      <div class="x40 imgbord">
          <div class="row"> 
          <?php
            if ($resultliving->num_rows > 0) {
                while ($row = $resultliving->fetch_assoc()) {
                    echo '
                    <div class="column">
                        <img class="thumbnail" onclick="showImage3(\'' . $row['image_url'] . '\', \'' . $row['name'] . '\', \'' . $row['price'] . '\')" src="' . $row['image_url'] . '" style="width: 100%;">
                       <p>' . $row['name'] . ' - PKR ' . $row['price'] . '<br>Size: ' . $row['size'] . '</p>
                        <button onclick="addToCart(\'' . $row['name'] . '\', 1, \'' . $row['image_url'] . '\', ' . $row['price'] . ')">Add to Cart</button>
                    </div>';
                }
            } else {
                echo '<p>No living tiles found in the database.</p>';
            }
            ?>
             
 </div>
 </div>
 </div>
  
 
    
    <div id="bed" class="header">
         <h1>Modern Bed Room Tiles Images Gallery</h1>
         <p>Multi style for <b>Bed Room Tiles Modern</b> types of tiles.</p>
     </div>
 
     <div class="flexDroW">
         <div class="x60 imgbord">
             <div class="image-viewer gallery-item">
                 <img id="largeImage4" src="images/color.png" alt="Click on a thumbnail to view">
                 <div id="imageDetails">
                     <div class="overlay flexAlJustcent flexDCol">
                         <p>Bed Room Tiles 12x32</p>
                         <input type="number" class="quantity" id="quantity" min="1" value="1">
                         <button class="add-to-cart" onclick="addToCart('Bed Room Tiles', document.getElementById('quantity').value, 'images/color.png', 20)">Add to Cart</button>
                     </div>
                 </div> 
             </div>
         </div>
 
         <div class="x40 imgbord">
             <div class="row">
             <?php
            if ($resultbed->num_rows > 0) {
                while ($row = $resultbed->fetch_assoc()) {
                    echo '
                    <div class="column">
                        <img class="thumbnail" onclick="showImage4(\'' . $row['image_url'] . '\', \'' . $row['name'] . '\', \'' . $row['price'] . '\')" src="' . $row['image_url'] . '" style="width: 100%;">
                       <p>' . $row['name'] . ' - PKR ' . $row['price'] . '<br>Size: ' . $row['size'] . '</p>
                        <button onclick="addToCart(\'' . $row['name'] . '\', 1, \'' . $row['image_url'] . '\', ' . $row['price'] . ')">Add to Cart</button>
                    </div>';
                }
            } else {
                echo '<p>No bed tiles found in the database.</p>';
            }
            ?>
    </div>
    </div>
    </div>
    <div id="walls" class="header">
         <h1>Modern Walls Tiles Images Gallery</h1>
         <p>Multi style for <b>Walls Tiles Modern</b> types of tiles.</p>
     </div>
 
     <div class="flexDroW">
         <div class="x60 imgbord">
             <div class="image-viewer gallery-item">
                 <img id="largeImage5" src="images/color.png" alt="Click on a thumbnail to view">
                 <div id="imageDetails">
                     <div class="overlay flexAlJustcent flexDCol">
                         <p>Walls Tiles 10x20</p>
                         <input type="number" class="quantity" id="quantity" min="1" value="1">
                         <button class="add-to-cart" onclick="addToCart('Walls Tiles', document.getElementById('quantity').value, 'images/color.png', 20)">Add to Cart</button>
                     </div>
                 </div> 
             </div>
         </div>
 
         <div class="x40 imgbord">
             <div class="row"> 
             <?php
            if ($resultwall->num_rows > 0) {
                while ($row = $resultwall->fetch_assoc()) {
                    echo '
                    <div class="column">
                        <img class="thumbnail" onclick="showImage5(\'' . $row['image_url'] . '\', \'' . $row['name'] . '\', \'' . $row['price'] . '\')" src="' . $row['image_url'] . '" style="width: 100%;">
                       <p>' . $row['name'] . ' - PKR ' . $row['price'] . '<br>Size: ' . $row['size'] . '</p>
                        <button onclick="addToCart(\'' . $row['name'] . '\', 1, \'' . $row['image_url'] . '\', ' . $row['price'] . ')">Add to Cart</button>
                    </div>';
                }
            } else {
                echo '<p>No wall tiles found in the database.</p>';
            }
            ?>
    </div>
    </div>
    </div>
    <script>
  
      function showImage(src, name, size) {
  
  const largeImage = document.getElementById('largeImage');
  
  
  largeImage.src = src;
  
  
   document.getElementById('imageName').textContent = "Name: " + name;
   document.getElementById('imageSize').textContent = "Size: " + size;
  }
  </script>
  <script>
  
  function showImage2(src, name, size) {
  
  const largeImage2 = document.getElementById('largeImage2');
  
  
  largeImage2.src = src;
  
  
  document.getElementById('imageName').textContent = "Name: " + name;
  document.getElementById('imageSize').textContent = "Size: " + size;
  }
  
  
  </script>
  <script>
  
    function showImage3(src, name, size) {
  
  const largeImage3 = document.getElementById('largeImage3');
  
  
  largeImage3.src = src;
  
  
  document.getElementById('imageName').textContent = "Name: " + name;
  document.getElementById('imageSize').textContent = "Size: " + size;
  }
  </script>
  <script>
  
    function showImage4(src, name, size) {
  
  const largeImage4 = document.getElementById('largeImage4');
  
  
  largeImage4.src = src;
  
  
  document.getElementById('imageName').textContent = "Name: " + name;
  document.getElementById('imageSize').textContent = "Size: " + size;
  }
  </script>
  <script>
  
    function showImage5(src, name, size) {
  
  const largeImage5 = document.getElementById('largeImage5');
  
  
  largeImage5.src = src;
  
  document.getElementById('imageName').textContent = "Name: " + name;
  document.getElementById('imageSize').textContent = "Size: " + size;
  }
  </script>
  <script>
    function openForm() {
      document.getElementById("myForm").style.display = "flex";
    }
    
    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
  </script>
  <script>
    var modal = document.getElementById('id01');
    window.onclick = function(event){
      if (event.target == modal){
        modal.style.display= "none";
      }
    }
  </script>

    <script>
        let cart = [];

        function addToCart(name, quantity, imageSrc, price) {
            const item = { name, quantity: parseInt(quantity), image: imageSrc, price: price };
            const existingItem = cart.find(cartItem => cartItem.name === name);
            if (existingItem) {
                existingItem.quantity += item.quantity;
            } else {
                cart.push(item);
            }
            localStorage.setItem('cart', JSON.stringify(cart)); 
            document.getElementById('cart-count').innerText = cart.length;
            alert(`${name} has been added to your cart!`);
        }

        function showImage(src, title, size) {
            const imageViewer = document.getElementById('largeImage');
            imageViewer.src = src;
            imageViewer.alt = title;
        }
        function showImage2(src, title, size) {
            const imageViewer = document.getElementById('largeImage2');
            imageViewer.src = src;
            imageViewer.alt = title;
        }
        function showImage3(src, title, size) {
            const imageViewer = document.getElementById('largeImage3');
            imageViewer.src = src;
            imageViewer.alt = title;
        }
        function showImage4(src, title, size) {
            const imageViewer = document.getElementById('largeImage4');
            imageViewer.src = src;
            imageViewer.alt = title;
        }
        function showImage5(src, title, size) {
            const imageViewer = document.getElementById('largeImage5');
            imageViewer.src = src;
            imageViewer.alt = title;
        }
    </script>
     <script>
    
        function openSignupForm() { document.getElementById("signupModal").style.display = "flex"; }
      function closeSignupForm() { document.getElementById("signupModal").style.display = "none"; }
      
    
      window.onclick = function(event) {
         if (event.target == document.getElementById('loginModal')) {
            document.getElementById('loginModal').style.display = "none";
         }
         if (event.target == document.getElementById('signupModal')) {
            document.getElementById('signupModal').style.display = "none";
         }
      }
      function openForm() {
        document.getElementById("myForm").style.display = "flex";
      }
      
      function closeForm() {
        document.getElementById("myForm").style.display = "none";
      }
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
               <li style="margin-bottom: 10px;"><a href="index.php#aboutus" style="color: white; text-decoration: none;">About Us</a></li>
               <li style="margin-bottom: 10px;"><a href="index.php#contactform" style="color: white; text-decoration: none;">Contact Us</a></li>
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
 
 
 
