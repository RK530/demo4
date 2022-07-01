<div class="card-body">
    
        
            <div id="example1_wrapper" class="dataTable_wrapper dt boostrap4">
    <table id="example1" class="table table-bordered table-striped" id=userListing>
        <thead>
            <tr>
                <th  class="col-sm-1">No</th>
                <th class="col-sm-1">Toto Site Name</th>
                <th class="col-sm-2">Flag</th>
                <th class="col-sm-1">Country</th>
                <th class="col-sm-1">Status</th>
                <th class="col-sm-1">Icon or Site Image</th>
                <th class="col-sm-1">color</th>
                <th class="col-1">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sites as $site)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $site->siteName }}</td>
                <td>{{ $site->flag }}</td>
                <td >{{ $site->country }}</td>
                <td >{{ $site->status }}</td>
                <td><img src="../public/images/{{ ($site->siteImage) }}" height="45px" width="50px"></td>
                <td>{{ $site->color }}</td>
                <td style="float:right;border:none">
                    <form action="{{ route('totoSite.destroy',$site->id) }}" method="POST" style="margin: 0%">
   
                        <a class="btn-sm btn-info" href="{{ route('totoSite.show',$site->id) }}">View</a>
        
                        <a class="btn-sm btn-primary" href="{{ route('totoSite.edit',$site->id) }}">Edit</a>
       
                        @csrf
                        @method('DELETE')
          
                        <button type="submit" class="btn-xs btn-danger" id="deleteUser">Delete</button>
                    </form>
                  
                </td>
            </tr>
                
            @endforeach
        </tbody>
    </table>
    {!! $sites->withQueryString()->links('pagination::bootstrap-4') !!}
            
        </div>
    
</div>


  