(function() {
	"use strict";
	
	//change these to update difficulty 
	// ie empty = 3 means 4x4, empty = 4 means 5x5
	var moves = 0;
	var emptyR = 3;
	var emptyC = 3;
	var pixel = 100; // used for dimensions or going down 2 decimals for some elements
	var shuffled = false;
	window.onload = function() {
		createTiles();
		createGame();
		document.getElementById("shufflebutton").onclick = shuffle;
	};

	if (size == 4) {
		emptyR = 3; 
		emptyC = 3; 
	} else if (size == 5) {
		emptyR = 4;
		emptyC = 4; 
	} else if (size == 6) {
		emptyR = 5;
		emptyC = 5;
	}


	// create the divs for tiles on the board
	function createTiles() {
		var puzzlearea = document.getElementById("puzzlearea");
		for (var i = 1; i < (size * size); i++) { // change max forloop based on x^2
			var tiles = document.createElement("div");
			tiles.className = "tiles";
			tiles.innerHTML = i; // print numbers for each tile
			tiles.addEventListener("click", move);
			tiles.addEventListener("mouseover", hover);
			tiles.addEventListener("mouseout", off);
			puzzlearea.appendChild(tiles); // put the div in puzzlearea	
		}
	}
	
	function checkIfWon(){
		var tiles = document.querySelectorAll("#puzzlearea .tiles"); // get all tile div
		var row = 0;
		var col = 0;
		var won = true;
		for (var i = 0; i < tiles.length; i++) {	
			if(tiles[i].innerHTML != (i+1) || tiles[i].id !== "tiles_" + Math.abs(col/pixel) + "_" + Math.abs(row/pixel)){
				won = false;
				break;
				
			}

			col -= pixel;
			if ((i % size) === (size - 1)) { // reset, like a typewriter
				col = 0;
				row -= pixel;
			}
			
		}
		return won;
	}

	// assign portions of the background image to tiles
	function createGame() {
		var tiles = document.querySelectorAll("#puzzlearea .tiles"); // get all tile div
		var row = 0;
		var col = 0;
		for (var i = 0; i < tiles.length; i++) {
			tiles[i].style.left = Math.abs(col) + "px"; // set location of tiles
			tiles[i].style.top = Math.abs(row) + "px";
			tiles[i].style.backgroundPosition = col + "px " + row + "px"; // sets portion of pic
			tiles[i].id = "tiles_" + Math.abs(col/pixel) + "_" + Math.abs(row/pixel);
			col -= pixel;
			// change if statement, if 4x4, then i % 4 == 3
			if ((i % size) === (size - 1)) { // reset, like a typewriter 
				col = 0;
				row -= pixel;
			}
		}
	}
	
	// selects the tile that was clicked to be moved
	function move() {
		var col = parseInt(this.style.left) / pixel;
		var row = parseInt(this.style.top) / pixel;
		var id = "tiles_" + col + "_" + row; // make the id of selected tile
		if(checkIfWon() && shuffled){
			document.cookie = "moves=" + moves;
			shuffled = false;
			moves = 0;
			window.open('http://localhost/fifteen-master/score.php');
		}
		moveBlock(id);
	}

	// randomly shuffles the tiles 
	function shuffle() {
		for (var i = 0; i < 1; i++) { // create 1000 random directions for shuffle
			var row = emptyR;
			var col = emptyC;
			var direction = parseInt(Math.random() * 4) + 1;
			if (direction === 1 && (emptyR <= 3)) { // picks random square to shuffle with
				col--;
			} else if (direction === 3 && (emptyC >= 0)) {
				row--;
			} else if (direction === 2 && (emptyR >= 0)) {
				col++;
			} else if (direction === 4 && (emptyC <= 3)) {
				row++;
			}
			var id = "tiles_" + col + "_" + row;
			if (document.getElementById(id)) { // if the tile created is valid
				moveBlock(id);
			}
		}
		shuffled = true;

	}

	// swaps the empty block with the chosen block
	function moveBlock(block) {
		if(changable(block)) { // if the tile is changable 
			moves++;
			document.getElementById("score").innerHTML = "Score: " + moves;
			console.log(moves);
			var id = document.getElementById(block);
			var newR = parseInt(id.style.top);
			var newC = parseInt(id.style.left);
			id.id = "tiles_" + emptyC + "_" + emptyR;
			id.style.left = emptyC * pixel + "px"; // swap box cord with empty cord
			id.style.top = emptyR * pixel + "px";
			emptyC = newC / 100; // update the empty coordinates
			emptyR = newR / 100;
		}
 	}
 	
 	// changes tile css property if mouse is hovering it
	function hover() {
		if (changable(this.id)) {
			this.className = "tilesHover";
		}
	}

	// reverts back to original style if mouse is not over it
	function off() {
		this.className = "tiles";
	}

	// checks if the box is movable or not
	function changable(currentTile) {
		var id = document.getElementById(currentTile);
		var Xcord = parseInt(id.style.left) / pixel;
		var Ycord = parseInt(id.style.top) / pixel;
		if  (Xcord == emptyC) { // checks for neighbors (not inclduing diagonal)
			return ((Ycord + 1) == emptyR) || ((Ycord - 1) == emptyR);
		} else if (Ycord == emptyR) {
			return ((Xcord + 1) == emptyC) || ((Xcord - 1) == emptyC);
		}
		return false; // if all else fails
	}
}());