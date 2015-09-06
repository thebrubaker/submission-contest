@if (Session::has('milestones.newly_created'))
	@foreach(Session::get('milestones.newly_created') as $milestone)
		<div class="card milestone new-milestone">
			<div class="status">
				<a href="{{url('profile/' . $milestone->user->id)}}" class="update">
					@if($milestone->type == 'days')
					<span class="bold">{{$milestone->user->name}}</span> hasn't smoked for <span class="bold">{{$milestone->getDays()}} days.</span>
					@elseif($milestone->type == 'money')
					<span class="bold">{{$milestone->user->name}}</span> has saved <span class="bold">${{$milestone->getMoney()}}</span>
					@elseif($milestone->type == 'minutes')
					<span class="bold">{{$milestone->user->name}}</span> saved over <span class="bold">{{$milestone->getMinutes()}} minutes</span> not smoking.
					@elseif($milestone->type == 'cigarettes')
					<span class="bold">{{$milestone->user->name}}</span> didn't smoke <span class="bold">{{$milestone->getCigarettes()}} cigarettes.</span>
					@endif
				</a>
				<a href="{{url('profile/' . $milestone->user->id)}}" class="timestamp">{{$milestone->time()}}</a>
			</div>
			<div class="actions">
				<a href="javascript:void(0);" class="gif-icon"><i class="material-icons">gif</i></a>
				<a href="javascript:void(0);" class="smile-icon"><i class="material-icons">insert_emoticon</i></a>
			</div>
		</div>
	@endforeach
@endif

@if ($milestones)
	@foreach($milestones as $milestone)
	<div class="milestone-container" id="milestone-{{$milestone->id}}">
		<div class="card milestone">
			<div class="status">
				<a href="{{url('profile/' . $milestone->user->id)}}" class="update">
					@if($milestone->type == 'days')
					<span class="bold">{{$milestone->user->name}}</span> has gone <span class="bold">{{$milestone->getDays()}} days</span> without smoking a cigarette.
					@elseif($milestone->type == 'money')
					<span class="bold">{{$milestone->user->name}}</span> was able to save <span class="bold">${{$milestone->getMoney()}}</span>.
					@elseif($milestone->type == 'minutes')
					<span class="bold">{{$milestone->user->name}}</span> spent <span class="bold">{{$milestone->getMinutes()}} minutes</span> doing something more productive.
					@elseif($milestone->type == 'cigarettes')
					<span class="bold">{{$milestone->user->name}}</span> didn't inhale the smoke of <span class="bold">{{$milestone->getCigarettes()}} cigarettes.</span>
					@endif
				</a>
				<a href="{{url('profile/' . $milestone->user->id)}}" class="timestamp">{{$milestone->time()}}</a>
			</div>
			<div class="actions">
				<a href="javascript:void(0);" class="gif-icon"><i class="material-icons">gif</i></a>
				<a href="javascript:void(0);" class="smile-icon"><i class="material-icons">insert_emoticon</i></a>
			</div>
		</div>
		<div class="gifs">
			<div class="overflow">
				<div class="gif">
					<a href="javascript:void(0);">
						<img src="{{url('/images/gifs/giphy-2.gif')}}" alt="Good Job">
					</a>
				</div>
				<div class="gif">
					<a href="javascript:void(0);">
						<img src="{{url('/images/gifs/giphy-3.gif')}}" alt="Good Job">
					</a>
				</div>
				<div class="gif">
					<a href="javascript:void(0);">
						<img src="{{url('/images/gifs/giphy-4.gif')}}" alt="Good Job">
					</a>
				</div>
				<div class="gif">
					<a href="javascript:void(0);">
						<img src="{{url('/images/gifs/giphy-5.gif')}}" alt="Good Job">
					</a>
				</div>
				<div class="gif">
					<a href="javascript:void(0);">
						<img src="{{url('/images/gifs/giphy-6.gif')}}" alt="Good Job">
					</a>
				</div>
			</div>
		</div>
	</div>
	@endforeach
@endif