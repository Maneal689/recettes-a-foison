$(document).ready(() => {
  $("#toggle-nav").on("click", function() {
    $(this).toggleClass("active");
    $("#home-nav").toggleClass("active");
  });
});
