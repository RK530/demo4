<div class="card-body">
    
        
            <div id="example1_wrapper" class="dataTable_wrapper dt boostrap4">
    <table id="example1" class="table table-bordered table-striped" id=userListing>
        <thead>
            <tr>
                <th  class="col-sm-1">No</th>
                <th class="col-sm-1">User Name</th>
                <th class="col-sm-1">User image</th>
                <th class="col-1">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td><img src="../public/images/{{ ($user->image) }}" height="45px" width="50px"></td>      
                <td style="float:right;border:none">
                    <form action="{{ route('user.destroy',$user->id) }}" method="POST" style="margin: 0%">
   
                        <a class="btn-sm btn-info" href="{{ route('user.show',$user->id) }}">View</a>
        
                        <a class="btn-sm btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a>
       
                        @csrf
                        @method('DELETE')
          
                        <button type="submit" class="btn-xs btn-danger" id="deleteUser">Delete</button>
                    </form>
                  
                </td>
            </tr>
                
            @endforeach
        </tbody>
    </table>
    {!! $users->appends($_GET)->links('pagination::bootstrap-4') !!}
            
        </div>
    
</div>


  