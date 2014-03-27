<section class="{{$el->section}}">
    <label class="label">{{$el->label}}</label>
    <label class="input {{$el->disabled?'state-disabled':''}}">
    	{{$el->icon()}}
<<<<<<< HEAD
        <input id="{{$el->id}}" name="{{$el->name}}" type="password" placeholder="{{$el->placeholder}}" value="{{$value}}" {{$el->disabled()}} {{$el->mask()}} >
=======
        <input id="{{$el->id}}" type="password" name="{{$el->name}}" placeholder="{{$el->placeholder}}" value="{{$value}}" {{$el->disabled()}} {{$el->mask()}} >
>>>>>>> 89f6b35d1acf1b048ac7f04f4d5224703d372f6d
		{{$el->tooltip()}}
    </label>
    @if ($el->description)
    	<div class="note">{{$el->description}}</div>
    @endif
</section>
