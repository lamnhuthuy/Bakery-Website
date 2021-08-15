function add() {
  var inputVal = document.getElementById("comment-add");
  var name = document.getElementById("comment-name").innerHTML;
  var imgsrc = document.getElementById("comment-img-user").src;
  if (document.getElementById("no-comment") != null) {
    document.getElementById("no-comment").style.display = "none";
  }
  if (inputVal.value !== "") {
    var item = document.createElement("div");
    item.classList.add("comment-user");
    item.innerHTML = `<img src="${imgsrc}" alt="" class="comment-img-user" />
    <div class="comment-item">
      <div class="comment-content">
        <p class="comment-name">${name}</p>
        <p class="comment-content-value">${inputVal.value}.</p>
      </div>
      <p class="comment-time">
        <i class="fas fa-thumbs-up "></i>
        <span id="like">0</span>
        <span id="time">Just now</span>
        <abbr title="Viet Nam"> <i class="fas fa-globe"></i> </abbr>
      </p>
    </div>`;
    document.querySelector(".comment-list").appendChild(item);
    inputVal.value = "";
  }
}
function addComment() {
  var inputValue = document.getElementById("comment-add");
  if (inputValue.value != "") {
    var id = document.getElementById("idCake").innerHTML;
    var documentRoot = document.getElementById("documentRoot").innerHTML;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        var obj = JSON.parse(this.responseText);
        if (obj == true) {
          add();
          toast({
            title: "Successfully.",
            message: "Add comment succesfully.",
            type: "success",
            duration: 2000,
          });
        }
      }
    };
    xhttp.open(
      "GET",
      documentRoot + `/Cake/addComment?id=${id}&comment=${inputValue.value}`,
      true
    );
    xhttp.send();
  }
}
function changeState(id) {
  var icon = document.getElementById("icon-like+" + id);
  icon.classList.toggle("like-active");
  if (icon.classList.contains("like-active")) {
    document.getElementById("like+" + id).innerHTML =
      parseInt(document.getElementById("like+" + id).innerHTML) + 1;
  } else {
    document.getElementById("like+" + id).innerHTML =
      parseInt(document.getElementById("like+" + id).innerHTML) - 1;
  }
  var likeNum = document.getElementById("like+" + id).innerHTML;
  var documentRoot = document.getElementById("documentRoot").innerHTML;
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var obj = JSON.parse(this.responseText);
      console.log(obj);
    }
  };
  xhttp.open(
    "GET",
    documentRoot + `/Cake/updateCommentAndLike?id=${id}&likes=${likeNum}`,
    true
  );
  xhttp.send();
}
