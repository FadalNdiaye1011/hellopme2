<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="opportunity-secteur-children-table">
            <thead>
            <tr>
                <th>Opportunity Id</th>
                <th>Secteur Activite Chilren Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($opportunitySecteurChildrens as $opportunitySecteurChildren)
                <tr>
                    <td>{{ $opportunitySecteurChildren->opportunity_id }}</td>
                    <td>{{ $opportunitySecteurChildren->secteur_activite_chilren_id }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['opportunitySecteurChildrens.destroy', $opportunitySecteurChildren->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('opportunitySecteurChildrens.show', [$opportunitySecteurChildren->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('opportunitySecteurChildrens.edit', [$opportunitySecteurChildren->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $opportunitySecteurChildrens])
        </div>
    </div>
</div>
