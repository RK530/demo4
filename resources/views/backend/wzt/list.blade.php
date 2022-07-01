<div class="card-body">


            <div id="example1_wrapper" class="dataTable_wrapper dt boostrap4">
    <table id="example1" class="table table-bordered table-striped" id=userListing>
        <thead>
            <tr>
                <th  class="col-sm-1">Number</th>
                <th class="col-sm-1"> Image</th>
                <th class="col-sm-2"> English</th>
                <th class="col-sm-2"> 中文</th>
                <th class="col-sm-2"> Malay</th>
                <th class="col-sm-2"> Thailand</th>
                <th class="col-1">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dreams as $dream)
            <tr>
                <td>{{ $dream->number}}</td>
                <td><img src="../public/images/{{ ($dream->image) }}" height="45px" width="50px"></td>
                <td>{{ $dream->en }}</td>
                <td >{{ $dream->cn }}</td>
                <td >{{ $dream->my }}</td>
                <td>{{ $dream->th }}</td>
                <td style="float:right;border:none">
                        <a class="btn-sm btn-primary" href="{{ route('wzt.edit',$dream->id) }}">Edit</a>


                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {!! $dreams->withQueryString()->links('pagination::bootstrap-4') !!}

        </div>

</div>


