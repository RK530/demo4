<div class="card-body">
    
        
            <div id="example1_wrapper" class="dataTable_wrapper dt boostrap4">
    <table id="example1" class="table table-bordered table-striped" id=userListing>
        <thead>
            <tr>
                <th  class="col-sm-1">No</th>
                <th class="col-sm-4">Api URL</th>
                <th class="col-sm-3">Toto Site</th>
                <th class="col-sm-1">Status</th>
                <th class="col-1">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($urls as $url)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $url->api_url }}</td>
                <td>
                @foreach ( $url->toto_site as $toto_site )
                <small class="badge badge-primary">{{ $toto_site }}</small>
                @endforeach
                </td>
                <td >{{ $url->status }}</td>
               
                <td style="float:right;border:none">
                    <form action="{{ route('result_api.destroy',$url->id) }}" method="POST" style="margin: 0%">
   
                        <a class="btn-sm btn-info" href="{{ route('result_api.show',$url->id) }}">View</a>
        
                        <a class="btn-sm btn-primary" href="{{ route('result_api.edit',$url->id) }}">Edit</a>
       
                        @csrf
                        @method('DELETE')
          
                        <button type="submit" class="btn-xs btn-danger" id="deleteUser">Delete</button>
                    </form>
                  
                </td>
            </tr>
                
            @endforeach
        </tbody>
    </table>
    {!! $urls->withQueryString()->links('pagination::bootstrap-4') !!}
            
        </div>
    
</div>


  