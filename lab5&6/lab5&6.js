function hexFromRGB(r, g, b) {
    var hex = [
      r.toString( 16 ),
      g.toString( 16 ),
      b.toString( 16 )
    ];
    $.each( hex, function( nr, val ) {
      if ( val.length === 1 ) {
        hex[ nr ] = "0" + val;
      }
    });
    return hex.join( "" ).toUpperCase();
  }

function refreshSwatch() {
  var red = $( "#red" ).slider( "value" );
  $(" #input1 ").val($("#red").slider( "value" ));
  var green = $( "#green" ).slider( "value" );
  $(" #input2 ").val($("#green").slider( "value" ));
  var blue = $( "#blue" ).slider( "value" );
  $(" #input3 ").val($("#blue").slider( "value" ));
  var hex = hexFromRGB( red, green, blue );
  $( "#guess_swatch" ).css( "background-color", "#" + hex );
}

function swatch_generate(){
  var red=Math.floor(Math.random() * 256);
  var green=Math.floor(Math.random() * 256);
  var blue=Math.floor(Math.random() * 256);
  var hex=hexFromRGB(red, green, blue);
  $("#swatch").css("background-image","none");
  $( "#swatch" ).css( "background-color", "#" + hex );
  var combination=[red, green, blue];
  return combination;
}

function slider_maker() {
  $( "#red, #green, #blue" ).slider({
    orientation: "horizontal",
    range: "min",
    max: 255,
    value: 127,
    slide: refreshSwatch,
    change: refreshSwatch
  });
  $( "#red" ).slider( "value", (20));
  $( "#green" ).slider( "value", (178));
  $( "#blue" ).slider( "value", (60));
  $("#input1").change(function(e) {
    $("#red").slider("value",$(this).val())
  })
  $("#input2").change(function(e) {
    $("#green").slider("value",$(this).val())
  })
  $("#input3").change(function(e) {
    $("#blue").slider("value",$(this).val())
  })
}

function new_game(turns, name){
  $("#set").click(function(){
    turns=$('#turns').val();
    // when the user changes the turns in setting to a invalid value.
    if(turns!=1&turns!=2&turns!=3&turns!=4&turns!=5){
      alert("The number of turns is invalid. Please enter the integer between 1-5");
      turns=5;
      $('#turns').val(turns);
    }
    name=$('#name').val();
    var str="Hi "+name+","+"\nYou have "+turns+ " turn(s)";
    alert(str);
  })

  $("#new").click(function(){
    var correct=swatch_generate();
    $( "#red" ).slider( "value", (20));
    $( "#green" ).slider( "value", (178));
    $( "#blue" ).slider( "value", (60));
    $( "#new" ).replaceWith( "<button id='submit'>Guess</button>" );
    var interval=null;
    $("#setting_block").css("visibility", "hidden");
    timer()
    submit_guess(turns,correct);
  });
}

function submit_guess(turns,correct){
  var count=0;
  var max_scores=-1;
  //when click on the new game, clear the scores for last game.
  document.getElementById("best_scores").innerHTML="";
  document.getElementById("tmp_scores").innerHTML="";
  $("#submit").click(function(){
    count++;
    var red_percentoff = Math.round((Math.abs(correct[0]-$("#input1").val())/255)*100);
    var green_percentoff = Math.round((Math.abs(correct[1]-$("#input2").val())/255)*100);
    var blue_percentoff = Math.round((Math.abs(correct[2]-$("#input3").val())/255)*100);
    var output = "Red: ";
    if (red_percentoff == 0){
      output+="You got it! (0% off)";
    }
    else{
      output+=red_percentoff;
      output+="%";
    }
    output+="\nGreen: ";
    if (green_percentoff == 0){
      output+="You got it! (0% off)";
    }
    else{
      output+=green_percentoff;
      output+="%";
    }
    output+="\nBlue: ";
    if (blue_percentoff == 0){
      output+="You got it! (0% off)";
    }
    else{
      output+=blue_percentoff;
      output+="%";
    }
    document.getElementById("result").innerHTML=output;
    var time=$('.timer').text().split(":");
    var hour=parseInt(time[0]);
    var min=parseInt(time[1]);
    var second=parseInt(time[2]);
    var total_time=(hour*60*60+min*60+second)*1000;
    console.log(total_time);
    if(20000-total_time<0){
      var tmp_scores=(300-(red_percentoff+green_percentoff+blue_percentoff))*0;
      tmp_scores+="!!!!!!!";
    }
    else{
      var tmp_scores=(300-(red_percentoff+green_percentoff+blue_percentoff))*(20000-total_time);
    }
    document.getElementById("tmp_scores").innerHTML="";
    if(tmp_scores>max_scores){
      max_scores=tmp_scores;
      document.getElementById("best_scores").innerHTML="Best Scores: "
      document.getElementById("best_scores").innerHTML+=max_scores;
    }
    else{
      document.getElementById("tmp_scores").innerHTML="Last Approach: "
      document.getElementById("tmp_scores").innerHTML+=tmp_scores;
    }
    

    if(count==turns){
      max_scores=0;
      $("#setting_block").css("visibility", "visible");
      $('.timer').text("00:00:00");
      clearTimeout(interval);
      $( "#submit" ).replaceWith( "<button id='new'>New Game</button>" );
      new_game(turns);
    }
    else if(red_percentoff==correct[0]&green_percentoff==correct[1]&blue_percentoff==correct[2]){
      max_scores=0;
      $("#setting_block").css("visibility", "visible");
      $('.timer').text("00:00:00");
      clearTimeout(interval);
      $( "#submit" ).replaceWith( "<button id='new'>New Game</button>" );

      $("#setting_change").dialog();
      new_game(turns);
    }
  });
}


function pretty_time_string(num) {
  return ( num < 10 ? "0" : "" ) + num;
}

function timer(){
  var start = new Date;
  interval=setInterval(function() {
    var total_seconds = (new Date - start) / 1000;
    var hours = Math.floor(total_seconds / 3600);
    total_seconds = total_seconds % 3600;

    var minutes = Math.floor(total_seconds / 60);
    total_seconds = total_seconds % 60;

    var seconds = Math.floor(total_seconds);

    hours = pretty_time_string(hours);
    minutes = pretty_time_string(minutes);
    seconds = pretty_time_string(seconds);

    var currentTimeString = hours + ":" + minutes + ":" + seconds;

    $('.timer').text(currentTimeString);
		if (seconds == 20){
			if (minutes == 00){
				if (hours == 00)
				{
          var audio= new Audio("resource/1.mp3");
          audio.play();
					alert("Times out! Your after score would be eaten by the halloween pumpkin")
				}
			}
		}
  }, 1000);
}




$.fn.hexed = function(settings) {
  var title=document.createElement( 'p' );
  $(title).attr("class","title_bar");
  this.append(title);
  $(title).append("Hexed Games!");
  this.append("<p class='timer'></p>");
  //this.append("<p class=title_swatch1>Target Swatch</p>");
  this.append("<div id='swatch' class='ui-widget-content ui-corner-all'></div>");
  //this.append("<p class=title_swatch2>Guess Swatch</p>");
  this.append("<div id='guess_swatch' class='ui-widget-content ui-corner-all'></div>");
  var red = document.createElement( 'div' );
  $(red).attr("id", "red");
  this.append( red );
  var input1 = document.createElement( 'input' );
  $(input1).attr("id", "input1").attr("name","test").attr("type","text");
  this.append(input1);
  var green = document.createElement( 'div' );
  $(green).attr("id", "green");
  this.append( green );
  var input2 = document.createElement( 'input' );
  $(input2).attr("id", "input2").attr("name","test").attr("type","text");
  this.append(input2);
  var blue = document.createElement( 'div' );
  $(blue).attr("id", "blue");
  this.append( blue );
  var input3 = document.createElement( 'input' );
  $(input3).attr("id", "input3").attr("name","test").attr("type","text");
  this.append(input3);
  var button = document.createElement( 'button' );
  $(button).attr("id", "new").attr("type","button").html("New Game");
  this.append(button);
  this.append("<p id='result'></p>");
  this.append("<p id='best_scores'></p>");
  this.append("<p id='tmp_scores'></p>");
  this.append("<div id='setting_block'></div>");
  var set = document.createElement( 'button' );
  $(set).attr("id", "set").attr("type","button").html("Change Setting");
  $("#setting_block").append("<input id='name'></input>");
  $('#name').attr("value",settings.name);
  $("#setting_block").append("<input id='turns'></input>");
  $('#turns').attr("value",settings.turns);
  $("#setting_block").append(set);
  var inst=document.createElement( 'button' );
  $(inst).attr("id", "inst").attr("type","button").html("Game Instruction");
  this.append(inst);
  $(inst).click(function(){
    alert("Welcome to Hexed Game! Try to match your color swatch on the left with the swatch on the right using the sliders.");
  });

  var audio= new Audio("resource/haxed_games.mp3");
  audio.play();
  audio.addEventListener("ended",function() {
    alert("The wizard is too tired to play the music")
  }, true)

  slider_maker();
  new_game(settings.turns, settings.name);
}

$(function() {
  var settings={"name":"Mike","turns":3};
  $("body").hexed(settings);

});
