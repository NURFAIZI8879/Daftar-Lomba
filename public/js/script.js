// Mengatur Sidebar
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let dashboard = document.querySelector(".dashboard");

toggle.addEventListener("click", toggleSidebar);

let screenSmartphone = window.matchMedia("(max-width: 480px)");

function toggleSidebar() {
  navigation.classList.toggle("active");
  dashboard.classList.toggle("active");

  if (navigation.classList.contains("active") && dashboard.classList.contains("active")) {
    if (screenSmartphone.matches) {
      document.querySelector(".toggle.home-toggle").style.color = "maroon";
    }
  } else {
    if (screenSmartphone.matches) {
      document.querySelector(".toggle.home-toggle").style.color = "white";
    }
  }
};

function hideTaskbarMobile(screenSize) {
  if (screenSize.matches) {
    navigation.classList.remove("active");
    dashboard.classList.remove("active");
  }
}

let screenSize = window.matchMedia("(max-width: 1024px)")

hideTaskbarMobile(screenSize);
