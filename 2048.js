
/*
 * tile {
    x:
    y:
    value:
    htmlElement:
 }
 **/

main();

function main() {
    
    var grid = []; // 4 by 4 2-D grid
    var hasStateChanged = false;    // if state is true then grid state has changes
    
    window.onload = function () {
        createGrid();
        printGrid(); // prints all grid contents to browser console
        window.addEventListener('keyup',move);
    };
    
    // creates Grid
    function createGrid() {
        var rows = 4;
        var cols = 4;
        var game = document.getElementById('game-2048');
        for (i = 0; i < rows ;i++) {
            var tileRow = createTileDiv('row');
            grid[i] = [];
            for (idx = 0; idx < cols ;idx++) {
                var tileCol = createTileDiv('col-sm-1');
                var tile = {};
                tile.y = i;
                tile.x = idx;
                tile.value = 0;
                tile.htmlElement = createTileDiv('empty');
                tileCol.appendChild(tile.htmlElement);
                tileRow.appendChild(tileCol);
                grid[i][idx] = tile;
            }
            game.appendChild(tileRow);
        }
        
        insertRndNumTile(2);
    }
    
    // inserts a random numbered tile with value 2
    function insertRndNumTile(num) {
        if (!num) {
            num = 1;
        }
        var count = 0;
        var length = 0;
        while (count < num) {
            var r = Math.floor(Math.random() * 4);
            var c = Math.floor(Math.random() * 4);
            var tile = grid[r][c];
            if (tile.value === 0) {
                count++;
                makeTileNumbered(tile,2);
            } else {
                length++;
                console.log('Length: '+length);
                continue;
            }   
        }
    }
    
    // prints grid to browser console
    function printGrid() {
        for (i = 0; i < grid.length ;i++) {
            for (idx = 0; idx < grid[i].length ;idx++) {
                console.log(grid[i][idx]);
            }
        }
    }
    
    /*
     * call back function
     * when keyboard right,left,up,down is detected this function is called
     */
    function move(event) {
        var x = event.keyCode;
        hasStateChanged = false;
        
        switch (x) {
            case 37:
                console.log('left');
                moveLeftOrRight(shiftTilesLeft);
                break;
            case 38:
                console.log('up');
                moveUpOrDown(shiftTilesRight);
                break;
            case 39:
                console.log('right');
                moveLeftOrRight(shiftTilesRight);
                break;
            case 40:
                console.log('down');
                moveUpOrDown(shiftTilesLeft);
                break;
            default:
        }
        
        console.log('gridState: ' + hasStateChanged);
        if (hasStateChanged) {
            setTimeout(insertRndNumTile,400);
        }
    }
    
    // slide tiles up or down
    function moveUpOrDown(shiftTiles) {
        var row = [];
        var idx = 0;
        
        for (var i = 0; i < grid.length ;i++) {
            idx = 0;
            for (var l = grid.length-1; l >= 0  ;l--) {
                row[idx++] = grid[l][i];
            }
            var newRow = shiftTiles(row);
            updateRow(newRow,row);
        }
    }
    
    // slide tiles left or right
    function moveLeftOrRight(shiftTiles) {
        var i = 0;
        while ( i < grid.length) {
            var newRow = shiftTiles(grid[i]);
            updateRow(newRow,grid[i]);
            i++;
        }
    }
    
    /*
     * shift tiles to the left:
     *  - check if you have two pairs, if true then collapse pairs and push to furthest left slots
     *  - Otherwise, split the row by half until you have 1 block, preform the right checks and insert the block
     *    in the correct row position.
     *
     *    return a new row with the correct order.
     */
    function shiftTilesLeft(row) {
        var newRow = checkForPairs(row);
        if (newRow.length === 2) {
            var i = 0;
            while (i++ < row.length/2) {
                newRow.push(0); 
            }
        } else {
            newRow = [0,0,0,0];
            var rowState = {hasChanged:0};
            var currRow = splitRow(row);
            splitThenShiftL(currRow[0],newRow,rowState);
            splitThenShiftL(currRow[1],newRow,rowState);
        }
        console.log(newRow);
        return newRow;
    }
    
    // shiftTilesLeft helper function
    function splitThenShiftL(half,row,state) {
        if (half.length > 1) {
            var halfs = splitArray(half);
            splitThenShiftL(halfs[0],row,state);
            splitThenShiftL(halfs[1],row,state);
        } else if (half.length === 1) {
            for (i = 0; i < row.length ;i++) {
                if (row[i] === 0) {
                    row[i] = half[0];
                    break;
                } else if (row[i] === half[0] && state.hasChanged === 0 && row[i+1] === 0) {
                    state.hasChanged = 1;
                    row[i] += half[0];
                    break;
                }
            }
        }
    }
    
    /*
     * shift tiles to the right:
     *  - check if you have two pairs, if true then collapse pairs and push to furthest right slots
     *  - Otherwise, split the row by half until you have 1 block, preform the right checks and insert the block
     *    in the correct row position.
     *
     *    return a new row with the correct order.
     */
    function shiftTilesRight(row) {
        var newRow = checkForPairs(row);
        if (newRow.length === 2) {
            var i = 0;
            while (i++ < row.length/2) {
                newRow.unshift(0); 
            }
        } else {
            newRow = [0,0,0,0];
            var rowState = {hasChanged:0};
            var currRow = splitRow(row);
            splitThenShiftR(currRow[1],newRow,rowState);
            splitThenShiftR(currRow[0],newRow,rowState);
        }
        console.log(newRow);
        return newRow;
    }
    
    // shiftTilesRight helper function
    function splitThenShiftR(half,row,state) {
        if (half.length > 1) {
            var halfs = splitArray(half);
            splitThenShiftR(halfs[1],row,state);
            splitThenShiftR(halfs[0],row,state);
        } else if (half.length === 1) {
            for (i = row.length-1; i >= 0 ;i--) {
                if (row[i] === 0) {
                    row[i] = half[0];
                    break;
                } else if (row[i] === half[0] && state.hasChanged === 0 && row[i-1] === 0) {
                    state.hasChanged = 1;
                    row[i] += half[0];
                    break;
                }
            }
        }
    }
    
    // splits a row of tile objects in half and returns both halfs
    function splitRow(row) {
        var left = [];
        var right = [];
        
        for ( i = 0,idx = 0; i < row.length ;i++) {
            if (i < row.length/2) {
                left[i] = row[i].value;
            } else {
                right[idx++] = row[i].value;
            }
        }
        
        return [left,right];
    }
    
    // splits an array of values in half and returns both halfs
    function splitArray(row) {
        var left = [];
        var right = [];
        
        for ( i = 0,idx = 0; i < row.length ;i++) {
            if (i < row.length/2) {
                left[i] = row[i];
            } else {
                right[idx++] = row[i];
            }
        }
        
        return [left,right];
    }
    
    // checks if a row has 2 pairs
    function checkForPairs(row) {
        var result = [];
        
        for (i = 1 ; i < row.length/2 ;i++) {
            if (row[0].value === 0 || row[0].value !== row[i].value) {
                return [];
            }
        }
        
        for (idx = row.length/2+1; idx < row.length ;idx++) {
            if (row[row.length/2].value === 0 || row[row.length/2].value !== row[idx].value) {
                return [];
            }
        }
        
        result[0] = row[0].value * row.length/2;
        result[1] = row[row.length-1].value * row.length/2;
        
        return result;
    }
    
    // copies the content of one row to another
    function updateRow(newRow,currRow) {
        var i = 0;
        while (i < newRow.length) {
            if (newRow[i] !== currRow[i].value && newRow[i] !== 0) {
                hasStateChanged = true;
            }
                        
            if (newRow[i] === 0) {
                makeTileEmpty(currRow[i]);
            } else {
                makeTileEmpty(currRow[i]);
                makeTileNumbered(currRow[i],newRow[i]);
            }
            i++;
        }
    }
    
    // makes a tile empty, by changing tile object values
    function makeTileEmpty(tile) {
        tile.htmlElement.style.transition = "all 1s";
        tile.htmlElement.className = 'empty';
        tile.htmlElement.removeAttribute("id");
        tile.htmlElement.innerHTML = '';
        tile.value = 0;
    }
    
    // creates a tile div and return the div
    function createTileDiv(className) {
        var tile = document.createElement('div');
        tile.className = className;
        return tile;
    }
    
    // makes a tile numbered, by changing tile object values and assigning a number
    function makeTileNumbered(tile,value) {
        tile.htmlElement.id = 't-'+tile.y+"-"+tile.x;
        tile.htmlElement.className = 'numbered-tile';
        tile.htmlElement.innerHTML = value;
        tile.value = value;
        tile.htmlElement.style.transition = "all 1s";
    }
    
}
