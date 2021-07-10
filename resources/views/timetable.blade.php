<x-app-layout>
    <style type="text/css">
        #create_timetable_form{
            display: none;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timetable ') }}
        </h2>
    </x-slot>


    <div class="md:flex md:justify-center mb-12 timetable_">
        
        <div class="row w-full max-w-lg ">
            <form method="post" action="{{ route('submitpartone') }}" id="submit_first_Step" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
                 @csrf

                 <div class="md:flex md:items-center mb-6">
                     <div class="md:w-1/3">
                       <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                         Working Day
                       </label>
                     </div>
                     <div class="md:w-2/3">
                       <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="number_of_working_day" type="text" name="number_of_working_day"><br>
                        (only +ve number between 1 to 7)
                     </div>
                 </div>

                 <div class="md:flex md:items-center mb-6">
                     <div class="md:w-1/3">
                       <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="number_of_sub_per_day">
                          Subject Per Day
                       </label>
                     </div>
                     <div class="md:w-2/3">
                       <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="number_of_sub_per_day" type="text" name="number_of_sub_per_day">
                        (+ve number less than 9)
                     </div>
                 </div>


                 <div class="md:flex md:items-center mb-6">
                     <div class="md:w-1/3">
                       <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="total_subject">
                        Total Subject
                       </label>
                     </div>
                     <div class="md:w-2/3">
                       <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="total_subject" type="text" name="total_subject">
                        (+ve number)
                     </div>
                 </div>


               
                Total hours for week : <span id="total_hours_for_week_span"></span>

                <input type="hidden" name="total_hours_for_week" id="total_hours_for_week">
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" id="submit_first_Step">
                    submit the data
                    </button>
                </div>           

            </form>

             <form method="post" action="{{ route('createtitmetable') }}" id="create_timetable_form" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
             </form>
        </div>

        <div class="text-center mx-4 space-y-2 timetable">
            
        </div>
    </div>   
    
        <script type="text/javascript">
             var ENDPOINT = "{{ url('/') }}";

             var number_of_working_day;
             var number_of_sub_per_day;
             var total_subject;
             var total_hours_for_week;
             var error = 1;
            function total_workinghour(){
                //var error ="";
                var number_of_working_day =  $( "#number_of_working_day").val();
                var number_of_sub_per_day =  $( "#number_of_sub_per_day").val();
                var total_subject =  $( "#total_subject").val();

                //Equation: Total hours for week = No of Working days * No of Subjects per day

                if(!number_of_working_day || !number_of_sub_per_day || !total_subject){
                    //alert("error")
                    error = 1
                }else{
                     error = 0
                    total_hours_for_week = number_of_working_day * number_of_sub_per_day;
                    //alert(total_hours_for_week);
                    $("#total_hours_for_week_span").html(total_hours_for_week);
                    $("#total_hours_for_week").val(total_hours_for_week);

                }

                $("#create_timetable_form").hide();
            } 

            $(document).on("keyup", "#number_of_working_day", function(){
                
                var number_of_working_day = $(this).val();
                if(number_of_working_day >7){
                    $(this).val(7)
                }

                if(number_of_working_day < 0){
                    $(this).val(1)
                }

                total_workinghour()

            })

            $(document).on("keyup", "#number_of_sub_per_day", function(){                
                var number_of_sub_per_day = $(this).val();
                if(number_of_sub_per_day >8){
                    $(this).val(8)
                }
                if(number_of_sub_per_day < 0){
                    $(this).val(1)
                }
                total_workinghour()
            })

            $(document).on("keyup", "#total_subject", function(){                
                var total_subject = $(this).val();
                
                if(total_subject < 0){
                    $(this).val(1)
                }

                total_workinghour()
            })

            //$(document).on("click", "#submit_first_Step", function(){  
            $('#submit_first_Step').on('submit', function(e) {
                //alert(error)
                if(error){
                    alert("Enter all field")
                    return false
                }
                e.preventDefault();  
                $.ajax({
                    url: ENDPOINT + "/submitpartone",
                    datatype: "html",
                    data: $(this).serialize(),
                    type: "post",
                    beforeSend: function () {
                       /* $('.auto-load').show();
                        $('.all-time-best-loading').show();
                        $('#all-time-best').hide();*/
                    }
                })
                .done(function (response) {
                    //$("#submit_first_Step").hide();
                    $("#create_timetable_form").show();
                    $("#create_timetable_form").html(response);
                    
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
               
            })

            var total = 0;
            var hour_input_error = 1;
            var total_hour_array = {};
            var subject_name_array = {};
            function get_all_hour(){
                total = 0;
                $('input[name^="subject_hour"]').each(function(key, val){
                    //console.log(key)
                    if($(this).val()){
                        total_hour_array[key] =$(this).val();
                        $(this).removeClass('border-red-500')                       
                        $(this).next().hide() 
                        hour_input_error =0                     
                         
                    }else{
                        total_hour_array[key] =0;        
                        $(this).addClass('border-red-500')                       
                        $(this).next().show()
                        hour_input_error =1
                    }
                });

                //console.log(yourArray);
                $.each(total_hour_array, function(index, item) {
                     total = parseInt(total) + parseInt(item);
                    // do something with `item` (or `this` is also `item` if you like)
                });
                
                console.log(total_hour_array);
                console.log("total" + total);

            }

            //$('input[name^="subject_hour"]').change(function(event) {
            $(document).on("keyup", 'input[name^="subject_hour"]', function(event){ 
                //console.log(event.target);
                //alert($(this).val());
                get_all_hour();

                if( parseInt(total_hours_for_week) < parseInt(total) ){
                    //alert(total_hours_for_week);
                    //alert(total);
                    $(this).val(0)
                    alert("Total hour must be equal to " +total_hours_for_week);
                    return false;
                }else{
                    $("#remain_hour").html(parseInt(total_hours_for_week) - parseInt(total));

                    console.log("hour_input_error" + hour_input_error)
                    console.log("total_hours_for_week" + total_hours_for_week)
                    console.log("total" + total)

                    if(hour_input_error == 0 && total_hours_for_week == total){
                        //alert("show submit button");
                        $("#create_timetable_button_div").show();
                    }else{
                        $("#create_timetable_button_div").hide();
                    }

                }
            });


            function check_sub_name(){                
                $('input[name^="subject_name"]').each(function(key, val){                   
                    if($(this).val()){
                        subject_name_array[key] =$(this).val();
                        $(this).removeClass('border-red-500')                       
                        $(this).next().hide()                   
                         
                    }else{
                        $(this).addClass('border-red-500')                       
                        $(this).next().show()
                    }
                });
               
            }

            $(document).on("keyup", 'input[name^="subject_name"]', function(event){ 
                //console.log(event.target);
                check_sub_name();               

            });



            $('#create_timetable_form').on('submit', function(e) {
                //alert(error)
                if(hour_input_error){
                    alert("Enter all field")
                    return false
                }
                e.preventDefault();  
                $.ajax({
                    url: ENDPOINT + "/createtitmetable",
                    datatype: "html",
                    data: $(this).serialize(),
                    type: "post",
                    beforeSend: function () {
                       /* $('.auto-load').show();
                        $('.all-time-best-loading').show();
                        $('#all-time-best').hide();*/
                    }
                })
                .done(function (response) {
                    $(".timetable").html(response)
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
               
            })
            
        </script>
   
</x-app-layout>
