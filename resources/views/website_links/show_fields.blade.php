<!-- Created At Field -->
<div class="col-sm-12 mb-4">
    {!! Form::label('created_at', 'Created At:', ['class' => 'block font-medium text-gray-700']) !!}
    <p class="mt-1 text-gray-600">{{ $websiteLink->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12 mb-4">
    {!! Form::label('updated_at', 'Updated At:', ['class' => 'block font-medium text-gray-700']) !!}
    <p class="mt-1 text-gray-600">{{ $websiteLink->updated_at }}</p>
</div>
