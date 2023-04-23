export const handleClickDelete = () => {
  const delete_selected = document.getElementById("delete_selected");
  delete_selected.addEventListener("click", (ev) => {
    alert("delete select clicked");
  });
};
