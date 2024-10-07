<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="addresses-table">
            <thead>
            <tr>
                <th>Pays Id</th>
                <th>Ville</th>
                <th>Local Address</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($addresses as $address)
                <tr>
                    <td>{{ $address->pays_id }}</td>
                    <td>{{ $address->ville }}</td>
                    <td>{{ $address->local_address }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['addresses.destroy', $address->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('addresses.show', [$address->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('addresses.edit', [$address->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $addresses])
        </div>
    </div>
</div>
