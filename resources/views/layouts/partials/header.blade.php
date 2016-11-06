
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title', 'My Contact')</title>

    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/custom.css" rel="stylesheet">
    <link href="/assets/css/dropzone.css" rel="stylesheet">
    <link href="/assets/css/jquery.bxslider.css" rel="stylesheet" />
    <script src="/assets/js/dropzone.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{--     <script>
      var Dropzone = require("enyo-dropzone");
      Dropzone.autoDiscover = false;
    </script> --}}

    <style>
        html, body {
        height: 100%;
        }
        #actions {
        margin: 2em 0;
        }
        /* Mimic table appearance */
        div.table {
        display: table;
        }
        div.table .file-row {
        display: table-row;
        }
        div.table .file-row > div {
        display: table-cell;
        vertical-align: top;
        border-top: 1px solid #ddd;
        padding: 8px;
        }
        div.table .file-row:nth-child(odd) {
        background: #f9f9f9;
        }
        /* The total progress gets shown by event listeners */
        #total-progress {
        opacity: 0;
        transition: opacity 0.3s linear;
        }
        /* Hide the progress bar when finished */
        #previews .file-row.dz-success .progress {
        opacity: 0;
        transition: opacity 0.3s linear;
        }
        /* Hide the delete button initially */
        #previews .file-row .delete {
        display: none;
        }
        /* Hide the start and cancel buttons and show the delete button */
        #previews .file-row.dz-success .start,
        #previews .file-row.dz-success .cancel {
        display: none;
        }
        #previews .file-row.dz-success .delete {
        display: block;
        }
    </style>
  </head>
  <body>