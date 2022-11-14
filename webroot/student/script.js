//Getting value from "ajax.php".
function fill(Value) {
   //Assigning value to "search" div in "student_four_year_plan.php" file.
   $('.search').val(Value);
   //Hiding "display" div in "student_four_year_plan.php" file.
   $('.display').hide();
}
//grabs value from "ajax.php" and passes it to a php file to create a session variable for later reference
function findvariable(Value) {
		   $.ajax({ 
			url:'save_session_variable.php', 
			data:{current: Value}, 
			type:'POST', 
			dataType:'JSON', 
			success:function(response){ 
			console.log(response); 
			} 
		}); 
}
$(document).ready(function() {
   //On pressing a key on "Search box" in "student_four_year_plan.php" file. This function will be called.
   $(".search").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var name = $('.search').val();
       //Validating, if "name" is empty.
       if (name == "") {
           //Assigning empty value to "display" div in "student_four_year_plan.php" file.
           $(".display").html("");
       }
       //If name is not empty.
       else {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: "ajax.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "search" variable.
                   search: name
               },
               //If result found, this funtion will be called.
               success: function(html) {
                   //Assigning result to "display" div in "student_four_year_plan.php" file.
                   $(".display").html(html).show();
               }
           });
       }
   });
});
function resetclass(Value) {
		   $.ajax({ 
			url:'clear_class_selection.php', 
			data:{clearme: Value}, 
			type:'POST', 
			dataType:'JSON', 
			success:function(response){ 
			console.log(response); 
			} 
		}); 
}