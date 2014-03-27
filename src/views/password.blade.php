<section class="{{$el->section}}">
    <label class="label">{{$el->label}}</label>
    <label class="input {{$el->disabled?'state-disabled':''}}">
    	{{$el->icon()}}
        <input id="{{$el->id}}" type="password" name="{{$el->name}}" placeholder="{{$el->placeholder}}" value="{{$value}}" {{$el->disabled()}} {{$el->mask()}} >
		{{$el->tooltip()}}
    </label>
    @if ($el->description)
    	<div class="note">{{$el->description}}</div>
    @endif
</section>
