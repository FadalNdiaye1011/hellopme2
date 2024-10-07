<!-- Libelle Field -->
<div class="w-full h-20 relative flex rounded-xl">
    {!! Form::text('libelle', null, ['class' => 'peer w-full bg-transparent outline-none px-4 text-base rounded-xl bg-white border border-[#4070f4] focus:shadow-md', 'required']) !!}
    {!! Form::label('libelle', 'Libelle', ['class' => 'absolute top-1/2 translate-y-[-50%] bg-white left-4 px-2 peer-focus:top-0 peer-focus:left-3 font-light text-base peer-focus:text-sm peer-focus:text-[#4070f4] peer-valid:-top-0 peer-valid:left-3 peer-valid:text-sm peer-valid:text-[#4070f4] duration-150']) !!}
</div>



