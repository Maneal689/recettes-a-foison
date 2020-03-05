function initRecipesListeners() {
  $(".recipe").each(function() {
    let parent = $(this);
    let toggler = $(this).find(".recipe-title");
    let title = $(toggler)
      .children("b")
      .text();
    let addFavStar = $(this).find(".fav-add");

    $(toggler).on("click", () => {
      $(parent).toggleClass("content-hidden");
    });

    $(addFavStar).on("click", function() {
      $.ajax({
        url: "/api/toggleFav",
        method: "POST",
        dataType: "json",
        data: { recipe_name: title },
        success: function(response) {
          if (response.ok) {
            $(addFavStar).toggleClass("far");
            $(addFavStar).toggleClass("fas");
          }
        },
        error: function(idk, error) {
          console.log("erreur: ", error);
        },
      });
    });
  });
}

$(document).ready(initRecipesListeners);
