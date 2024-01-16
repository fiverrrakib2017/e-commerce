<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Drag And Drop</title>
    <link href="{{asset('Backend/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
     <link href="{{asset('Backend/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet"> 
    <link href="{{asset('Backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/css/toastr.min.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
  </head>

  <body>
    <div class="">
      <div class="">
        <div id="gjs"> <h1>Hello World Component!</h1></div>
      </div>
    </div>   
    

   <script type="text/javascript" src="https://unpkg.com/grapesjs@0.21.8/dist/grapes.min.js"></script>
    <script type="text/javascript">
      const editor = grapesjs.init({
        container: '#gjs',
        components: '<div class="txt-red">Hello world!</div>',
        fromElement: true,
            storageManager: {
                autoload: true,
                autosave: true,
                type: 'localStorage',
                stepsBeforeSave: 1,
            },
            panels: {
                defaults: [
                    {
                        id: 'basic-actions',
                        el: '.panel__basic-actions',
                        buttons: [
                            {
                                id: 'export',
                                command: 'export-template',
                                className: 'btn-open-export',
                                label: 'Export',
                            },
                        ],
                    },
                ],
            },
            plugins: [
                'gjs-preset-webpage',
                'grapesjs-blocks-basic',
                'grapesjs-navbar',
                'grapesjs-forms',
                'grapesjs-custom-code',
            ],
            assetManager: {
                embedAsBase64: true,
            },
            styleManager: {
                clearProperties: true,
            },
            layerManager: {
                appendTo: '.layers-container',
            },
    });
    </script>
  </body>
</html>
