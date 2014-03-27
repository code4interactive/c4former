<section class="{{$el->section}}">
    <label class="label">{{$el->label}}</label>
    <label class="select {{$el->disabled?'state-disabled':''}}">
    	<select id="{{$el->id}}" name="{{$el->name}}" {{$el->multiple?'multiple':''}} placeholder="{{$el->placeholder}}" {{$el->disabled()}} class="{{$el->select2?'select2':''}}" >
		    @foreach ($collection[0] as $item)
			    {{ $item->render() }}
			@endforeach
    	</select>
    	@if (!$el->select2)
    		<i></i>
    	@endif
    </label>
    @if ($el->description)
    	<div class="note">{{$el->description}}</div>
    @endif
</section>