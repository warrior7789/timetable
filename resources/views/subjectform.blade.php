	
	<input type="hidden" name="number_of_working_day" value="{{ $number_of_working_day}}">
	<input type="hidden" name="number_of_sub_per_day" value="{{ $number_of_sub_per_day}}">
	<input type="hidden" name="total_subjects" value="{{ $total_subjects}}">
	<input type="hidden" name="total_hours_for_week" value="{{ $total_hours_for_week}}">
	 @csrf

	<h3>Submit total hours of each subject for total working days.</h3>
	<h5>The total hours of the subject must be equal to 'Total hours for week'.</h5><br>

	<h5>Total hours for week : {{ $total_hours_for_week }}</h5><br>
	<h3>Remain Hour : <span id="remain_hour"> {{ $total_hours_for_week }}</span></h3>
	@for ($i = 1; $i <= $total_subjects; $i++)

		<div class="flex flex-wrap -mx-3 mb-6">
		    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
		      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="subject_name_{{ $i  }}">
		        Subject name {{ $i  }}
		      </label>
		      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="subject_name_{{ $i  }}" type="text" name="subject_name[]">
		      <p class="text-red-500 text-xs italic">Please fill out this field.</p>
		    </div>
		    <div class="w-full md:w-1/2 px-3">
		      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="subject_hour_{{ $i  }}">
		       Subject Hour  {{ $i  }}
		      </label>
		     
		      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="subject_hour_{{ $i  }}" type="text" name="subject_hour[]">
		      <p class="text-red-500 text-xs italic">Please fill out this field.</p>
		    </div>
		  </div>
		
	@endfor

	The total hours of the subject must be equal to 'Total hours for week'.
	<br>
	

	<div class="flex items-center justify-between create_timetable_submit" style="display:none"id="create_timetable_button_div" >
	    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" id="create_timetable_button">
	    Generate Time table
	    </button>
	</div>
