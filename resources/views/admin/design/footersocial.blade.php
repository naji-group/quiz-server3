@extends('admin.layouts.layout')
@section('page-title')
{{ __('general.settings',[],'en') }}
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
              <li class="breadcrumb-item active">{{ __('general.settings',[],'en') }}</li>
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
          <h3 class="card-title">Social</h3>

          <div class="card-tools">
        
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
             
          </div>
        </div>
        <div class="card-body">
                           <!-- parent_id start -->
                           <div class="col-lg-12  form-separate ">
                            <form class="form-horizontal" name="add_social_form" method="POST" action="{{url('admin/design/addfootsocial')}}" 
                                enctype="multipart/form-data" id="add_social_form">
                                @csrf
                                <div class="form-group row">
                                  <label for="parent_id" class="col-sm-2 col-form-label"   >Select Social</label>                             
                                        <div class="col-sm-10">
                                        <select class="form-control"  name="setting_id" id="setting_id">
                                        <option value="0"  >Choose</option>
                                        @if(!empty($combo_list))
                                        @foreach ($combo_list as $social)
                                        <option value="{{$social->id }}"  >{{ $social->value1 }}</option>
                                        @endforeach
                                        @endif
                                        </select>
                                      
                                        <span id="parent_id-error" class="error invalid-feedback"></span>
                                       
                                      </div>
                                       
                                    </div>
                                <div class="form-group row">
                                    <div class="col-sm-2 col-form-label"></div>
                                    <div class="col-sm-10">
                                        <button type="submit" type="submit" name="btn_add_social" id="btn_add_social"
                                            class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>
    
                        </div>


                       

        <table id="example1" class="table table-bordered table-striped table-hover">
      
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Link</th>
                  <th>Status</th>
                   
                
                  <th></th>                   
                </tr>
                </thead>
                <tbody>
                @foreach ($List as $item)
                <tr>
                  <td>{{ $item->setting->value1 }}</td>
                  <td>{{ $item->setting->value3 }}</td>
                  <td>{{ $item->setting->status_conv }}</td>               
                  <td>    
                          <form action="{{url('admin/design/delfootsocial',$item->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="del-{{$item->id}}" class="btn btn-danger btn-sm delete"  data-toggle="modal" data-target="#modal-delete"   title="Delete">   <i class="fas fa-trash">
                            </i>Delete</button>
</form>
                           </td>                
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
	 

  <div class="modal fade" id="modal-delete">
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
  </div>
  <!-- /.modal -->
@endsection

@section('js')
 <!-- DataTables -->
<script src="{{ URL::asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ URL::asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/admin/js/custom/delete.js')}}"></script>
<script src="{{URL::asset('assets/admin/js/custom/socialdesign.js')}}"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "responsive": true,     
      "info": true,
      "autoWidth": false,
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
@section('css')
<link href="{{URL::asset('assets/admin/css/custom/content.css')}}" rel="stylesheet">
@endsection
