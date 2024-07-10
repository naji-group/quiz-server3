@extends('admin.layouts.layout')
@section('page-title')
{{ __('general.sections',[],'en') }}
@endsection
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
           
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">{{ __('general.sections',[],'en') }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ __('general.sections',[],'en') }}</h3>

          <div class="card-tools">
        {{--   <a class="btn btn-info btn-sm" href="{{ route('project.create')}}">
                              <i class="fas fa-plus">
                              </i>
                             New
                          </a> --}}
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
             
          </div>
        </div>
        <div class="card-body">
        <table id="example1" class="table table-bordered table-striped table-hover">
      
                <thead>
                <tr>
                  <th>Name</th>
                  {{-- <th>Slug</th> --}}
                  <th>Status</th>
                   
                
                  <th>Action</th> 
                    <th>Sub-menu</th>                   
                </tr>
                </thead>
                <tbody>
                @foreach ($List as $item)
                <tr>
                  <td>{{ $item->category->title }}</td>
                  {{-- <td>{{ $item->slug }}</td> --}}
                  <td>{{ $item->category->status_conv }}</td>                   
                  <td>    <a class="btn btn-info btn-sm" href="{{url('admin/design/editmenu', $item->category->id)}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>

                          {{-- <form action="{{route('project.destroy', $item->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="del-{{$item->id}}" class="btn btn-danger btn-sm delete"  data-toggle="modal" data-target="#modal-delete"   title="Delete">   <i class="fas fa-trash">
                            </i>Delete</button>
</form> --}}
                           </td>  
                           <td>@if($item->category->sons->first())
                            <a class="btn btn-info btn-sm" href="{{url('admin/design/categorysub', $item->category->id)}}">
                              <i class="fas fa-pencil-alt">
                              </i>                        
                          Sub menu                          
                          </a>
                            @endif
                            
                            @if($item->category->code=='projects'||$item->category->code=='references'||$item->category->code=='services'||$item->category->code=='products')
                            <a class="btn btn-info btn-sm" href="{{url('admin/post/showbycatid', $item->category->id)}}">
                              <i class="fas fa-pencil-alt">
                              </i>                              
                                Show                           
                          </a>
                          @elseif ($item->category->code=='contacts')
                          <a class="btn btn-info btn-sm" href="{{url('admin/post/showbycatid', $item->category->id)}}">
                            <i class="fas fa-pencil-alt">
                            </i>                              
                            Form Translate                             
                        </a>
                            @endif</td>              
                </tr>
@endforeach
           
                </tbody>            
              </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
       
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
	 

  {{-- <div class="modal fade" id="modal-delete">
    <div class="modal-dialog  modal-sm">
      <div class="modal-content">
        <div class="modal-body text-center" style="padding-bottom: 5px;	padding-top: 30px;">
          <h4 class="modal-title">{{ __('general.Are you sure',[],'en') }}</h4>
             </div>
        <div class="modal-footer justify-content-between" style="border-top: 0px solid  ">
          <button class="btn ripple btn-secondary"  id="btn-cancel-modal"  data-dismiss="modal" type="button">{{ __('general.cancel',[],'en') }}</button>
      
          <button class="btn ripple btn-danger " id="btn-modal-del" type="button">{{ __('general.delete',[],'en') }}</button>
           </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div> --}}
  <!-- /.modal -->
@endsection

@section('js')
 <!-- DataTables -->
<script src="{{ URL::asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ URL::asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
{{-- <script src="{{URL::asset('assets/admin/js/custom/delete.js')}}"></script> --}}
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "responsive": true,     
      "info": true,
      "autoWidth": false,
      "ordering": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,    
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection
