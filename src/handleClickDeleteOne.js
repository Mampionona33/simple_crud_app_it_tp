export const handleClickDeleteOne = () => {
  const delete_one = document.getElementsByName("delete_one");
  const tableForm = document.getElementById("tableForm");

  if (delete_one.length > 0) {
    delete_one.forEach((element) => {
      const btnId = element.getAttribute("id");
      const clickedButton = document.getElementById(btnId);

      clickedButton.addEventListener("click", (ev) => {
        ev.preventDefault(); // Annuler le comportement par défaut du bouton submit
        const confirmDelete = confirm(
          `Êtes-vous sûr de vouloir supprimer ${clickedButton.dataset.user} ?`
        );
        if (confirmDelete) {
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
  }
};
