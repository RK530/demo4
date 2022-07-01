<div class="card-body">


            <div id="example1_wrapper" class="dataTable_wrapper dt boostrap4">
    <table id="example1" class="table table-bordered table-striped" id=userListing>
        <thead>
            <tr>

                <th class="col-sm-1">@sortablelink('drawDate','Draw Date')</th>
                <th class="col-1">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dates as $date)
            <tr>

                <td>{{ $date->drawDate }}</td>
                <td style="float:right;border:none">
                    <form action="{{ route('drawdate.destroy',$date->id) }}" method="POST" style="margin: 0%">


                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-xs btn-danger" id="deleteUser">Delete</button>
                    </form>

                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {!! $dates->withQueryString()->links('pagination::bootstrap-4') !!}

        </div>

</div>


