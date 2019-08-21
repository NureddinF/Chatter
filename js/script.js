	//performs the form request in the background to prevent the form to refresh the page, Got this with help from ajax tutorial: https://www.youtube.com/watch?v=GrycH6F-ksY

	$('form.textareaForm').on('submit', function(){
		//save the form object
		//retirieves the action type and method, and array for data
			var form = $(this),
				url = form.attr('action'),
				method = form.attr('method'),
				data={};
				//goes through the form and save the elements that have a name type
				form.find('[name]').each(function(index,value){
					//saves the object 
					var text = $(this),
						//gets the name attribute
						name = text.attr('name');
						//gets the value stored in name
						value = text.val();
						//saves it to the data array
						data[name] = value;
				});
				//ajax call to send the data to post.php behind the scenes
			$.ajax({
				//send the data needed, url, method, and data
				url: url,
				type: method,
				data: data,
				success: function(response){

					console.log(data);
				}
			});
			//clears the text area
			$('#textarea').val('');
			//calls load doc, since this function works as the onsubmit for the form
			setInterval(loadDoc,15);
			//return false ensures the page does not refresh after submit button clickes
			return false;
		});
			//ajax to load the page with new post
		function loadDoc(){
			//XMlHttprequest object
			var xhttp = new XMLHttpRequest();
			//opens connection to mainspost page with sends back the data needed to display
			xhttp.open("POST","mainPosts.php",true);
			xhttp.send();
			//checks the state to request
			xhttp.onreadystatechange = function (){

			if(this.readyState == 4 && this.status == 200){
				//displays the posts in the div with id content
				document.getElementById("content").innerHTML = this.responseText;

			}
			};
		}
		//calls the function, for first load of site
		loadDoc();
