(function ($) {
  $(document).ready(function () {
    var loaderHTML =
      '<div id="eum-loader-overlay" role="dialog" aria-modal="true" aria-label="Export in progress">' +
      '<div id="eum-loader-message">' +
      '<button id="eum-loader-close" aria-label="Close loader">X</button>' +
      '<div id="eum-loader-text">Download has started...</div>' +
      "</div>" +
      "</div>";
    $("body").append(loaderHTML);

    // When the close button is clicked, hide the overlay.
    $("#eum-loader-close").on("click", function (e) {
      e.preventDefault();
      $("#eum-loader-overlay").hide();
    });

    // Allow closing the overlay via the Esc key.
    $(document).on("keyup", function (e) {
      if (e.key === "Escape") {
        $("#eum-loader-overlay").hide();
      }
    });

    // When the export form is submitted, show the overlay.
    $("form").on("submit", function () {
      $("#eum-loader-overlay").show();
      $(this).find('button[type="submit"]').attr("disabled", "disabled");
      // Set focus to close button for accessibility.
      $("#eum-loader-close").focus();
    });
  });
})(jQuery);
