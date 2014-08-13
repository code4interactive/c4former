<button type="submit" class="btn {{$el->class}}" <?php echo $el->confirm?'data-confirm="'.$el->confirm.'"':''; ?> <?php echo $el->onclick?'onclick="'.$el->onclick.'"':''; ?>  >
	{{$el->icon()}}
	{{$el->label}}
</button>
