@if (Auth::check())
<div style="font-size: 15px; position: relative; top: 130px;"
     class="text-orange-500 hover:text-white font-bold transition duration-300 pl-1">
    <form action="{{ route('logout') }}" method="post"
          class="flex items-center gap-2 m-1">
        @csrf
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
        </svg>
        <button type="submit" class="ml-1 ">
            Log Out
        </button>
    </form>
</div>
@endif