$(document).ready(function(){
  //If user wants to end session
      $("#exit").click(function(){
        var exit = confirm("Are you sure you want to end the session?");
        if(exit==true){window.location = 'newchat.php?logout=true';}
      });
});

    //If user submits the form can either hit 'enter' or click 'send' to submit the message

        $('#usermsg').keyup(function(e) {
      if (e.keyCode == 13) {
        $('#submitmsg').click();
        }
      });

    $("#submitmsg").click(function(){
      var clientmsg = $("#usermsg").val();
      $.ajax({
        method: 'POST',
        url: 'post.php',
        data: {
          text: clientmsg
        },
        success: function(data) {
          console.log(data);
          $('#usermsg').val('');
        }
      });
      // return false;
});

        //Load the file containing the chat log
        	function loadLog(){

        		$.ajax({
        			url: "log.html",
        			cache: false,
        			success: function(html){
        				$("#chatbox").html(html); //Insert chat log into the #chatbox div
        		  	},
        		});
        	}

      //Load the file containing the chat log
      	function loadLog(){
      		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
      		$.ajax({
      			url: "log.html",
      			cache: false,
      			success: function(html){
      				$("#chatbox").html(html); //Insert chat log into the #chatbox div

      				//Auto-scroll
      				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
      				if(newscrollHeight > oldscrollHeight){
      					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
      				}
      		  	},
      		});
      	}

        //Reload file every 2500 ms or x ms if you wish to change
        setInterval (loadLog, 1500);
