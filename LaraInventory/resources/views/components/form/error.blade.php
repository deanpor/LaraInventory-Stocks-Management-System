{{--Component to detect error and show out error message--}}
@props(['name'])

@error($name)
<p class="text-danger text-xs mt-2">{{$message}}</p>
@enderror


