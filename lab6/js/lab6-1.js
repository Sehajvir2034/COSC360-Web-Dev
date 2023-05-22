/* jQuery and JavaScript code here for lab6-1.html */
$(document).ready(function () {
  $("#pageTitle").text("Lab 6 - DOM Manipulation with jQuery");
  // Get the class name fo the msgArea Textbox
  var className = $("#msgArea").attr("class");
  // Change the placeholder value using the class name
  $("#msgArea").attr("placeholder", "My class is " + className);
  // Change the background color of "View Details" buttons to Red
  $(".btn-primary").css("backgroundColor", "red");
  // Change the background color of the body to Ivory
  $("body").css("backgroundColor", "ivory");
  // Add selected css class to divs with class name center_icons
  $(".center-icons").addClass("selected");

  $(".panel")
    .on("click", function () {
      $("#message").text("You clicked this panel");
    })

    .on("mousemove", function (e) {
      $("#message").text("x = " + e.pageX + " y = " + e.pageY);
    })
    .on("mouseleave", function () {
      $("#message").text("The mouse has left");
    });

  //Create a new img element using var and set its source to image source
  var newImage = document.createElement("img");
  newImage.src = "images/art/thumbs/13030.jpg";
  // Append the new img element to panel-2
  $("#panel-2").append(newImage);

  $("#stories img").on("mouseover", function () {
    // make dynamic element with larger preview image and caption
    var alt = $(this).attr("alt");
    var src = $(this).attr("src");
    var newsrc = src.replace("small", "medium");

    //construct preview filename based on existing img
    var preview = $('<div id="preview"></div>');
    var image = $('<img src="' + newsrc + '">');
    var caption = $("<p>" + alt + "</p>");

    preview.append(image);
    preview.append(caption);
    preview.addClass("preview-image");

    $(this).css("filter", "grayscale(100%)");
    $(".container").append(preview);
    $("#preview").fadeIn(1000);
  });
  $("#stories img").on("mouseleave", function () {
    $("#preview").remove();
    $(this).css("filter", "grayscale(0%)");
  });
});
