<x-app-layout>
    <style type="text/css">
        #create_timetable_form{
            display: none;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timetable List') }}
        </h2>
    </x-slot>

    <table class="shadow-lg bg-white">
      <tr>
        <th class="bg-blue-100 border text-left px-8 py-4">number_of_working_day</th>
        <th class="bg-blue-100 border text-left px-8 py-4">number_of_sub_per_day</th>
        <th class="bg-blue-100 border text-left px-8 py-4">total_subject</th>
        <th class="bg-blue-100 border text-left px-8 py-4">total_hours_for_week</th>
        <th class="bg-blue-100 border text-left px-8 py-4">view</th>
      </tr>

      @foreach($tables as $table)
	      <tr>
	        <td class="border px-8 py-4">{{ $table->number_of_working_day }}</td>
	        <td class="border px-8 py-4">{{ $table->number_of_sub_per_day }}</td>
	        <td class="border px-8 py-4">{{ $table->total_subject }}</td>
	        <td class="border px-8 py-4">{{ $table->total_hours_for_week }}</td>
	        <td class="border px-8 py-4">{!! $table->html !!}</td>
	        
	        
	      </tr>
      @endforeach
    </table>

</x-app-layout>