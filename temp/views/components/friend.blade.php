@props(['friends'])
<div class="bg-gray-100 rounded">
    
    <div class="my-4 p-4 text-xl font-bold bg-blue-100"> Friends</div>
    
    <ul class="px-4">
        @forelse ($friends as $friend)
        <li v-for>
            <a href="{{$friend->path()}}" class="flex items-center mt-4">
                <img src="{{$friend->avatar()}}" alt="" class="w-12 mr-6 h-12 rounded-full">
                <p class="text-sm">{{$friend->name}}</p>
            </a>
        </li>

        @empty
            NO Friends yet
        @endforelse

        
    </ul>
</div>