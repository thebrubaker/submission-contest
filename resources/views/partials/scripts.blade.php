<script src="{{url('scripts/jquery.js')}}"></script>
<script src="{{url('scripts/bootstrap.js')}}"></script>

<script>
	$(document).ready(function() {
		$('.gif-icon').click(function() {
			$(this).toggleClass("selected");
			var milestone = $(this).parents(".milestone-container");
			milestone.find(".gifs").slideToggle();
		})
		$('.smile-icon').click(function() {
			$(this).toggleClass("selected");
		})
	});
</script>