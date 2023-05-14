import Swal from "sweetalert2";

export const handleClickDeleteOne = () => {
  const delete_one = document.getElementsByName("delete_one");
  const tableForm = document.getElementById("tableForm");

  if (delete_one.length > 0) {
    delete_one.forEach((element) => {
      const btnId = element.getAttribute("id");
      const clickedButton = document.getElementById(btnId);

      clickedButton.addEventListener("click", (ev) => {
        ev.preventDefault(); // Annuler le comportement par défaut du bouton submit

        Swal.fire({
          title: "Êtes-vous sûr ?",
          text: `Êtes-vous sûr de vouloir supprimer ${clickedButton.dataset.user} ?`,
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Oui, supprimer",
        }).then((result) => {
          if (result.isConfirmed) {
            const hidenInput = document.createElement("input");
            const userId = clickedButton.dataset.id;
            hidenInput.setAttribute("type", "hidden");
            hidenInput.setAttribute("name", "delete_user_id");
            hidenInput.setAttribute("value", userId);
            tableForm.appendChild(hidenInput);
            tableForm.submit();
            tableForm.remove(hidenInput);
          }
        });
      });
    });
  }
};
