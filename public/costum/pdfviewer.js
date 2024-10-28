function pdfViewerFunction(path) {
    // Your PDF file URL
    var pdfUrl = path;

    // The container where the PDF will be rendered
    var pdfContainer = document.getElementById("pdf-container");

    // Show loading indicator
    var loadingIndicator = document.getElementById("loadingIndicator");
    loadingIndicator.style.display = "block";

    // Function to render PDF
    function renderPDF(url, container) {
        // Fetch the PDF file
        pdfjsLib.getDocument(url).promise.then(function (pdf) {
            // Function to render a single page
            function renderPage(pageNumber) {
                // Create a canvas element for each page
                var canvas = document.createElement("canvas");
                container.appendChild(canvas);

                // Set canvas dimensions for mobile view
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;

                // Render the page
                pdf.getPage(pageNumber).then(function (page) {
                    var viewport = page.getViewport({ scale: 1 });
                    var context = canvas.getContext("2d");
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    // Render the PDF page into the canvas
                    page.render({
                        canvasContext: context,
                        viewport: viewport,
                    });

                    // Render the next page if available
                    if (pageNumber < pdf.numPages) {
                        renderPage(pageNumber + 1);
                    } else {
                        // Hide loading indicator when all pages are rendered
                        loadingIndicator.style.display = "none";
                    }
                });
            }

            // Start rendering the first page
            renderPage(1);
        });
    }

    // Call the renderPDF function with your PDF file URL
    renderPDF(pdfUrl, pdfContainer);
}
