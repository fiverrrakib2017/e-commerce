<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Landing Page</title>
  <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">
  <link
      href="https://unpkg.com/grapesjs/dist/css/grapes.min.css"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-custom-code"></script>
</head>
<body>

    <div id="gjs"></div>



<input type="hidden" name="content" id="pageContentInput" value="{{ $data->project_data }}">
<script src="https://unpkg.com/grapesjs"></script>

<script type="text/javascript" src="{{asset('Backend/js/grapesjs/index.js')}}"></script>
<script type="text/javascript">
const editor = grapesjs.init({
          container: '#gjs',
    plugins: [
          'grapesjs-custom-code',
          "api-component"
        ],
          storageManager: false,
          pluginsOpts: {},
          canvas: {
            styles: [
              "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css",
            ],
            scripts: [
              "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js",
            ],
          },
        });

//   // Set page content and CSS from the hidden inputs
// editor.loadProjectData(document.getElementById('pageContentInput').value);


</script>
</body>
</html>
