<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

    <title>Document</title>
</head>
<style>
    body{
        border: 2px solid black;
        padding: 10px
        
    }
    .div-img{
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .div-img img{
      display: block
    }
    .conducteur-table {
    border-collapse: collapse;
    width: 100%;
    margin: 10px 0;
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    font-size: 12px;
}

.conducteur-table th,
.conducteur-table td {
    border: 1px solid #999;
    padding: 8px 10px;
    text-align: left;
}
.conducteur-table thead {
    background-color: #4a90e2;
    color: #fff;
}
.conducteur-table tbody tr:nth-child(even) {
    background-color: #e6f0fa;
}
.conducteur-table tbody tr:nth-child(odd) {
    background-color: #fff;
}

</style>
<body>
   
    <div class="div-img">
         <img src="{{ storage_path('app/public/logoCelson.jpeg') }}" alt="Image">
    </div>
  
    @yield('content_pdf')

</body>
</html>