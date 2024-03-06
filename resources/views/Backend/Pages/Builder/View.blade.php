<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{!! $data->page_name !!} </title>
  <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>{!! $data->css !!}</style>
</head>

<body>
{!! $data->content !!}



<script >document.querySelector('[name="_token"]').value = document.head.querySelector('meta[name="csrf-token"]').content;</script>
</body>
</html>
