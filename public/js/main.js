var menuIcon = document.querySelector(".header_mobile_icon");
var headerMobile = document.querySelector(".header_mobile_list");
var del = document.querySelector(".header_mobile_list svg");
menuIcon.addEventListener("click", () => {
  headerMobile.style.transform = "translateX(" + 0 + "%)";
});
del.addEventListener("click", () => {
  headerMobile.style.transform = "translateX(" + 100 + "%)";
});

var container = document.querySelector(".best-contain");
var items = document.querySelectorAll(".Best-seller-content");
var itemLength = items.length;
var size = items[0].clientWidth;
var next = document.querySelector(".right-arrow");
var prev = document.querySelector(".left-arrow");
var index = 0;
var dots = document.querySelectorAll(".pagging-item");
next.addEventListener("click", () => {
  if (index >= itemLength - 1) {
    gotoSlide(0);
    return;
  }
  index++;
  gotoSlide(index);
});
prev.addEventListener("click", () => {
  if (index <= 0) {
    gotoSlide(itemLength - 1);
    return;
  }
  index--;
  gotoSlide(index);
});

function gotoSlide(number) {
  container.style.transform = "translateX(" + -size * number + "px)";
  index = number;
  activeDot();
}
function activeDot() {
  var currentDot = document.querySelector(".pagging-active");
  currentDot.classList.remove("pagging-active");
  dots[index].classList.add("pagging-active");
}
dots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    gotoSlide(index);
  });
});
var imageItems = document.querySelectorAll(".banner-img");
imageLength = imageItems[0].clientWidth;
var contentImg = document.querySelector(".banner");
var t = 0;
function slideImg() {
  if (t >= imageItems.length - 1) {
    autoImage(0);
    return;
  }
  t++;
  autoImage(t);
}
function autoImage(index) {
  contentImg.style.transform = "translateX(" + -imageLength * index + "px)";
  t = index;
}

setInterval(slideImg, 2700);

// js paging

// var pageNumbers = document.querySelectorAll(".sweeties_pagging_item");
// pageNumbers.forEach(function (anchor) {
//   anchor.addEventListener("click", (e) => {
//     e.target.classList.add("sweeties_pagging_item-active");
//   });
// });
