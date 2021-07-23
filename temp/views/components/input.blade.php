@props(['required' => true,'name','type'=>'text','default'=>"",])
    <label class="block mb-2 text-sm font-bold text-gray-700" :for="$name">
        {{ucwords(Str::replace("_"," ",$name)) }}
    </label>
    {{-- {{dd($errors->has($name))}} --}}
    <input
        type="{{$type}}"
        name="{{$name}}"
        id="{{$name}}"
        @empty($default)
         placeholder="{{ucwords(Str::replace("_"," ",$name)) }}"
        @endempty
        @if($required)
             required
        @endif
        value="{{old($name,$default)}}"
    class="w-full px-3 py-2 text-sm @error($name) border-red-500 @enderror   leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
    />

    @error($name)
        <p class="text-red-500"> 
             {{$message}}
        </p>
    @enderror