<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ env('APP_NAME') }}</title>

  <link rel="stylesheet" href="/css/app.css">
</head>

<body>

<div class="wrapper">
    <!-- Main content -->
    <div class="content">
        <main>
            @yield('content')
        </main>
    </div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="/js/app.js"></script>

</body>
</html>
