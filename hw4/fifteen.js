//fifteen.js implements things such as moving tiles to a webpage
(function() {
	"use strict";

	//global varibles for the empty box and the number 100
	var emptyWidth = 3;
	var emptyHeight = 3;
	var number = 100;

	window.onload = function() {
		//creates puzzle
		begin();
		form();

		//the extra feature that creates a dropdown box
		var drop = document.createElement("select");
		for(var i = 0; i < 4; i++) {
			var option = document.createElement("option");
				if(i == 0) {
					option.innerHTML = "background.jpg";
				} else {
					option.innerHTML = "background" + i + ".jpg";
				}
			drop.appendChild(option);
		}
		drop.onchange = changeMeFam;
		document.querySelector("body").insertBefore(drop, document.getElementById("controls"));
	};

	//outs a new background image in
	function changeMeFam () {
		var newSquares = document.querySelectorAll("#puzzlearea div");
		for(var i = 0; i < newSquares.length; i++) {
			newSquares[i].style.backgroundImage = "url(" + this.value + ")";
		}
	}

	//Creates 15 squares and intializes a button 
	function begin() {
		var grid = document.getElementById("puzzlearea");

		//gives tile a number.
		for(var i = 1; i <= 15; i++) {
			var box = document.createElement("div");
			box.className="box";
			grid.appendChild(box);
			var numberTile = document.createTextNode(i);
			box.appendChild(numberTile);
		}
		//jumps to a function if button is clicked
		var button = document.getElementById("shufflebutton");
		button.onclick = shuffle;
	}

	//put into 4x4 square
	function form() {
		var row = 0;
		var column = 0;
		var part = document.querySelectorAll("#puzzlearea .box");
		
		//puts background image in the right spot
		for(var i = 0; i < part.length; i++) {
			part[i].classList.add("dragon");
			
			//the squares cannot go beyond 4*4
			if (column == 400) {
				column = 0;
				row = row + number;
			}

			if (column != 400) {

				part[i].style.top = row + "px";
				part[i].style.left= column + "px";
				var yPart = (row * -1) + "px";
				var xPart = (column * -1) + "px";
				part[i].style.backgroundPosition = xPart + " " + yPart;
				column = column + number;
			} 
		}
		//jumps to a function if mouse runs over
		var areaLine = document.querySelectorAll("#puzzlearea .box");
		for (var i = 0; i < areaLine.length; i++) {
			areaLine[i].onmouseover = touched;
		}
	}

	//Highlights the tile red if the tile can be moved.
	function touched() {
		var x = parseInt(this.style.top);
		var y = parseInt(this.style.left);				

		//Checks to see if tile can be moved.
		if (((x - number == (emptyWidth * number) || x + number == (emptyWidth * number)) && 
		y == (emptyHeight * number)) || ((y - number == (emptyHeight * number) || 
		y + number == (emptyHeight * number)) && x == (emptyWidth * number))) {

			this.classList.add("highlight");
			this.onclick = function() { 
				move(this); 
			};
			this.onmouseout = rid;
		} 
	}

	//gets rid of the highlight once the mouse leaves the tile
	function rid() {
		if (this.classList.contains("highlight")) {
			this.classList.remove("highlight");
		} 
	}

	//checks to see if tile can be moved then moves it to the empty space.
	function move(pictureBox) {
		var x = parseInt(pictureBox.style.top);
		var y = parseInt(pictureBox.style.left);

		//sees if the tile can be moved
		if (((x - number == (emptyWidth * number) || x + number == (emptyWidth * number)) && 
		y == (emptyHeight * number)) || ((y - number == (emptyHeight * number) || 
		y + number == (emptyHeight * number)) && x == (emptyWidth * number))) {

			//switches position of tile and empty space
			var newX = x / number;
			var newY = y / number;
			pictureBox.style.top = (emptyWidth * number) + "px";
			pictureBox.style.left = (emptyHeight * number) + "px";
			emptyWidth = newX;
			emptyHeight = newY;
		}
	}

	//Randomly position all tiles.
	function shuffle() {
		var areaLine = document.querySelectorAll("#puzzlearea .box");
		for (var i  = 0; i < 1000; i++) {
			
			var neighbor = [];

				//checks if can be tile be moved
				for (var j = 0; j < areaLine.length; j++) {

					var x = parseInt(areaLine[j].style.top);
					var y = parseInt(areaLine[j].style.left);	

					if (((x - number == (emptyWidth * number) || x + number == (emptyWidth * number)) && 
					y == (emptyHeight * number)) || ((y - number == (emptyHeight * number) || 
					y + number == (emptyHeight * number)) && x == (emptyWidth * number))) {
						neighbor.push(areaLine[j]);
					}
				}

			//get a random tile to move
			var randomness = parseInt(Math.random() * neighbor.length);
			move(neighbor[randomness]);
		}	
	}
})();