<?php
include 'header.php';
?>

      <div class="slideshow-container">
         <div class="mySlides ">
            <div class="numbertext"></div>
            <img src="images/banner-1.jpg" style="width:100%">
            <div class="text tomCat">
               <h1>
                  TILES CRAFT 
                  <p>Super Style classic Tiles Available</p>
               </h1>
         
            </div>
         </div>
         <div class="mySlides ">
            <div class="numbertext"></div>
            <img src="images/banner-2.jpg" style="width:100%">
            <div class="text tomCat">
               <h1>
                  WALL & FLOOR TILES
                  <p>Super Style classic Tiles Available</p>
               </h1>
               
            </div>
         </div>
         <div class="mySlides ">
            <div class="numbertext"></div>
            <img src="images/banner-3.jpg" style="width:100%">
            <div class="text tomCat">
               <h1>
                  WOOD GRAIN TILE 
                  <p>Super Style classic Tiles Available</p>
               </h1>
           
            </div>
         </div>
         <div class="lider-list">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
         </div>
      </div>
      </div>
      <div class="row py25">
         <div class="column">
            <div class="card">
               <img src="icons-01.png" width="100%">
               <h3>LIVING ROOM TILES</h3>
            
               <a href="Gallery.php#living">VIEW MORE</a>
            </div>
         </div>
         <div class="column">
            <div class="card">
               <img src="icons-02.png" width="100%">
               <h3>BED ROOM TILES</h3>
               
               <a href="Gallery.php#bed">VIEW MORE</a>
            </div>
         </div>
         <div class="column">
            <div class="card">
               <img src="icons-03.png" width="100%">
               <h3>KITCHEN TILES</h3>
         
               <a href="Gallery.php#kitchen">VIEW MORE</a>
            </div>
         </div>
         <div class="column">
            <div class="card">
               <img src="icons-04.png" width="100%">
               <h3>BATH TILES</h3>
            
               <a href="Gallery.php#bath">VIEW MORE</a>
            </div>
         </div>
      </div>
      <div id="aboutus"></div>
      <div class="header">
         <h1>About Us</h1>
      </div>
      <div class="flexDroW">
         <div class="x50">
            <div class="flxAljustEnd"><img class=" imgAuto imgbord tile" src="images/Tile1.jpg"></div>
         </div>
         <div class="x50 pxy25 flxDclmJustC">
            <small>Who We Are</small>
            <h2>Why Choose Our Tiles?</h2>
            <p class="parha">
               Unmatched Quality: Every tile in our collection is crafted with precision and care, ensuring durability and long-lasting beauty in any space.
               
               Unique Designs: Our tiles are more than just surfaces—they’re art. With a wide range of textures, patterns, and colors, we offer exclusive designs that transform ordinary spaces into extraordinary works of art.
            </p>
         </div>
      </div>
      <div class="flexDroW pyb40">
         <div class="x50 pxy25 flxDclmJustC"  style="padding-left: 100px;">
            <h2>Where Tiles Become Art</h2>
            <p class="parha" style="padding-right:none;"> 
               At Saps Home, we turn tiles into masterpieces. Our website is your gateway to a world of exquisite tile designs that blend art and functionality. Whether you’re looking to elevate your home or create a striking commercial space, our carefully crafted tile collections offer the perfect fusion of beauty and durability.
               
               Explore our gallery of unique patterns, vibrant mosaics, and contemporary designs—each one thoughtfully curated to transform any surface into a canvas of creativity. Discover how our tiles can redefine your spaces with elegance, charm, and artistic flair.
            </p>
         </div>
         <div class="x50">
            <div class="flxAljustEnd"><img class=" imgAuto imgbord tile" src="images/Tile2.jpg"></div>
         </div>
      </div>
      <div id="contactform"></div>
      <h3 Align="center">Contact Form</h3>
      <div class="overlAy">
         <div class="container  flexAlJustcent bgform pxy25 ">
         <form class="x40 form"action="index.php" method="POST">
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" required><br><br>

    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" required><br><br>

    <label for="country">Country:</label>
    
   
    <input type="text" id="country" name="country" required><br><br>

    <label for="subject">Subject:</label>
    <textarea id="subject" name="subject" required></textarea><br><br>

    <button type="submit">Submit</button>
</form>

         </div>
      </div>
      <div class="container">
         <div class=""></div>
      </div>
      

      <script>
         let slideIndex = 0;
         showSlides();
         
         function showSlides() {
           let i;
           let slides = document.getElementsByClassName("mySlides");
           let dots = document.getElementsByClassName("dot");
           for (i = 0; i < slides.length; i++) {
             slides[i].style.display = "none";  
           }
           slideIndex++;
           if (slideIndex > slides.length) {slideIndex = 1}    
           for (i = 0; i < dots.length; i++) {
             dots[i].className = dots[i].className.replace(" active", "");
           }
           slides[slideIndex-1].style.display = "block";  
           dots[slideIndex-1].className += " active";
           setTimeout(showSlides, 2000); 
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
  