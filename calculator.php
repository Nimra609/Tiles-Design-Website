<?php
include 'header.php';
?>
     <div class="image">
    <div class="calculator-container">
        <h1 align="center">Tile Calculator</h1>
        <form id="tileForm">
            <div class="input-group">
                <label for="shape">Room Shape:</label>
                <select id="shape" onchange="updateForm()">
                    <option value="rectangle">Rectangle</option>
                    <option value="circle">Circle</option>
                    <option value="triangle">Triangle</option>
                    <option value="custom">Custom (Multiple Walls)</option>
                </select>
            </div>
             <div id="dimensions">
            </div>

            <div class="input-group">
                <label for="tileLength">Tile Length (cm):</label>
                <input type="number" id="tileLength" required min="1" step="0.1">
            </div>
            <div class="input-group">
                <label for="tileWidth">Tile Width (cm):</label>
                <input type="number" id="tileWidth" required min="1" step="0.1">
            </div>

            <div id="additionalOptions">
            </div>

            <button type="button" onclick="calculateTiles()">Calculate</button>
        </form>
        <div id="result"></div>
    </div>
    </div>
    <script>
        function updateForm() {
            const shape = document.getElementById('shape').value;
            const dimensions = document.getElementById('dimensions');
            const additionalOptions = document.getElementById('additionalOptions');

            dimensions.innerHTML = '';
            additionalOptions.innerHTML = '';

            if (shape === 'rectangle') {
                dimensions.innerHTML = `
                    <div class="input-group">
                        <label for="length">Length (m):</label>
                        <input type="number" id="length" required min="0.1" step="0.01">
                    </div>
                    <div class="input-group">
                        <label for="width">Width (m):</label>
                        <input type="number" id="width" required min="0.1" step="0.01">
                    </div>
                    <div class="input-group">
                        <label for="height">Height (m, for walls):</label>
                        <input type="number" id="height" min="0" step="0.01">
                    </div>
                `;
            } else if (shape === 'circle') {
                dimensions.innerHTML = `
                    <div class="input-group">
                        <label for="radius">Radius (m):</label>
                        <input type="number" id="radius" required min="0.1" step="0.01">
                    </div>
                `;
            } else if (shape === 'triangle') {
                dimensions.innerHTML = `
                    <div class="input-group">
                        <label for="base">Base (m):</label>
                        <input type="number" id="base" required min="0.1" step="0.01">
                    </div>
                    <div class="input-group">
                        <label for="height">Height (m):</label>
                        <input type="number" id="height" required min="0.1" step="0.01">
                    </div>
                `;
            } else if (shape === 'custom') {
                dimensions.innerHTML = `
                    <div class="input-group">
                        <label for="numWalls">Number of Walls:</label>
                        <input type="number" id="numWalls" min="3" max="10" required onchange="addCustomWalls()">
                    </div>
                    <div id="wallDimensions"></div>
                    <div class="input-group">
                        <label for="roomHeight">Room Height (m):</label>
                        <input type="number" id="roomHeight" required min="0.1" step="0.01">
                    </div>
                `;
            }

            additionalOptions.innerHTML = `
                <div class="input-group">
                    <label for="doors">Number of Doors:</label>
                    <input type="number" id="doors" value="0" required min="0">
                </div>
                <div class="input-group">
                    <label for="cupboards">Cupboard Area (m²):</label>
                    <input type="number" id="cupboards" value="0" required min="0" step="0.01">
                </div>
                <div class="input-group">
                    <label for="ventilation">Ventilation Area (m²):</label>
                    <input type="number" id="ventilation" value="0" required min="0" step="0.01">
                </div>
                <div class="input-group">
                    <label for="groutSpacing">Grout Spacing (mm):</label>
                    <input type="number" id="groutSpacing" value="2" required min="0" step="0.1">
                </div>
                <div class="input-group">
                    <label for="wastagePercentage">Wastage Percentage (%):</label>
                    <input type="number" id="wastagePercentage" value="10" required min="0" max="100" step="1">
                </div>
            `;
        }

        function addCustomWalls() {
            const numWalls = parseInt(document.getElementById('numWalls').value);
            const wallDimensions = document.getElementById('wallDimensions');

            wallDimensions.innerHTML = '';
            for (let i = 1; i <= numWalls; i++) {
                wallDimensions.innerHTML += `
                    <div class="input-group">
                        <label for="wall${i}Length">Wall ${i} Length (m):</label>
                        <input type="number" id="wall${i}Length" required min="0.1" step="0.01">
                    </div>
                `;
            }
        }

        function calculateTiles() {
    const shape = document.getElementById('shape').value;
    const tileLength = parseFloat(document.getElementById('tileLength').value) / 100;
    const tileWidth = parseFloat(document.getElementById('tileWidth').value) / 100; 
    const groutSpacing = parseFloat(document.getElementById('groutSpacing').value) / 1000;
    const wastagePercentage = parseFloat(document.getElementById('wastagePercentage').value) / 100;

    const effectiveTileLength = tileLength + groutSpacing;
    const effectiveTileWidth = tileWidth + groutSpacing;
    const tileCoverageArea = effectiveTileLength * effectiveTileWidth;

    let roomArea;

    if (shape === 'rectangle') {
        const length = parseFloat(document.getElementById('length').value);
        const width = parseFloat(document.getElementById('width').value);
        const height = parseFloat(document.getElementById('height').value) || 0;
        roomArea = height > 0 ? 2 * (length * height + width * height) : length * width;
    } else if (shape === 'circle') {
        const radius = parseFloat(document.getElementById('radius').value);
        roomArea = Math.PI * Math.pow(radius, 2);
    } else if (shape === 'triangle') {
        const base = parseFloat(document.getElementById('base').value);
        const height = parseFloat(document.getElementById('height').value);
        roomArea = 0.5 * base * height;
    } else if (shape === 'custom') {
        const numWalls = parseInt(document.getElementById('numWalls').value);
        const roomHeight = parseFloat(document.getElementById('roomHeight').value);
        let totalWallArea = 0;
        for (let i = 1; i <= numWalls; i++) {
            const wallLength = parseFloat(document.getElementById(`wall${i}Length`).value);
            totalWallArea += wallLength * roomHeight;
        }
        roomArea = totalWallArea;
    }

    const doors = parseFloat(document.getElementById('doors').value) * 1.68; 
    const cupboards = parseFloat(document.getElementById('cupboards').value);
    const ventilation = parseFloat(document.getElementById('ventilation').value);

    const totalSubtract = doors + cupboards + ventilation;
    const effectiveArea = roomArea - totalSubtract;

    const numberOfTiles = Math.ceil(effectiveArea / tileCoverageArea);
    const numberOfTilesWithWastage = Math.ceil(numberOfTiles * (1 + wastagePercentage));

    const result = document.getElementById('result');
    result.innerHTML = `
        <h3>Calculation Results:</h3>
        <p>Total Room Area: ${roomArea.toFixed(2)} m²</p>
        <p>Effective Area (after subtractions): ${effectiveArea.toFixed(2)} m²</p>
        <p>Tile Coverage Area (including grout): ${tileCoverageArea.toFixed(4)} m²</p>
        <p>Number of Tiles Needed: ${numberOfTiles}</p>
        <p>Number of Tiles with ${(wastagePercentage * 100).toFixed(0)}% Wastage: ${numberOfTilesWithWastage}</p>
        <p>Approximate Boxes Needed: ${Math.ceil(numberOfTilesWithWastage / 10)} (assuming 10 tiles per box)</p>
    `;
}
        updateForm();
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

