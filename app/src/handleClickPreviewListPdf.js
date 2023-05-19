export const handleClickPreviewListPdf = () => {
  document.getElementById("preview_pdf_list").addEventListener("click", () => {
    const current_url = window.location;
    const search = current_url.search;
    const url = `/pdf_list/${search}`;

    // Ouvrir une nouvelle fenêtre
    const pdfWindow = window.open("", "_blank");

    // Effectuer une requête vers l'URL du PDF
    fetch(url)
      .then((response) => response.blob())
      .then((blob) => {
        const reader = new FileReader();
        reader.onloadend = () => {
          const pdfContent = reader.result;
          pdfWindow.document.write(
            "<html><body><embed width='100%' height='100%' src='" +
              encodeURI(pdfContent) +
              "' type='application/pdf'></body></html>"
          );
        };
        reader.readAsDataURL(blob);
      })
      .catch((error) => {
        console.error("Erreur lors du chargement du PDF:", error);
      });
  });
};
