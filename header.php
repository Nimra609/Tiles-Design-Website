<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tile";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) {
    die("connection failed: " . 
    $conn->connect_error);
}
echo " ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $country = isset($_POST['country']) ? trim($_POST['country']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';


    if (!empty($firstname) && !empty($lastname) && !empty($country) && !empty($subject)) {
        
        $stmt = $conn->prepare("INSERT INTO contact (firstname, lastname, country, subject) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

    
        $stmt->bind_param("ssss", $firstname, $lastname, $country, $subject);
        if ($stmt->execute()) {
            echo " ";
        } else {
            echo "Error: " . $stmt->error;
        }

    
        $stmt->close();
    } else {
        echo " ";
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
   if (isset($_POST['username']) && isset($_POST['pass'])) {
       $email = $_POST['username'];
       $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);

       
       $stmt = $conn->prepare("INSERT INTO login (username, pass) VALUES (?, ?)");
       
       if ($stmt === false) {
           die('Prepare failed: ' . htmlspecialchars($conn->error));
       }

       $stmt->bind_param("ss", $email, $password);


       if ($stmt->execute()) {
       
           echo " ";
       } else {
           echo "Error: " . $stmt->error;
       }
  
    

       
       $stmt->close();
   } else {
       echo " ";
   }
} else {
   echo " ";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $result = $checkEmail->get_result();

        if ($result->num_rows > 0) {
            echo " ";
        } else {
            
            $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

        
            $stmt->bind_param("ss", $email, $password);

        
            if ($stmt->execute()) {
                header("Location: index.php?signup=success");
                exit();
                echo " ";
            } else {
                echo " " . $stmt->error;
            }

        
            $stmt->close();
        }

    
        $checkEmail->close();
    } else {
        echo " ";
    }
} else {
    echo " ";
}
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['pass'])) {
        $email = $_POST['username'];
        $password = $_POST['pass'];  

        
        $stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['pass'])) {
                
                $_SESSION['user'] = $user['username'];  
                echo " ";
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found!";
        }
        $stmt->close();
    }
}


if (isset($_GET['logout'])) {
    session_start();
    session_unset();  
    session_destroy();  
    header("Location: index.php");  
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['pass'])) {
        $email = $_POST['username'];
        $password = $_POST['pass'];  

        
        $stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['pass'])) {
            
                $_SESSION['user'] = $user['username'];  
                echo " ";
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found!";
        }
        $stmt->close();
    }
}

if (isset($_GET['logout'])) {
    session_start();
    session_unset();  
    session_destroy();  
    header("Location: index.php");  
}


    $conn->close();

?>

<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="viewport" content="width=device-width" initial-scale="1.0">
      <title>Home page</title>
      <link rel="stylesheet" href="css/style.css">
      <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
   </head>
   <body>
      <div class="nAvi jrowend" style="position: relative;">
         <img src="logoTa.jpg" class="hello">
         <ul class="btnstyle">
            <li><a href= "cart.php" class="cart-btn"> <image src="add-to-cart.png" alt="Shopping Cart" style="height: 30px; width: 30px;"></image>Cart</a></li>
            <li><a href="calculator.php">Tile Calculator</a></li>
            <li class="dropdown">
               <a href="Gallery.php" class="dropbtn">Gallery</a>
               <div class="dropdown-content">
                   <a href="#kitchen">24x48 Kitchen Tiles</a>
                   <a href="#bath">24x48 Bath Tiles</a>
                   <a href="#living">24x24 Living Room Tiles</a>
                   <a href="#bed">12x32 Bed Room Tiles</a>
                   <a href="#walls">10x20 Walls Tiles</a>
               </div>
          
            <li class="dropdown">
               <a href="index.php" class="dropbtn">Home</a>
               <div class="dropdown-content">
                  <a href="#aboutus">About Us</a>
                  <a href="#contactform">Contact Form</a>
               </div>
            </li>
            </li>
            </li>
            </li>
            </li>   
         </ul>
      
         <button id="loginBtn" class="login bTn" onclick="toggleLogin()" style="width: 7%;">
    <?php echo isset($_SESSION['user']) ? "Logout" : "Login"; ?>
</button>



<div id="loginModal" class="modal">
    <form 
        class="modal-content animate flexDCol" 
        action="index.php" 
        method="post" 
        onsubmit="return validateLoginForm()"
    >
        <div class="imgcontainer">
            <span onclick="document.getElementById('loginModal').style.display='none'" class="close" title="Close">&times;</span>
        </div>
        <div class="container">
            <label for="username"><b>Username</b></label>
            <input type="text" id="username" placeholder="Enter Username" name="username" required>
            
            <label for="password"><b>Password</b></label>
            <input type="password" id="password" placeholder="Enter Password" name="pass" required> 
            
            <button class="bTn secondclr x100" type="submit">Login</button>
        </div>
        <div class="container" style="background-color: #f1f1f1; display: flex; justify-content: flex-end;">
            <button type="button" class="bTn btnline" onclick="openSignupForm()">Signup</button>
        </div>
    </form>
</div>

<script>
    function validateLoginForm() {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        if (username === '' || username.length < 3) {
            alert('Username must be at least 3 characters long.');
            return false;
        }
        if (password === '' || password.length < 6) {
            alert('Password must be at least 6 characters long and Invalid Email');
            return false;
        }
        const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&#]{6,}$/; 
        if (!passwordRegex.test(password)) {
            alert('Password must contain at least one letter and one number.');
            return false;
        }

        return true; 
    }
</script>
<div id="signupModal" class="modal">
   <form class="modal-content animate flexDCol" action="index.php" method="post"  onsubmit="return validatesignupForm()">
       <div class="imgcontainer">
           <span onclick="document.getElementById('signupModal').style.display='none'" class="close" title="Close">&times;</span>
       </div>
       <div class="container">
           <h1>Sign Up</h1>
           <label for="email"><b>Email</b></label>
           <input type="email" id="email" placeholder="Enter Email" name="email" required>
           <label for="password"><b>Password</b></label>
           <input type="password" id="password" placeholder="Enter Password" name="password" required>
           <button type="submit" class="bTn secondclr">Sign Up</button>
           <button type="button" class="bTn btnline cancel" onclick="closeSignupForm()">Close</button>
           <span class="psw">Forgot <a href="#">password?</a></span>
       </div>
   </form>
</div>

 </div>
</div>

<script>
    function validatesignupForm() {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Enter a valid password and email address.');
            return false;
        }
        if (password.length < 8) {
            alert('Password must be at least 8 characters long.');
            return false;
        }
        if (!/[A-Z]/.test(password)) {
            alert('Password must contain at least one uppercase letter.');
            return false;
        }
        if (!/[a-z]/.test(password)) {
            alert('Password must contain at least one lowercase letter.');
            return false;
        }
        if (!/[0-9]/.test(password)) {
            alert('Password must contain at least one number.');
            return false;
        }
        return true;
    }

    function closeSignupForm() {
        document.getElementById('signupModal').style.display = 'none';
    }
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
      <script>
         var modal = document.getElementById('id01');
         window.onclick = function(event){
           if (event.target == modal){
             modal.style.display= "none";
           }
         }
      </script>
        <script>
    
    let isLoggedIn = false; 

    function toggleLogin() {
        const loginButton = document.getElementById("loginBtn");

        if (isLoggedIn) {
            
            isLoggedIn = false;  
            loginButton.textContent = "Login";
            alert("You have logged out!");
        } else {
            isLoggedIn = true;  
            loginButton.textContent = "Logout";
            document.getElementById('loginModal').style.display = 'flex';
        }
    }
</script>
<script>
   let isLoggedIn = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>; 

function toggleLogin() {
    const loginButton = document.getElementById("loginBtn");

    if (isLoggedIn) {
        
        window.location.href = "index.php?logout=true";  
    } else {
    
        document.getElementById('loginModal').style.display = 'flex';
    }
}
</script>
<!-- <script>

function showSignupMessage() {
    const messageDiv = document.getElementById('signupModal');
    messageDiv.style.display = 'block'; // Show the message
    setTimeout(() => {
        messageDiv.style.display = 'none'; // Hide the message after 3 seconds
    }, 3000); // Time in milliseconds
}

// Call this function on successful signup
document.querySelector("#signupModal form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission for testing the effect
    showSignupMessage(); // Show the message
    this.submit(); // Uncomment this line to actually submit the form
});
</script> -->
<script>

function showSignupMessage(message) {
    const messageDiv = document.createElement('div');
    messageDiv.id = 'signupMessage';
    messageDiv.style.cssText = `
        position: fixed;
        Top: 20%;
        left: 50%;
        transform: translateX(-50%);
        background-color: blue; /* Green background */
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        z-index: 1000;
        text-align: center;
        font-size: 16px;
    `;
    messageDiv.textContent = message;

    
    document.body.appendChild(messageDiv);

    
    setTimeout(() => {
        document.body.removeChild(messageDiv);
    }, 3000); 
}

window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('signup') && urlParams.get('signup') === 'success') {
        showSignupMessage('Signup to recieve early access and order samples');
    }
};
</script>