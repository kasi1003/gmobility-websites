(function ($) {
  ("use strict");

  // Spinner
  var spinner = function () {
    setTimeout(function () {
      if ($("#spinner").length > 0) {
        $("#spinner").removeClass("show");
      }
    }, 1);
  };
  spinner();

  // Initiate the wowjs
  new WOW().init();

  // Sticky Navbar
  $(window).scroll(function () {
    if ($(this).scrollTop() > 45) {
      $(".navbar").addClass("sticky-top shadow-sm");
    } else {
      $(".navbar").removeClass("sticky-top shadow-sm");
    }
  });

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false;
  });

  // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1500,
    dots: true,
    loop: true,
    center: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
    },
  });

  // Vendor carousel
  $(".vendor-carousel").owlCarousel({
    loop: true,
    margin: 45,
    dots: false,
    loop: true,
    autoplay: true,
    smartSpeed: 1000,
    responsive: {
      0: {
        items: 2,
      },
      576: {
        items: 4,
      },
      768: {
        items: 6,
      },
      992: {
        items: 8,
      },
    },
  });
  //cart toggle
    // Get references to the cart icon and the list group
    const cartIcon = document.getElementById("cart-icon");
    const listGroup = document.querySelector(".custom-list-group");
  
    // Function to toggle the list group visibility
    function toggleListVisibility() {
      if (listGroup.style.display === "none" || listGroup.style.display === "") {
        listGroup.style.display = "block";
      } else {
        listGroup.style.display = "none";
      }
    }
  
    // Add a click event listener to the cart icon
    cartIcon.addEventListener("click", toggleListVisibility);
  
    // Add a click event listener to the document to hide the list group when clicking outside
    document.addEventListener("click", (event) => {
      if (!listGroup.contains(event.target) && event.target !== cartIcon) {
        listGroup.style.display = "none";
      }
    });


    
})(jQuery);
