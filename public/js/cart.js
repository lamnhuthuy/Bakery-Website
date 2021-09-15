window.onload = function () {
  refreshCartNumber();
};
// Toast function
function toast({ title = "", message = "", type = "info", duration = 3000 }) {
  const main = document.getElementById("toast");
  if (main) {
    const toast = document.createElement("div");
    // Auto remove toast
    const autoRemoveId = setTimeout(function () {
      main.removeChild(toast);
    }, duration + 1000);
    // Remove toast when clicked
    toast.onclick = function (e) {
      if (e.target.closest(".toast__close")) {
        main.removeChild(toast);
        clearTimeout(autoRemoveId);
      }
    };
    const icons = {
      success: "fas fa-check-circle",
      info: "fas fa-info-circle",
      warning: "fas fa-exclamation-circle",
      error: "fas fa-exclamation-circle",
    };
    const icon = icons[type];
    const delay = (duration / 1000).toFixed(1);

    toast.classList.add("toast", `toast--${type}`);
    toast.style.animation = `slideInLeft ease .3s, fadeOut linear 0.5s ${delay}s forwards`;

    toast.innerHTML = `
                      <div class="toast__icon">
                          <i class="${icon}"></i>
                      </div>
                      <div class="toast__body">
                          <h3 class="toast__title">${title}</h3>
                          <p class="toast__msg">${message}</p>
                      </div>
                      <div class="toast__close">
                          <i class="fas fa-times"></i>
                      </div>
                  `;
    main.appendChild(toast);
  }
}

function addToCart(cakeID, userID) {
  if (userID == 0) {
    toast({
      title: "Login with us.",
      message: "Please login to add cake to basket.",
      type: "error",
      duration: 3000,
    });
    return;
  }
  var documentRoot = document.getElementById("documentRoot").innerHTML;
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var obj = JSON.parse(this.responseText);
      if (obj.issuccess == true) {
        toast({
          title: "Congratulations.",
          message: "Product was successfully to added in your cart.",
          type: "success",
          duration: 2000,
        });
        refreshCartNumber(obj.numInCart);
      }
    }
  };
  xhttp.open("POST", documentRoot + "/Cart/addToCart");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(`id_cake=${cakeID}&id_user=${userID}`);
}

function refreshCartNumber(cartNumber = -1) {
  var cartNumberElement = document.getElementById("header_cart_number");
  var documentRoot = document.getElementById("documentRoot").innerHTML;
  if (cartNumber !== -1) {
    cartNumberElement.innerText = cartNumber;
  } else {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        cartNumber = JSON.parse(this.responseText);
        cartNumberElement.innerText = cartNumber;
      }
    };
    xhttp.open("GET", documentRoot + "/Cart/amountInCart", true);
    xhttp.send();
  }
}
