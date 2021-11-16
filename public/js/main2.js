/////submit for edit name task///////////////
function submitF(preFix, formId) {
  // alert(preFix + formId);
  document.getElementById(preFix + formId).submit();
}

function modalAccountOption() {
  var accountmodal = document.getElementById("accountModal");

  accountmodal.style.display = "block";

  window.onclick = function (event) {
    if (event.target == accountmodal) {
      accountmodal.style.display = "none";
    }
  }

}

