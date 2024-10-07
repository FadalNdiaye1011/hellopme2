<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="abonnements-table">
            <thead>
            <tr>
                <th>Type</th>
                <th>Durée (En Mois)</th>
                <th>Statut</th>
                <th>Prix</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($abonnements as $abonnement)
                <tr>
                    <td>{{ $abonnement->type }}</td>
                    <td>{{ $abonnement->durations }}</td>
                    <td>{{ $abonnement->statut }}</td>
                    <td>{{ $abonnement->price }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['abonnements.destroy', $abonnement->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('abonnements.show', [$abonnement->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('abonnements.edit', [$abonnement->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $abonnements])
        </div>
    </div>
</div>
