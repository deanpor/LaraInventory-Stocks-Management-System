@props(['name'])

<x-form.field>

    <x-form.label name="{{$name}}"/>

    <textarea class="form-control bg-transparent border border-gray-200 p-2 w-full rounded"
              name="{{$name}}"
              id="{{$name}}"
              {{$attributes(['value'=>old($name)])}}
    ></textarea>

    <x-form.error name="{{$name}}"/>


</x-form.field>

