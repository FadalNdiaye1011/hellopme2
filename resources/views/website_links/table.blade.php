<div class="p-0">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300" id="website-links-table">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b text-left text-gray-600">Url</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600">Titre</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600" colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($websiteLinks as $websiteLink)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $websiteLink->url }}</td>
                        <td class="py-2 px-4 border-b">{{ $websiteLink->title_selector }}</td>
                        <td class="py-2 px-4 border-b" style="width: 120px">
                            {!! Form::open(['route' => ['website-links.destroy', $websiteLink->id], 'method' => 'delete']) !!}
                            <div class='flex space-x-2'>
                                <a href="{{ route('website-links.show', [$websiteLink->id]) }}"
                                   class='text-blue-500 hover:text-blue-700'>
                                    <i class="far fa-eye"></i>
                                </a>
                                <a href="{{ route('website-links.edit', [$websiteLink->id]) }}"
                                   class='text-blue-500 hover:text-blue-700'>
                                    <i class="far fa-edit"></i>
                                </a>
                                {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                    'type' => 'submit',
                                    'class' => 'text-red-500 hover:text-red-700',
                                    'onclick' => "return confirm('Are you sure?')"
                                ]) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex justify-end">
        @include('adminlte-templates::common.paginate', ['records' => $websiteLinks])
    </div>
</div>
