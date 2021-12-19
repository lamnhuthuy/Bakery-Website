<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= PUB ?>/css/login.css" />
</head>

<body>
  <p hidden id="documentRoot"><?= DOCUMENT_ROOT ?></p>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="<?= DOCUMENT_ROOT ?>/Account/authenticate" method="POST" class="sign-in-form" onsubmit=" return checkLoginSubmit()">
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder="Email" id="signin-text" />
            <small id="input-error">
            </small>
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <i class="far fa-eye" id="hidePass"></i>
            <input type="password" name="password" placeholder="Password" id="signin-password" />
            <small id="password-error">
              <?php echo isset($_SESSION["message"]) ? '<i class="fas fa-exclamation-triangle"></i>  '  . $_SESSION["message"] . '' : "";
              unset($_SESSION["message"]);
              ?>
            </small>

          </div>
          <input type="submit" id="btn-login" value="Login" class="btn solid" />
          <p class="<?= isset($_SESSION["mes"]) ? "success" : "error" ?>">
            <?php echo isset($_SESSION["mes"]) ? '<i class="fas fa-check"></i>' .      $_SESSION["mes"] . '' : "";
            unset($_SESSION["mes"]);
            ?>
            <?php echo isset($_SESSION["mes1"]) ? '<i class="fas fa-times"></i> ' .         $_SESSION["mes1"] . '' : "";
            unset($_SESSION["mes1"]);
            ?>
          </p>
        </form>
        <form action="<?= DOCUMENT_ROOT ?>/Account/signUp" method="POST" class="sign-up-form" onsubmit="return checkRegisterSubmit()">
          <h2 class="title">Register</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input required type="text" name="username" placeholder="Username" id="signup-text" />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input required type="email" name="email" placeholder="Email" id="signup-email" onchange="getDataAjax(this.value)" />
            <small id="emailSignUp-error" class="error"></small>
          </div>
          <div class="input-field">
            <i class="fas fa-phone-alt"></i>
            <input required type="text" name="phone" placeholder="Phone" id="signup-phone" />
            <small id="phoneSignUp-error" class="error"></small>
          </div>
          <div class="input-field">
            <i class="fas fa-map-marker-alt"></i>
            <input required type="text" name="address" placeholder="Address" id="signup-address" />
          </div>
          <div class=" input-field">
            <i class="fas fa-lock"></i>
            <input required type="password" name="password" placeholder="Password" id="signup-password" />
            <small id="pwdSigUp-error" class="error"></small>
          </div>
          <div class=" input-field">
            <i class="fas fa-key"></i>
            <input required type="password" name="confirm password" placeholder="Confirm Password" id="signup-confirmpassword" />
            <small id="confpwdSigUp-error" class="error"></small>
          </div>
          <input type="submit" id="btn-signup" class="btn" value="Register" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Welcome to Geek's Bakery House</h3>
          <p>
            Do you already have an account?
            If not, Please register your account here.
          </p>
          <button class="btn transparent" id="sign-up-btn">Register</button>
        </div>
        <img src="<?= PUB ?>/img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            Welcome to my Greek's Bakery website.
            Let's start with us in here.
          </p>
          <button class="btn transparent" id="sign-in-btn">Login</button>
        </div>
        <img src="<?= PUB ?>/img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>
  <script>
    // JS to change overlay
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");
    sign_up_btn.addEventListener("click", () => {
      container.classList.add("sign-up-mode");
    });
    sign_in_btn.addEventListener("click", () => {
      container.classList.remove("sign-up-mode");
    });

    // Js to check login submit
    var textField = document.getElementById("signin-text");
    var pwdField = document.getElementById("signin-password");
    var texterror = document.getElementById("input-error");
    var pwderror = document.getElementById("password-error");

    function checkLoginSubmit() {
      var check = true;
      document.querySelector("form p").innerHTML = "";
      if (textField.value == "" || pwdField.value == "") {
        if (textField.value == "") {
          texterror.innerHTML =
            '<i class="fas fa-exclamation-triangle"></i> Enter your Email.';
        } else texterror.innerHTML = "";
        if (pwdField.value == "") {
          pwderror.innerHTML =
            '<i class="fas fa-exclamation-triangle"></i> Enter your password.';
        } else pwderror.innerHTML = "";
        check = false;
      } else {
        texterror.innerHTML = "";
        pwderror.innerHTML = "";
        check = true;
      }
      return check;
    }

    //  jd to validation register
    var pwdSignUp = document.getElementById("signup-password");
    var emailSignUp = document.getElementById("signup-email");
    var confpwdSignUp = document.getElementById("signup-confirmpassword");
    var phoneSignUp = document.getElementById("signup-phone");

    var emailSignUp_error = document.getElementById("emailSignUp-error");
    var confpwdSignUp_error = document.getElementById("confpwdSigUp-error");
    var phone_error = document.getElementById("phoneSignUp-error");

    //function to check 2 password similar
    function checkConfirm(password, confpass) {
      var res = true;
      if (password !== confpass) {
        res = '<i class="fas fa-exclamation-triangle"></i> Password must be same.';
        return res;
      }
      if (password.length < 8) {
        res = '<i class="fas fa-exclamation-triangle"></i> Password must be at least 8 chatacters.';
        return res;
      }
      return res;
    }

    // function check phone must 10 numbers
    function checkPhone(phone) {
      var res = true;
      if (phone.length !== 10) {
        res = '<i class="fas fa-exclamation-triangle"></i> Phone must be have 10 numbers.';
        return res;
      }
      if (phone.charAt(0) !== '0')
        res = '<i class="fas fa-exclamation-triangle"></i> First number is 0.';
      return res;
    }

    function checkRegisterSubmit() {
      var result = true;
      var checkValue = checkConfirm(pwdSignUp.value, confpwdSignUp.value);
      var phone = checkPhone(phoneSignUp.value);
      if (phone !== true) {
        phone_error.innerHTML = phone;
        result = false;
      } else phone_error.innerHTML = "";
      if (checkValue !== true) {
        confpwdSignUp_error.innerHTML = checkValue;
        result = false;
      } else confpwdSignUp_error.innerHTML = "";
      if (emailSignUp_error.innerHTML !== "") {
        result = false;
      }
      return result;
    }

    // AJAX To Check user defined
    function getDataAjax(str) {
      var documentRoot = document.getElementById("documentRoot").innerHTML;
      const xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var obj = JSON.parse(this.responseText);
          if (emailSignUp.value !== "") {
            if (obj.email == emailSignUp.value) {
              emailSignUp_error.innerHTML =
                '<i class="fas fa-exclamation-triangle"></i> Your email already exists.';
            } else {
              emailSignUp_error.innerHTML = "";
            }
          }
        }
      };
      xhttp.open("POST", documentRoot + "/Account/checkUser");
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send(`email=${str}`);
    }
    // FUNCTION TO SHOW/HIDE PASSWORD
    document.getElementById("hidePass").onclick = function(e) {
      if (e.target.classList.contains("fa-eye") == true) {
        e.target.classList.remove("fa-eye");
        e.target.classList.add("fa-eye-slash");
        pwdField.type = "text";

      } else {
        e.target.classList.remove("fa-eye-slash");
        e.target.classList.add("fa-eye");
        pwdField.type = "password";

      }
    }
  </script>
</body>


</html>