@extends('layout.main')

@section('title', 'Student')

@section('container')

<div class="container">
    <div class="row mt-4">
        <div class="col-8">
            <h1><i class="bi bi-people-fill"></i> Student</h1>
        </div>
        <div class="col-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Students</li>
                </ol>
              </nav>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
           
            <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mt-2 float-left" title="create" data-toggle="modal" data-target="#createData">
                  <i class="bi bi-plus-lg"></i>  Create
                </button>

                <form class="float-right mt-2" action="{{url('/students')}}" method="get">@csrf
                <input type="text" name="text_search" class="form-control" placeholder="search student: nim or name">
                </form>
            </div>

            <div class="card-body">       

@if (session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
@if(!empty($students))  
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIM</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($students as $row)
    <tr>    
      <th scope="row">{{++$no}}</th>
      <td>{{$row->nim}}</td>
      <td>{{$row->name}}</td>
      <td>{{$row->email}}</td>
      
      <td>
        <a href="/students/{{$row->id}}" class="btn btn-success mr-2" title="Detail"><i class="bi bi-info-lg"></i> Detail</a>
        <button type="button" class="btn btn-danger" title="Delete" data-toggle="modal" data-target="#deleteData{{$row->id}}">
          <i class="bi bi-trash"></i> Delete
        </button>

      </td>

    </tr>
    @endforeach
       
  </tbody>
</table>
  @else
    <p>data not available</p>
  @endif

  {{-- end of table --}}

    <div class="table-nav">
      <hr>
           <div class="count-data">
              <strong> Count : {{$student_count}}</strong>
            </div>
            <div class="paging">
                {{$students->links()}}
            </div>
    </div>
    {{-- end of table-nav --}}         
                </div>
              </div>

        </div>
    </div>
</div>
@endsection

<!-- Modal Create Data-->
<div class="modal fade" id="createData" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createDataLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createDataLabel">Create Data Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{action('StudentsController@store')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label class="font-weight-bold">NIM</label>
            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{old('nim')}}" placeholder="input NIM">
            @error('nim') <div class="invalid-feedback">{{$message}}</div>@enderror
          </div>
          <div class="form-group">
            <label class="font-weight-bold">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="input name">
            @error('name') <div class="invalid-feedback">{{$message}}</div>@enderror
          </div>     
          <div class="form-group">
            <label class="font-weight-bold">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="input email">
            @error('email') <div class="invalid-feedback">{{$message}}</div>@enderror
          </div>     
          <div class="form-group">
            <label class="font-weight-bold">Address</label>
            <input type="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address')}}" placeholder="input address">
            @error('address') <div class="invalid-feedback">{{$message}}</div>@enderror
          </div>
          <div class="form-group">
            <label class="font-weight-bold">Major</label>
            <select name="major_id" class="form-control">
              <option value="">--Choose a Major--</option>
              @foreach ($major_list as $data)
                  <option value="{{$data->id}}">{{$data->major_code.' - '.$data->major_name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="font-weight-bold">Course</label>
            <select name="course_id" class="form-control">
              <option value="">--Choose a Course--</option>
              @foreach ($course_list as $data)
                  <option value="{{$data->id}}">{{$data->no_course.' - '.$data->course_name}}</option>
              @endforeach
            </select>
          </div>

          {{-- upload Image--}}
           <div class="form-group">
            <label class="font-weight-bold">Upload Image</label>
            <input type="file" class="form-control @error('images') is-invalid @enderror" value="{{old('images')}}" name="images">
            @error('images') <div class="invalid-feedback">{{$message}}</div>@enderror
          </div>

             
         
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal Delete-->
@foreach ($students as $data)
<div class="modal fade" id="deleteData{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteDataBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{action('StudentsController@destroy', $data->id)}}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <p>Do you wanna deleted data student <b>{{$data->name}}</b> ?</p>    
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>  
      </div>
    </div>
  </div>
</div>
@endforeach