<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>CSRI</title>
    <link rel = "stylesheet" type ="text/css" href = "/css/index.css">
    <meta name = "csrf-token" content="{{csrf_token()}}">
  </head>
  <body>
    <div id="app">
      <navbar></navbar>
      <router-view></router-view>
      <vue-progress-bar></vue-progress-bar>
    </div>
  <script src="/js/app.js"></script>
  </body>
</html>
