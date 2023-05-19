export const handleClickPreviewListPdf = () => {
  document.getElementById("preview_pdf_list").addEventListener("click", () => {
    const xhr = new XMLHttpRequest();
    const current_url = window.location;
    const pathname = current_url.pathname;
    const search = current_url.search;
    console.log(current_url);
    xhr.open("GET", `/pdf_list/${search}`, true);
    xhr.onreadystatechange = () => {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        console.log(xhr.responseText);
      }
    };
    xhr.send();
  });
};
