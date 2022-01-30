<div>
    <h2 class="font-bold text-2xl">Toutes les activités</h2>
    @foreach ($activities as $activity)
        <div class="my-4">
            <x-dynamic-component component="activity.{{ class_basename($activity) }}" :activity="$activity" />
        </div>
    @endforeach
</div>
