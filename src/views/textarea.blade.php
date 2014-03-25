<section class="{{$el->section}}">
    <label class="label">{{$el->label}}</label>
    <label class="textarea {{$el->disabled?'state-disabled':''}}">
    	{{$el->icon()}}
        <textarea rows="{{$el->rows}}" id="{{$el->id}}" type="text" placeholder="{{$el->placeholder}}" {{$el->disabled()}} {{$el->mask()}} >{{$value}}</textarea>
		{{$el->tooltip()}}
    </label>
    @if ($el->description)
    	<div class="note">{{$el->description}}</div>
    @endif
</section>