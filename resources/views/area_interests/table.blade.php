<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="area-interests-table">
            <thead>
            <tr>
                <th>Libelle</th>
                <th>Type</th>
                <th>Opportunity Id</th>
                <th>Pays Partner Id</th>
                <th>Secteur Activite Id</th>
                <th>Expertise Domain Id</th>
                <th>User Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($areaInterests as $areaInterest)
                <tr>
                    <td>{{ $areaInterest->libelle }}</td>
                    <td>{{ $areaInterest->type }}</td>
                    <td>{{ $areaInterest->opportunity_id }}</td>
                    <td>{{ $areaInterest->pays_partner_id }}</td>
                    <td>{{ $areaInterest->secteur_activite_id }}</td>
                    <td>{{ $areaInterest->expertise_domain_id }}</td>
                    <td>{{ $areaInterest->user_id }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['areaInterests.destroy', $areaInterest->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('areaInterests.show', [$areaInterest->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('areaInterests.edit', [$areaInterest->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $areaInterests])
        </div>
    </div>
</div>
