<ul class="ml-10">
<li class="text-lg font-bold mb-4"> <a href="{{route('tweets.index')}}">Home</a> </li>
    <li class="text-lg font-bold mb-4"><a href="{{route('explore.index')}}"> Explore</li> </a>
    <li class="text-lg font-bold mb-4">Notification</li>
    <li class="text-lg font-bold mb-4">Messages</li>
    <li class="text-lg font-bold mb-4">  <a href="{{route('profile.show',auth()->user())}}"> Profile</a>  </li>
</ul>
<button class="bg-blue-500 rounded-full text-white p-3">make a tweet</button>