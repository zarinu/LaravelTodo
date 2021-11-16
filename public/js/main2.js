/////submit for edit name task///////////////
function submitF(preFix, formId) {
  // alert(preFix + formId);
  document.getElementById(preFix + formId).submit();
}
// function toChangeTick(id) {
//   // alert("lala");
//   var status = 'todo';
//   if ($("#done" + id).prop('checked') == true) {
//     status = 'done';
//   }
//   alert("<?php echo 'jon'; ?>");
//     $.ajax({
//       type: "PUT",
//       url: "{{route('showEditTask', id)}}",
//       data: {
//         status: status
//       }, // serializes the form's elements.
//       success: function (data) {
//         location.reload();
//       }
//     });
// }


// //about collaborate modal
// var collabmodal = document.getElementById("modalco");
// var collabBtns = document.getElementsByClassName("btnOpenCollabModal");
// var closeCollabModal = document.getElementById("closeSubmitmodal");
// var taskcollabID;

// for (let i = 0; i < collabBtns.length; i++) {
//     collabBtns[i].onclick = function () {
//         collabmodal.style.display = "block";
//         taskcollabID = collabBtns[i].getAttribute('id');
//     }
// }

// closeCollabModal.onclick = function () {
//     var taskCID = document.getElementById("taskCID");
//     taskCID.value = taskcollabID;
//     collabmodal.style.display = "none";
// }

// window.onclick = function (event) {
//     if (event.target == collabmodal) {
//         collabmodal.style.display = "none";
//     }
// }

function modalAccountOption() {
  var accountmodal = document.getElementById("accountModal");

  accountmodal.style.display = "block";

  window.onclick = function (event) {
    if (event.target == accountmodal) {
      accountmodal.style.display = "none";
    }
  }

}

