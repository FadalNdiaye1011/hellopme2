<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="tokens-table">
            <thead>
            <tr>
                <th>Tokenable Type</th>
                <th>Token</th>
                <th>Refresh Token</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tokens as $token)
                <tr>
                    <td>{{ $token->tokenable_type }}</td>
                    <td>{{ $token->token }}</td>
                    <td>{{ $token->refresh_token }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['tokens.destroy', $token->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('tokens.show', [$token->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('tokens.edit', [$token->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $tokens])
        </div>
    </div>
</div>
