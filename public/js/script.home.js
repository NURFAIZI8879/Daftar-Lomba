function countdownTimer() {
  const endDate = new Date("July 31, 2024 23:59:59").getTime();
  const daysElement = document.getElementById("days");
  const hoursElement = document.getElementById("hours");
  const minutesElement = document.getElementById("minutes");
  const secondsElement = document.getElementById("seconds");

  setInterval(function () {
    const now = new Date().getTime();
    const distance = endDate - now;

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    daysElement.innerHTML = `${days}<br><span>HARI</span>`;
    hoursElement.innerHTML = `${hours}<br><span>JAM</span>`;
    minutesElement.innerHTML = `${minutes}<br><span>MENIT</span>`;
    secondsElement.innerHTML = `${seconds}<br><span>DETIK</span>`;

    if (distance < 0) {
      clearInterval(this);
      daysElement.innerHTML = "00<br><span>HARI</span>";
      hoursElement.innerHTML = "00<br><span>JAM</span>";
      minutesElement.innerHTML = "00<br><span>MENIT</span>";
      secondsElement.innerHTML = "00<br><span>DETIK</span>";
    }
  }, 1000);
}

function setActiveLink() {
  const sections = document.querySelectorAll("section");
  const navLinks = document.querySelectorAll(".nav-link");

  window.addEventListener("scroll", () => {
    let current = "";

    sections.forEach((section) => {
      const sectionTop = section.offsetTop - 60;
      if (pageYOffset >= sectionTop) {
        current = section.getAttribute("id");
      }
    });

    navLinks.forEach((link) => {
      link.classList.remove("active");
      if (link.getAttribute("href").substring(1) === current) {
        link.classList.add("active");
      }
    });
  });

  navLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href").substring(1);
      const targetElement = document.getElementById(targetId);

      window.scrollTo({
        top:
          targetElement.offsetTop -
          document.querySelector(".header").offsetHeight,
        behavior: "smooth",
      });

      navLinks.forEach((link) => link.classList.remove("active"));
      this.classList.add("active");
    });
  });
}

function animateTimelineItems() {
  const timelineItems = document.querySelectorAll(".timeline-item");
  const observerOptions = {
    root: null,
    rootMargin: "0px",
    threshold: 0.1,
  };

  function observerCallback(entries, observer) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate");
      } else {
        entry.target.classList.remove("animate");
      }
    });
  }

  const observer = new IntersectionObserver(observerCallback, observerOptions);
  timelineItems.forEach((item) => observer.observe(item));
}

function initLombaItems() {
  const lombaItems = document.querySelectorAll(".lomba-item");
  lombaItems.forEach((item) => {
    item.addEventListener("click", function () {
      this.classList.toggle("flipped");
    });
  });
}

function showDetail() {
  alert("Detail Pengumuman Finalis");
}

document.addEventListener("DOMContentLoaded", function () {
  const contents = document.querySelectorAll(".content");
  const containers = document.querySelectorAll(".timeline-container");

  function checkPosition() {
    contents.forEach((content, index) => {
      const rect = content.getBoundingClientRect();
      if (
        rect.top >= 0 &&
        rect.bottom <=
          (window.innerHeight || document.documentElement.clientHeight)
      ) {
        content.classList.add("show");
        containers[index].classList.add("show");
      } else {
        content.classList.remove("show");
        containers[index].classList.remove("show");
      }
    });
  }

  window.addEventListener("scroll", checkPosition);
  window.addEventListener("resize", checkPosition);
  checkPosition(); // Initial check
});

let navbarResponsive = $(".wadah-navbar");
let headerMain = $(".header");
let menuButton = $("#menu-button");
let closeButton = $("#menu-button-close");
navbarResponsive.hide();

function toggleNavbar() {
  navbarResponsive.fadeToggle(400, "linear");
  headerMain.toggleClass("aktif");
  menuButton.toggle();
  closeButton.toggle();
}

countdownTimer();
setActiveLink();
animateTimelineItems();
initLombaItems();

/*animasi pengumunan*/
document.addEventListener("DOMContentLoaded", function () {
  const videoPlaceholders = document.querySelectorAll(
    ".video-placeholder, .video-placeholder-s"
  );
  const sambutanDescription = document.querySelector(".sambutan-description");

  // Fungsi untuk mengecek posisi elemen di dalam viewport
  function checkPosition() {
    videoPlaceholders.forEach((video) => {
      const rect = video.getBoundingClientRect();
      if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
        video.classList.add("show"); // Animasi masuk
      } else {
        video.classList.remove("show"); // Animasi keluar
      }
    });

    const sambutanRect = sambutanDescription.getBoundingClientRect();
    if (sambutanRect.top >= 0 && sambutanRect.bottom <= window.innerHeight) {
      sambutanDescription.classList.add("show"); // Animasi masuk
    } else {
      sambutanDescription.classList.remove("show"); // Animasi keluar
    }
  }

  // Jalankan fungsi ketika pengguna scroll atau resize
  window.addEventListener("scroll", checkPosition);
  window.addEventListener("resize", checkPosition);

  // Panggil fungsi saat pertama kali halaman dimuat
  checkPosition();
});

/* Oval-shape animasi */

document.addEventListener("DOMContentLoaded", function () {
  const ovalShapes = document.querySelectorAll(".oval-shape");

  function checkPosition() {
    ovalShapes.forEach((oval) => {
      const rect = oval.getBoundingClientRect();
      if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
        // Jika elemen terlihat di viewport, tambahkan kelas 'show'
        oval.classList.add("show");
      } else {
        // Jika elemen tidak terlihat, hapus kelas 'show'
        oval.classList.remove("show");
      }
    });
  }

  // Event listener untuk mengecek posisi saat pengguna scroll atau resize
  window.addEventListener("scroll", checkPosition);
  window.addEventListener("resize", checkPosition);

  // Pengecekan awal saat halaman dimuat
  checkPosition();
});

/*animasi lomba item*/

document.addEventListener("DOMContentLoaded", function () {
  const lombaContent = document.querySelector(".lomba-content");

  function checkPosition() {
    const rect = lombaContent.getBoundingClientRect();

    if (window.innerWidth > 768) {
      if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
        // Jika elemen terlihat di viewport, tambahkan kelas 'show'
        lombaContent.classList.add("show");
      } else {
        // Jika elemen tidak terlihat, hapus kelas 'show'
        lombaContent.classList.remove("show");
      }
    } else {
      if (rect.top >= -300 && rect.bottom <= window.innerHeight + 500) {
        // Jika elemen terlihat di viewport, tambahkan kelas 'show'
        lombaContent.classList.add('show');
      } else {
        // Jika elemen tidak terlihat, hapus kelas 'show'
        lombaContent.classList.remove('show');
      }
    }
  }

  // Event listener untuk mengecek posisi saat pengguna scroll atau resize
  window.addEventListener("scroll", checkPosition);
  window.addEventListener("resize", checkPosition);

  // Pengecekan awal saat halaman dimuat
  checkPosition();
});

/*animasi pengumuman*/
document.addEventListener("DOMContentLoaded", function () {
  const pengumumanItems = document.querySelectorAll(".pengumuman-item");

  const observerOptions = {
    root: null, // Menggunakan viewport sebagai root
    rootMargin: "0px",
    threshold: 0.1, // Elemen dianggap terlihat jika 10% elemen terlihat di viewport
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        // Tambahkan kelas 'show' saat elemen terlihat di viewport
        entry.target.classList.add("show");
      } else {
        // Hapus kelas 'show' jika elemen tidak terlihat
        entry.target.classList.remove("show");
      }
    });
  }, observerOptions);

  // Amati setiap item pengumuman
  pengumumanItems.forEach((item) => {
    observer.observe(item);
  });
});
