<div class="job-tittle">
    <a href="{{ route('front.project', $project->slug) }}"><h4>{{ $project->title }}</h4></a>
    <ul>
        <li>{{ $project->user->name }}</li>
        @if ($project->user->address)
        <li><i class="fas fa-map-marker-alt"></i>{{ $project->user->address }}</li>
        @endif

        <li>${{ $project->price }}</li>
    </ul>
</div>
