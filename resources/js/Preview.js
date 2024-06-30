// resources/js/components/Preview.js

import React from 'react';
import DocViewer, { DocViewerRenderers } from "@cyntler/react-doc-viewer";
import "@cyntler/react-doc-viewer/dist/index.css";

function Preview() {
    const docs = [
        { uri: require("../public/template1.docx").default, // Perhatikan penambahan .default
            fileType: "docx",
            fileName: "template1.docx"
         }, // Local File
    ];

    return (
        <div>
            <h1>Dokumen</h1>
            <DocViewer documents={docs} pluginRenderers={DocViewerRenderers} style={{ height: 1000 }} />
        </div>
    );
}

export default Preview;
