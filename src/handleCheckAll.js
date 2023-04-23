export const handleCheckAll = () => {
  const checkboxAll = document.getElementById("selected_ids");

  checkboxAll.addEventListener("change", (event) => {
    const isChecked = event.target.checked;
    const checkboxes = document.querySelectorAll('input[name="deleted_ids[]"]');
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].type === "checkbox") {
        checkboxes[i].checked = isChecked;
      }
    }
  });
};
