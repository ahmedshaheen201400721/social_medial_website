
  <x-layout :friends="$friends">    
    <div class="flex-1"> 
       <div class="content w-5/6 mx-auto">
       


            <h3 class="pt-4 text-2xl text-center">Update Your Account!</h3>
       <form class="px-8 pt-6 pb-8 mb-4 bg-white rounded"  action="{{route('profile.update',user())}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="mb-4 md:flex md:justify-between">
                    <div class="mb-4 md:mr-2 md:mb-0">
                        <x-input name="username" default="{{user()->username}}"></x-input>
                    </div>

                    <div class="md:ml-2">
                       
                        <x-input name="name" default="{{user()->name}}" ></x-input>
                       
                    </div>
                </div>


               
                <div class="flex justify-between items-center">
                    <div class="mb-4 w-10/12 ">
                        <x-input name="avatar" type='file' :required="false" ></x-input>
                    </div>
                    <img src="{{user()->avatar()}}" class="inline w-12 h-12 rounded-full" alt="">
                </div>

                <div class="flex justify-between items-center">
                    <div class="mb-4 w-10/12">
                        <x-input name="cover" type='file' :required="false" ></x-input>
                    </div>
                    <img src="{{user()->cover()}}" class="inline w-12 h-12 rounded-full" alt="">
                </div>
               


                <div class="mb-4 md:flex md:justify-between">
                    <div class="mb-4 md:mr-2 md:mb-0">
                        
                        <x-input type='password' name="password" ></x-input>

                    </div>
                    <div class="md:ml-2">
                        <x-input type='password' name="password_confirmation" ></x-input>
                    </div>
                </div>

                <div class="mb-6 text-center">
                    <input
                        class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline"
                        type="submit"
                        value="Update"
                    >
                </div>
                
            </form>
       </div>
    </div>
   </x-layout>
