

  <table id="example1" class="table table-bordered table-striped table-hover">

          <thead>
          <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Category</th>
            <th>Status</th>
            <th></th>                   
          </tr>
          </thead>
          <tbody>
          @foreach ($posts as $post)
      
          <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->category->title }}</td>
            <td>@if($post->status==1)Published @else Draft @endif</td>
            <td>    <a class="btn btn-info btn-sm" href="{{url('/cpanel/post/edit',[$post->id]) }}">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit
                    </a>
                    <a class="btn btn-danger btn-sm"  href="{{url('/cpanel/post/delete',[$post->id]) }}">
                        <i class="fas fa-trash">
                        </i>
                        Delete
                    </a>  </td>                
          </tr>
@endforeach
     
          </tbody>            
        </table>

  {!! $posts->links() !!}
             
                <script>
                    $(function () {

                   });
                  </script>
              