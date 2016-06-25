
(function() {
	"use strict";

	var readSpeed= 171;
	var timer = null;
	var listWords = null;

	//on load setup that initializes variables and diables the stop button
	window.onload = function() {
		var start = document.getElementById("begin")
		start.onclick = startScroll;
		var finish = document.getElementById("end")
		document.getElementById("end").disabled = true; 
		finish.onclick = stopScroll;
		for(var i = 0; i < document.getElementsByName("sameSize").length; i++) {
			document.getElementsByName("sameSize")[i].onchange = changeSize;
		}
		//select tag
		document.getElementById("speed").onchange = changeSpeed;		 
	}	

	//calles another function that takes care of the punctuation 
	//enables and disables the buttons
	function startScroll() {
		document.getElementById("begin").disabled = true;
		document.getElementById("end").disabled = false; 
		listWords = prepare();
		timer = setInterval(show, readSpeed);
	}

	//resets the timer and clears display box to restart
	function stopScroll() {
		document.getElementById("begin").disabled = false;
		document.getElementById("end").disabled = true; 
		document.getElementById("textholder").disabled = false;
		clearInterval(timer)
		timer = null;
		document.getElementById("space").innerHTML = "";
	}

	//this function handles returning the correct version of the array by taking out the words
	//that have puncuations and putting it back into the array without a punctuations
	function prepare() {
		var inputText =  document.getElementById("textholder").value;
		listWords = inputText.split(/[ \t\n]+/);
		for(var i = 0; i < listWords.length; i++) {
			var lastChar = listWords[i].charAt(listWords[i].length-1);
			if(lastChar == ","|| lastChar == "!"|| lastChar == "."|| lastChar == "?"|| lastChar == ";"|| lastChar == ":") {
				var wordNew = listWords[i].substring(0, listWords[i].length-1);
				listWords[i] = wordNew;
				listWords.splice(i, 0, wordNew);
				i++
			}
		}
		return listWords;
	}

	//displays the words on the display box and 
	//and stops if there are no words to display
	function show() {
		if(listWords.length == 0) {
			stopScroll();
		} else {
			var put = document.getElementById("space")
			put.innerHTML = listWords.shift();
		}
	}

	//changes the font size of words being processed
	function changeSize(){
		var speedReader = document.getElementById("space");
		var fontSizes = document.getElementsByName("sameSize"); 
		for(var i = 0; i < fontSizes.length; i++) {
		 	if(fontSizes[i].checked == true) {
		 		speedReader.style.fontSize = fontSizes[i].value;
		 	}
		 }
	}

	//cahnges the speed of the words being processed
	function changeSpeed() { 
		readSpeed = document.getElementById("speed").value;
			if (timer) {
				clearInterval(timer);
				timer = setInterval(show, readSpeed);
			}
	}
}());
