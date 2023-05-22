window.addEventListener("load", function (e) {
  let requiredFields = document.querySelectorAll(".required");
  document.getElementById("mainForm").onsubmit = function (e) {
    requiredFields.forEach((input) => {
      if (input.value === "") {
        input.classList.add("highlightStyle");
        highlightFields(input);
        e.preventDefault();
        alert(input.name + " field is left empty.");
      } else if (input.type === "checkbox") {
        if (!input.checked) {
          highlightCheckbox(input);
          e.preventDefault();
          alert("Software license not accepted.");
        }
      }
    });
  };
  this.document.getElementById("mainForm").onchange = function (e) {
    requiredFields.forEach((input) => {
      if (input.value !== "") {
        cleanHighlight(input);
      }
      if (input.type === "checkbox") {
        if (input.checked) {
          cleanCheckBox(input);
        }
      }
    });
  };
});

function highlightFields(e) {
  e.classList.add("highlight");
  return;
}
function highlightCheckbox(e) {
  e.parentElement.classList.add("highlight");
}
function cleanHighlight(e) {
  e.classList.remove("highlight");
  return;
}
function cleanCheckBox(e) {
  e.parentElement.classList.remove("highlight");
}
