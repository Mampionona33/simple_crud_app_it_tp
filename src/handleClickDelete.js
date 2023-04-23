export const handleClickDelete = () => {
  const delete_selected = document.getElementById("delete_selected");
  const deleted_ids = document.querySelectorAll('input[name="deleted_ids[]"]');
  const tableForm = document.getElementById("tableForm");

  delete_selected.addEventListener("click", (ev) => {
    const listSelectedId = [];

    deleted_ids.forEach((element) => {
      const checkedElement = element.checked;
      if (checkedElement) {
        listSelectedId.push(element.value);
      }
    });

    if (listSelectedId.length > 0) {
      const confirmDelete = confirm(
        "Êtes-vous sûr de vouloir supprimer ces éléments ?"
      );

      if (confirmDelete) {
        // Suppression des champs cachés ajoutés
        document
          .querySelectorAll('input[name="delete_id"]')
          .forEach((input) => input.remove());
        // Soumission du formulaire
        tableForm.submit();
      }
    } else {
      alert("Veuillez sélectionner au moins un élément à supprimer.");
    }
  });
};
