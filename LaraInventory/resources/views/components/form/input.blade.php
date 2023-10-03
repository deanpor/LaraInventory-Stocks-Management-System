{{--Input field for allowing the user to key in data--}}

@props(['name'])
<x-form.field>

    <x-form.label name="{{$name}}"/>

    <input class="form-control bg-transparent border border-gray-200 p-2 w-full rounded"
           id="{{$name}}"
           name="{{$name}}"
           {{$attributes(['value'=>old($name)])}} >

    <x-form.error name="{{$name}}"/>

</x-form.field>
