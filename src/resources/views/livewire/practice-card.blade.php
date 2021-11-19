<div class="flex flex-col p-6 hover:scale-105 hover:cursor-pointer transition duration-300 bg-gray-100 rounded-xl shadow animate-fade-in-down">
    <h2 class="my-2 font-bold text-xl"> {{ $practice->domain->name }}</h2>
    <p class="my-2 flex-grow"> {{ Str::of($practice->description)->words(35) }} </p>
    <button wire:click="delete" class="px-4 py-2 w-full bg-red-500 uppercase font-bold text-sm text-white rounded">Supprimer</button>
</div>