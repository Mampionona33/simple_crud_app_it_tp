import swal from "sweetalert2";

export const handleClickDeleteSelected = () => {
  const delete_selected = document.getElementById("delete_selected");
  const deleted_ids = document.querySelectorAll('input[name="deleted_ids[]"]');
  const tableForm = document.getElementById("tableForm");

  delete_selected &&
    delete_selected.addEventListener("click", (ev) => {
      const listSelectedId = [];

      deleted_ids.forEach((element) => {
        const checkedElement = element.checked;
        if (checkedElement) {
          listSelectedId.push(element.value);
        }
      });

      if (listSelectedId.length > 0) {
        swal
          .fire({
            title: "Êtes-vous sûr ?",
            text: "Vous êtes sur le point de supprimer ces éléments",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Oui, supprimer",
            cancelButtonText: "Annuler",
          })
          .then((result) => {
            if (result.isConfirmed) {
              // Suppression des champs cachés ajoutés
              document
                .querySelectorAll('input[name="delete_id"]')
                .forEach((input) => input.remove());
              // Soumission du formulaire
              tableForm.submit();
            }
          });
      } else {
        swal.fire({
          title: "Erreur",
          text: "Veuillez sélectionner au moins un élément à supprimer",
          icon: "error",
          confirmButtonText: "OK",
        });
      }
    });
};
