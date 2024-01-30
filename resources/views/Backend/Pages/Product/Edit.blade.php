<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Make Product Landing Page</title>
  <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
  <style>
  .gjs-block {
    width: auto;
    height: auto;
    min-height: auto;
  }
  .panel__top {
  padding: 0;
  width: 100%;
  display: flex;
  position: initial;
  justify-content: center;
  justify-content: space-between;
}




  </style>
</head>
<body>
<div class="panel__top">
    <div class="panel__basic-actions"></div>
</div>
    <div id="gjs"><h1>Hello World Component!</h1></div>
  <div class="panel__right"></div>
<div id="blocks"></div>
<script src="https://unpkg.com/grapesjs"></script>
<script type="text/javascript">
    const editor = grapesjs.init({
    container: '#gjs',
    fromElement: true,
    
    // Size of the editor
    // Disable the storage manager for the moment
    storageManager: false,
    // Avoid any default panel
    //panels: { defaults: [] },

    blockManager: {
    appendTo: '#blocks',
    blocks: [
        {
          id: 'image',
          label: 'Image',
          media: `<svg style="width:24px;height:24px" viewBox="0 0 24 24">
              <path d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z" />
          </svg>`,
          // Use `image` component
          content: { type: 'image' },
          // The component `image` is activatable (shows the Asset Manager).
          // We want to activate it once dropped in the canvas.
          activate: true,
          // select: true, // Default with `activate: true`
        },
        {
          id: 'section', // id is mandatory
          label: '<b>Section</b>', // You can use HTML/SVG inside labels
          attributes: { class:'gjs-block-section' },
          content: `<section>
            <h1>This is a simple title</h1>
            <div>This is just a Lorem text: Lorem ipsum dolor sit amet</div>
          </section>`,
        }, {
          id: 'text',
          label: 'Text',
          content: '<div data-gjs-type="text">Insert your text here</div>',
        }, {
          id: 'image',
          label: 'Image',
          // Select the component once it's dropped
          select: true,
          // You can pass components as a JSON instead of a simple HTML string,
          // in this case we also use a defined component type `image`
          content: { type: 'image' },
          // This triggers `active` event on dropped components and the `image`
          // reacts by opening the AssetManager
          activate: true,
        }
      ]
    },
  });
  editor.BlockManager.add('my-block-id', {
  content: {
    tagName: 'div',
    draggable: false,
    attributes: { 'some-attribute': 'some-value' },
    components: [
      {
        tagName: 'span',
        content: '<b>Some static content</b>',
      }, {
        tagName: 'div',
        // use `content` for static strings, `components` string will be parsed
        // and transformed in Components
        components: '<span>HTML at some point</span>',
      }
    ]
  }
});



</script>
</body>
</html>