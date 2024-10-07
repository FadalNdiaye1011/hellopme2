<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="user-abonnements-table">
            <thead>
            <tr>
                <th>User Id</th>
                <th>Abonnement Id</th>
                <th>End Date</th>
                <th>Price</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userAbonnements as $userAbonnement)
                <tr>
                    <td>{{ $userAbonnement->user_id }}</td>
                    <td>{{ $userAbonnement->abonnement_id }}</td>
                    <td>{{ $userAbonnement->end_date }}</td>
                    <td>{{ $userAbonnement->price }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['user-abonnements.destroy', $userAbonnement->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('user-abonnements.show', [$userAbonnement->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('user-abonnements.edit', [$userAbonnement->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $userAbonnements])
        </div>
    </div>
</div>
