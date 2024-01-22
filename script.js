// sticky navbar
window.onscroll = function () {
  stickyNavBar();
}

function stickyNavBar() {
  var navBar = document.querySelector(".nav-bar")
  var sticky = navBar.offsetTop;

  if (window.pageXOffset >= sticky) {
    navBar.classList.add('sticky');
  } else {
    navBar.classList.remove('sticky');
  }
}

// category drop down

var categoryDropdownBtn = document.querySelector(".category-list-btn");
var categoryDropdownList = document.querySelector(".category-dropdown-menu");
categoryDropdownBtn.addEventListener("click", function (event) {
  event.preventDefault();
  categoryDropdownList.classList.toggle("show");
});
window.addEventListener("click", function (event) {
  if (!event.target.matches(".category-list-btn")) {
    if (categoryDropdownList.classList.contains("show")) {}
  }
});


// product modal image preview

document.addEventListener("DOMContentLoaded", function () {
  function handleFileInputChange(event, prodImagePreview) {
      const file = event.target.files[0];
      if (file) {
          const productReader = new FileReader();

          productReader.addEventListener('load', function () {
              const productImage = new Image();

              productImage.src = this.result;
              productImage.addEventListener('load', function () {
                  const ratio = Math.min(
                      prodImagePreview.clientWidth / this.width,
                      prodImagePreview.clientHeight / this.height
                  );
                  this.width *= ratio;
                  this.height *= ratio;
              });

              // Clear previous images
              while (prodImagePreview.firstChild) {
                  prodImagePreview.removeChild(prodImagePreview.firstChild);
              }

              prodImagePreview.appendChild(productImage);
          });

          productReader.readAsDataURL(file);
      }
  }

  var prodImageAdd = document.getElementById("product-img-input");
  var prodImageEdit = document.getElementById("edit-product-img");
  var prodImagePreviewAdd = document.querySelector("#prod-add-preview");
  var prodImagePreviewEdit = document.querySelector("#prod-edit-preview");

  prodImageAdd.addEventListener("change", function (event) {
      handleFileInputChange(event, prodImagePreviewAdd);
  });

  prodImageEdit.addEventListener("change", function (event) {
      handleFileInputChange(event, prodImagePreviewEdit);
  });
});



// product modal

var addProdBtn = document.querySelector(".add-product");
var productModal = document.getElementById("add-prod-modal");
var closeBtn = document.getElementsByClassName("prod-close")[0];

addProdBtn.onclick = function () {
    productModal.style.display = "block";
};

closeBtn.onclick = function () {
    productModal.style.display = "none";
};

window.onclick = function (event) {
    if (event.target == productModal) {
        productModal.style.display = "none";
    }
};


