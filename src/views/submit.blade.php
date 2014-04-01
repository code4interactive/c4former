<button type="submit" class="btn {{$el->class}}" <?php echo $el->confirm?'data-confirm="'.$el->confirm.'"':''; ?>   >
	{{$el->icon()}}
	{{$el->label}}
</button>
