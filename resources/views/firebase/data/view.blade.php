<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<div class="card text-center">
  <div class="card-header">
    view Data
  </div>
  <div class="card-body">
  <table class="table border">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Age</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    
      @php $i=1; @endphp
       @forelse ($usersData as $key => $item)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$item[1]['name']}}</td>
      <td>{{$item[1]['email']}}</td>
      <td>{{$item[1]['age']}}</td>
      <td><a href="{{ url('edit_contact/'.$key) }}" class="btn btn-primary">Update</a></td>
      <td><a href="/" class="btn btn-danger">Delete</a></td>
    </tr>
      @empty  
    <tr>
      <td colspan="7">No record Found</td>
    </tr>
    @endforelse 
  </tbody>
</table>
  <!-- <form action="/insert" method="post">
      @csrf
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="name" name="name" placeholder="Name">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="email" name="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Age</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="age" name="age" placeholder="Age">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div> -->
  
</form>
    <!-- <a href="/index" class="btn btn-primary">Submit Data</a> -->
  </div>
  <div class="card-footer text-muted">
    
  </div>
</div>