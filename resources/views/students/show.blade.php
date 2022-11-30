@extends('layout.main')

@section('title','Detail Student')
    
@section('container')

<div class="container">
    <div class="row mt-4">
        <div class="col-8">
            <h1><i class="bi bi-person-fill"></i> Detail Student</h1>
        </div>
        <div class="col-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{url('/students')}}">Students</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
              </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <a href="{{url('/students')}}" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Back</a>
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-primary ml-2 mb-3" title="Edit" data-toggle="modal" data-target="#editData">
                      <i class="bi bi-pencil-square"></i> Edit
                    </button>
                    <table class="table table-bordered">                
                          <tr>
                            <th scope="row">NIM</th>
                            <td>{{$student->nim}}</td>
                            <td rowspan="5"><img width="250px" height="200px" src="{{asset('images/'.$student->images)}}"></td>   
                          </tr>
                          <tr>
                            <th scope="row">Name</th>
                            <td>{{$student->name}}</td>   
                              
                          </tr>
                          <tr>
                            <th scope="row">Email</th>
                            <td>{{$student->email}}</td>   
                          </tr>
                          <tr>
                            <th scope="row">Address</th>
                            <td>{{$student->address}}</td>   
                          </tr>
                          <tr>
                            <th scope="row">Major</th>
                            <td>{{$student->major->major_name}}</td>   
                          </tr>
                          <tr>
                            <th scope="row">Course</th>
                            <td>{{$student->course->course_name}}</td>   
                            <td><b>Url SEO : </b> {{$student->name_seo}}</td> 
                            
                          </tr>
                      </table>
 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<!-- Modal Edit Data-->

<div class="modal fade" id="editData" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createDataLabel">Create Data Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{action('StudentsController@update',$student->id)}}" enctype="multipart/form-data">
          @method('PATCH')
          @csrf
          <div class="form-group">
            <label class="font-weight-bold">NIM</label>
            <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{$student->nim}}" placeholder="input NIM">
            @error('nim') <div class="invalid-feedback">{{$message}}</div>@enderror
          </div>
          <div class="form-group">
            <label class="font-weight-bold">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$student->name}}" placeholder="input name">
            @error('name') <div class="invalid-feedback">{{$message}}</div>@enderror
          </div>     
          <div class="form-group">
            <label class="font-weight-bold">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$student->email}}" placeholder="input email">
            @error('email') <div class="invalid-feedback">{{$message}}</div>@enderror
          </div>     
          <div class="form-group">
            <label class="font-weight-bold">Address</label>
            <input type="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{$student->address}}" placeholder="input address">
            @error('address') <div class="invalid-feedback">{{$message}}</div>@enderror
          </div>
          <div class="form-group">
            <label class="font-weight-bold">Major</label>
            <select name="major_id" class="form-control">
              <option value="">--Choose a Major--</option>
              @foreach ($major_list as $data)
                  <option value="{{$data->id}}" {{ $data->id == $student->major->id ? 'selected' : '' }}>{{$data->major_code.' - '.$data->major_name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="font-weight-bold">Course</label>
            <select name="course_id" class="form-control">
              <option value="">--Choose a Course--</option>
              @foreach ($course_list as $data)
                  <option value="{{$data->id}}" {{ $data->id == $student->course->id ? 'selected' : '' }}>{{$data->no_course.' - '.$data->course_name}}</option>
              @endforeach
            </select>
          </div> 

          {{-- upload Image--}}
           <div class="form-group">
            <label class="font-weight-bold">Upload Gambar</label>
            <input type="file" name="images" class="form-control @error('images') is-invalid @enderror" value="">
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
