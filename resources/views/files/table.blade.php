<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="files-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Type</th>
                <th>Source</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr>
                    <td>{{ $file->id }}</td>
                    <td>{{ $file->type }}</td>
                    <td>{{ $file->source }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['files.destroy', $file->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('files.show', [$file->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('files.edit', [$file->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $files])
        </div>
    </div>
</div>
