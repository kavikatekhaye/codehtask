<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> {{session()->get('success')}}
      </div>
    @endif
    <div class="container">
    <h1>Manage Category</h1>
   <a href="{{route('category.create')}}"> <button type="button" class="btn btn-success">Add</button></a>

    <table class="table" id="datatable1">
        <thead>

          <tr>
            <th scope="col">SR No</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        {{-- <tbody>
            @foreach ($data as $d)

          <tr>
            <th scope="row">{{$d->id}}</th>
            <td>{{$d->name}}</td>
            <td><button type="button" class="btn btn-primary">Edit</button>
                <button type="button" class="btn btn-danger">Delete</button></td>
          </tr>
          @endforeach

        </tbody> --}}
      </table>
    </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script >
    $(document).ready( function () {
      $('#datatable1').DataTable({
          "processing":true,
          "serverSide":true,
          "ajax":"{{route('category.index')}}",
          "columns":[
            {
              "data":"id",
              "name":"id"
          },
          {
              "data":"name",
              "name":"name"
          },
          {
              "data":"action",
              "name":"action"
          },


      ],

      });
  } );
  </script>
