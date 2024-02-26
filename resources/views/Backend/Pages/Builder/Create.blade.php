<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Landing Page</title>
  <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">
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

<div class="row mt-2">
  <div class="col-md-4 m-auto">
    <div class="mb-2">
      <div class="mb-2">
        <form id="savePageForm" action="{{route('admin.landing_page.save_page')}}" method="post">
        @csrf
        <input type="hidden" name="content" id="pageContentInput">
        <input type="hidden" name="css" id="pageCssInput">
        <input type="text" name="page_name" id="page_name" class="form-control mb-1" placeholder="Enter Page Name" required>
        <input type="text" name="page_slug" id="page_slug" class="form-control mb-1" placeholder="Enter Page Slug" required>
          <button type="submit" class="btn btn-success">Save Page Now</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://unpkg.com/grapesjs"></script>
<script src="https://unpkg.com/grapesjs-preset-newsletter"></script>
<script src="https://unpkg.com/grapesjs-preset-webpag"></script>

<script src="https://unpkg.com/grapesjs-blocks-basic"></script>
<script src="https://unpkg.com/grapesjs-plugin-forms"></script>
<script src="https://unpkg.com/grapesjs-component-countdown"></script>
<script src="https://unpkg.com/grapesjs-plugin-export"></script>
<script src="https://unpkg.com/grapesjs-tabs"></script>
<script src="https://unpkg.com/grapesjs-custom-code"></script>
<script src="https://unpkg.com/grapesjs-touch"></script>
<script src="https://unpkg.com/grapesjs-parser-postcss"></script>
<script src="https://unpkg.com/grapesjs-tooltip"></script>
<script src="https://unpkg.com/grapesjs-tui-image-editor"></script>
<script src="https://unpkg.com/grapesjs-typed"></script>
<script src="https://unpkg.com/grapesjs-style-bg"></script>
<script type="text/javascript">
    const editor = grapesjs.init({
    container: '#gjs',
    plugins: [
          'grapesjs-preset-newsletter',
          'gjs-blocks-basic',
          'grapesjs-plugin-forms',
          'grapesjs-component-countdown',
          'grapesjs-plugin-export',
          'grapesjs-tabs',
          'grapesjs-custom-code',
          'grapesjs-touch',
          'grapesjs-parser-postcss',
          'grapesjs-tooltip',
          'grapesjs-tui-image-editor',
          'grapesjs-typed',
          'grapesjs-style-bg',
          'grapesjs-preset-webpage',
        ],
    fromElement: true,
    storageManager: false,
  });

  /*----------Page Builder  Menu--------------*/
  var __page__content__input=document.getElementById('pageContentInput');
  var __page__css__input = document.getElementById('pageCssInput'); 
  document.getElementById('savePageForm')
  .addEventListener('submit',function(event){
    event.preventDefault();
    __page__content__input.value=editor.getHtml();
    __page__css__input.value=editor.getCss();
    this.submit();
  });

</script>
</body>
</html>
