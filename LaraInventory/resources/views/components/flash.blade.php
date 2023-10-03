@if (session()->has('success'))
    <div x-data="{show: true}"
         x-init="setTimeout(() => show = false,4000)"
         x-show="show"
         class="fixed bg-primary w-200px h-30px rounded-2 border-bottom-3 border-right-3 py-2 px-4">
        <p>{{session('success')}}</p>
    </div>
@endif
