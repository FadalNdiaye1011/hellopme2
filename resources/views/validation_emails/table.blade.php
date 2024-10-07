<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="validation-emails-table">
            <thead>
            <tr>
                <th>Code</th>
                <th>Email</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($validationEmails as $validationEmail)
                <tr>
                    <td>{{ $validationEmail->code }}</td>
                    <td>{{ $validationEmail->email }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['validationEmails.destroy', $validationEmail->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('validationEmails.show', [$validationEmail->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('validationEmails.edit', [$validationEmail->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $validationEmails])
        </div>
    </div>
</div>
