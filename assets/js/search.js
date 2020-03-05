let alimLists = { "avec-aliment": [], "sans-aliment": [] }; // Objet global pour permettre l'interaction via ecouteurs/fonctions de tout le fichier

function verifyAlimExists(alimName, callback) {
  /**
   * Vérifie si l'aliment existe et appelle le callback avec le résultat en argument
   */
  $.ajax({
    url: "/api/alimExists",
    method: "GET",
    data: { alimName: alimName },
    success: response => callback(response.res),
  });
  return true;
}

function addEventAlimItems() {
  /**
   * Ajoute sur chaque aliment des liste (recherché/évité) un écouteur pour la suppression
   */
  $(".alim-item").each(function() {
    let alimName = $(this)
      .children("span")
      .text();
    $(this)
      .children("button")
      .on("click", function() {
        $(this)
          .parent()
          .remove();
        let i = alimLists["avec-aliment"].indexOf(alimName);
        if (i >= 0) alimLists["avec-aliment"].splice(i, 1);
        i = alimLists["sans-aliment"].indexOf(alimName);
        if (i >= 0) alimLists["sans-aliment"].splice(i, 1);
      });
  });
}

$(document).ready(() => {
  $("#search-btn").on("click", function() {
    let recipeName = $("#input-recipe-name").val();
    $("#recipe-list").load(
      "/api/searchRecipes",
      {
        title: recipeName,
        with_alims: alimLists["avec-aliment"],
        without_alims: alimLists["sans-aliment"],
        template: true,
      },
      initRecipesListeners
    );
  });

  $(".alim-select").each(function() {
    /**
     * Gérer la liste des aliments à rechercher/éviter
     */
    let btn = $(this).find("button");
    let ul = $(this).find("ul");
    let input = $(this).find("input");
    let inputName = $(input).attr("name");
    // console.log("btn: ", $(btn));

    $(input).on("keydown", function() {
      /**
       * Gérer l'autocomplétion selon la saisie actuelle
       */
      let text = $(this).val();
      let datalist = $("#" + $(this).attr("list"));
      $.ajax({
        url: "/api/searchAlim",
        method: "GET",
        data: { q: text },
        success: function(response) {
          if (response.ok) {
            $(datalist).empty();
            for (let al of response.res) {
              $(datalist).append('<option value="' + al + '"></option>');
            }
          }
        },
      });
    });

    $(btn).on("click", function() {
      /**
       * Gérer l'ajout d'un aliment dans une des liste (recherché/évité)
       */
      let alimName = $(input).val();
      if (
        alimLists["avec-aliment"].indexOf(alimName) === -1 &&
        alimLists["sans-aliment"].indexOf(alimName) === -1
      ) {
        verifyAlimExists(alimName, res => {
          if (res) {
            alimLists[inputName].push(alimName);
            $(ul).append(
              '<li class="alim-item"><span>' +
                alimName +
                "</span><button>&times;</button></li>"
            );
            addEventAlimItems(); //Ajouter le listener sur le bouton de suppression d'un aliment dans une liste
          } else alert("Cet aliment n'existe pas.");
        });
      }
    });
  });
});
