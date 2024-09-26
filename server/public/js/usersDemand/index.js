window.onload = function () {
  const toogle = toogleDatatable();
  const noContent = document.getElementById("no-content");
  toogle ? addNoContentCss() : (noContent.style = "display: none;");
};

function toogleDatatable() {
  const datatable = document.getElementById("toogle-datatable");
  const toogle = datatable.textContent;
  return toogle == "hidden" ? true : false;
}

function addNoContentCss() {
  const main = document.getElementById("main");
  const content = document.getElementById("ctrl-demand");

  main.style.display = "flex";
  main.style.alignSelf = "center";
  main.style.justifyContent = "center";

  content.style = "display: none;";
}
