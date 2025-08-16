 @if (Auth::check())
     <div class="font-semibold" style="font-size: 20px;">
       <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit" class="text-white bg-blue-700 hover:bg-gray-800 focus:ring-4 mt-5 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Log out</button>
       </form>
     </div>
     @endif