document.addEventListener("DOMContentLoaded", () => {
    const editor = new EditorJS({
      holder: 'editorjs',
      tools: {
        header: {
          class: Header,
          inlineToolbar: ['bold', 'italic'], 
          config: {
            levels: [2, 3, 4], 
            defaultLevel: 3,
          },
        },
        paragraph: {
          class: Paragraph,
          inlineToolbar: ['bold', 'italic', 'inlineCode'], 
        },
        inlineCode: InlineCode, 
        simpleImage: {
          class: SimpleImage, 
          config: {
            placeholder: 'Füge hier ein Bild hinzu',
          },
        },
        image: {
            class: ImageTool,
            config: {
              endpoints: {
                byFile: 'uploadFile.php', 
                byUrl: 'fetchUrl.php',    
              },
              field: 'image',
              types: 'image/*',
              caption: true,
              buttonContent: 'Bild auswählen oder URL einfügen',
            },
        },
      },
      placeholder: 'Beginne hier mit der Eingabe...',
      onReady: () => {
        console.log('Editor.js ist bereit!');
      },
    });
  
    
    const saveButton = document.getElementById('save-button');
    saveButton.addEventListener('click', () => {
      editor.save().then((outputData) => {
        console.log('Gespeicherte Daten:', outputData);
      }).catch((error) => {
        console.error('Fehler beim Speichern:', error);
      });
    });
  });
  