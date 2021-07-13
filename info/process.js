/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("Dropdowna").classList.toggle("show");
}
function Functionb() {
  document.getElementById("Dropdownb").classList.toggle("show");
}
function Functionc() {
  document.getElementById("Dropdownc").classList.toggle("show");
}
function Functiond() {
  document.getElementById("Dropdownd").classList.toggle("show");
}
function Functione() {
  document.getElementById("Dropdowne").classList.toggle("show");
}
// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-contenta");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}