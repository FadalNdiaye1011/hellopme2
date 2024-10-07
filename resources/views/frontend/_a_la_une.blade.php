<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
     @foreach ($events as $key => $event)
         <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
             <img src="{{ $event->image_url }}" alt="{{$event->titre}}">
             <div class="carousel-caption d-md-block">
                 <div class="bottom-align">
                     <h2>Evénements à la une</h2>
                     <p>{{ Str::limit($event->titre, 50) }}</p>
                 </div>
             </div>
         </div>
     @endforeach

     </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
     </a>
     <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
     </a>
</div>
