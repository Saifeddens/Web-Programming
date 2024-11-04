document.addEventListener('DOMContentLoaded', () => {
    let totalTime = 0;
    let totalscore = 0;
    const grid = document.querySelector('.grid');
    const rows = 11;
    const cols = 11;
    let squares = Array.from(document.querySelectorAll('.elements-container div'));
    const width = 3;
    const elements = [
        {
            time: 2,
            type: 'water',
            shape: [[1,1,1],
                    [0,0,0],
                    [0,0,0]],
            rotation: 0,
            mirrored: false
        },
        {
            time: 2,
            type: 'town',
            shape: [[1,1,1],
                    [0,0,0],
                    [0,0,0]],
            rotation: 0,
            mirrored: false        
        },
        {
            time: 1,
            type: 'forest',
            shape: [[1,1,0],
                    [0,1,1],
                    [0,0,0]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 2,
            type: 'farm',
            shape: [[1,1,1],
                    [0,0,1],
                    [0,0,0]],
                rotation: 0,
                mirrored: false  
            },
        {
            time: 2,
            type: 'forest',
            shape: [[1,1,1],
                    [0,0,1],
                    [0,0,0]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 2,
            type: 'town',
            shape: [[1,1,1],
                    [0,1,0],
                    [0,0,0]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 2,
            type: 'farm',
            shape: [[1,1,1],
                    [0,1,0],
                    [0,0,0]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 1,
            type: 'town',
            shape: [[1,1,0],
                    [1,0,0],
                    [0,0,0]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 1,
            type: 'town',
            shape: [[1,1,1],
                    [1,1,0],
                    [0,0,0]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 1,
            type: 'farm',
            shape: [[1,1,0],
                    [0,1,1],
                    [0,0,0]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 1,
            type: 'farm',
            shape: [[0,1,0],
                    [1,1,1],
                    [0,1,0]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 2,
            type: 'water',
            shape: [[1,1,1],
                    [1,0,0],
                    [1,0,0]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 2,
            type: 'water',
            shape: [[1,0,0],
                    [1,1,1],
                    [1,0,0]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 2,
            type: 'forest',
            shape: [[1,1,0],
                    [0,1,1],
                    [0,0,1]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 2,
            type: 'forest',
            shape: [[1,1,0],
                    [0,1,1],
                    [0,0,0]],
            rotation: 0,
            mirrored: false  
        },
        {
            time: 2,
            type: 'water',
            shape: [[1,1,0],
                    [1,1,0],
                    [0,0,0]],
            rotation: 0,
            mirrored: false  
        },
    ].map(element => ({
        ...element,
        rotate() {
            // Logic to rotate the shape
            this.shape = this.shape[0].map((val, index) => this.shape.map(row => row[index]).reverse());
            this.rotation = (this.rotation + 90) % 360;
        },
        mirror() {
            // Logic to mirror the shape
            this.shape.forEach(row => row.reverse());
            this.mirrored = !this.mirrored;
        }
    }));
    let missionScores = {
        basic: {},
        extra: {}
    };
    let gameGrid = Array(rows).fill().map(() => Array(cols).fill(0)); 
    const mountainCells = [
        { row: 1, col: 1 },
        { row: 3, col: 8 },
        { row: 5, col: 3 },
        { row: 8, col: 9 },
        { row: 9, col: 5 }
    ];
    mountainCells.forEach(cell => {
        gameGrid[cell.row][cell.col] = 1;
    });
    for (let row = 0; row < rows; row++) {
        for (let col = 0; col < cols; col++) {
            const cell = document.createElement('div');
            cell.setAttribute('data-row', row);
            cell.setAttribute('data-col', col);
                if (gameGrid[row][col] === 1) {
                cell.style.backgroundImage = "url('./assignment_assets/assets/tiles/mountain_tile.png')";
                cell.style.backgroundSize = 'cover';
                cell.classList.add('non-clickable'); 
            }
    
            grid.appendChild(cell);
        }
    }

   


    let currentPosition = 0;
    let currentElementIndex = Math.floor(Math.random() * elements.length);
    function draw() {
        // Clear the previous elements
        squares.forEach(square => {
            square.style.backgroundImage = '';
            square.style.backgroundColor = ''; // To clear previous colors
        });
    
        const currentElement = elements[currentElementIndex];
        let squareIndex = 0;
    
        currentElement.shape.forEach((row, rowIndex) => {
            row.forEach((value, colIndex) => {
                if (value === 1) {
                    if (squareIndex < squares.length) {
                        const square = squares[squareIndex];
                        square.style.backgroundImage = "url('./assignment_assets/assets/tiles/" + currentElement.type + "_tile.png')";
                        square.style.backgroundSize = 'cover';
                    }
                }
                squareIndex++; // Increment squareIndex regardless of whether value is 1 or not
            });
        });
    
        document.getElementById('time-display').textContent = `Time: ${currentElement.time}`;
    }
    
    
    draw();
    
    
    function setCellValue(row, col, type) {
        const cell = document.querySelector(`.grid div[data-row="${row}"][data-col="${col}"]`);
        console.log('Setting value at row', row, 'col', col, 'for element type', type);

        if (cell) {
            switch (type) {
                case 'water':
                    cell.style.backgroundImage = "url('./assignment_assets/assets/tiles/water_tile.png')";
                    break;
            case 'town':
                cell.style.backgroundImage = "url('./assignment_assets/assets/tiles/town_tile.png')";
                break;
            case 'forest':
                cell.style.backgroundImage = "url('./assignment_assets/assets/tiles/forest_tile.png')";
                break;
            case 'farm':
                cell.style.backgroundImage = "url('./assignment_assets/assets/tiles/farm_tile.png')";
                break;
            default:
                cell.style.backgroundImage = "url('./assignment_assets/assets/tiles/base_tile.png')";
        }
        cell.style.backgroundSize = 'cover';
        } else {
            console.log('Cell not found at row', row, 'col', col);
        }
    }
    let isGameOver = false;


    
    function placeElementOnBiggerGrid(clickedCell) {
        if (isGameOver) {
            console.log("Game is over, no more elements can be placed.");
            return;
        }
        console.log('Placing element on the bigger grid...');
    
        const currentElement = elements[currentElementIndex];
        console.log('Current element:', currentElement);
        let firstOneRow = null;
        let firstOneCol = null;
        for (let rowIndex = 0; rowIndex < currentElement.shape.length; rowIndex++) {
            for (let colIndex = 0; colIndex < currentElement.shape[rowIndex].length; colIndex++) {
                if (currentElement.shape[rowIndex][colIndex] === 1) {
                    firstOneRow = rowIndex;
                    firstOneCol = colIndex;
                    break;
                }
            }
            if (firstOneRow !== null) break;
        }
        
        const startRow = parseInt(clickedCell.getAttribute('data-row')) - firstOneRow;
        const startCol = parseInt(clickedCell.getAttribute('data-col')) - firstOneCol;

        let targetRow = startRow + currentElement.shape.length;
        let targetCol = startCol + currentElement.shape[0].length;
        console.log('Placing at target position:', targetRow, targetCol);
        
        for (let rowIndex = 0; rowIndex < currentElement.shape.length; rowIndex++) {
            for (let colIndex = 0; colIndex < currentElement.shape[rowIndex].length; colIndex++) {
                if (currentElement.shape[rowIndex][colIndex] === 1) {
                    let row = startRow + rowIndex;
                    let col = startCol + colIndex;
    
                    if (row < 0 || row >= rows || col < 0 || col >= cols || gameGrid[row][col] === 1) {
                        console.log('Invalid placement on mountain or out of bounds');
                        return; 
                    }
                }
            }
        }

        currentElement.shape.forEach((row, rowIndex) => {
            row.forEach((value, colIndex) => {
                if (value === 1) {
                    let row = startRow + rowIndex;
                    let col = startCol + colIndex;
                    setCellValue(row, col, currentElement.type);
                    updateGameGrid(row, col, 1); 
                }
            });
        });
        totalTime += currentElement.time;
        console.log('current total time', totalTime);
    
        currentElementIndex = (currentElementIndex + 1) % elements.length;
    draw(); // Redraw to show the next element

        if (totalTime >= 28) {
            let finalScore = scoreBorderlands(gameGrid);
            gameOver(finalScore);
        }
         function gameOver(finalScore) {
            isGameOver = true; 
            
        
            setTimeout(function() {
                alert(`Game Over: Time limit reached\nTotal Score: ${finalScore}\n\n Mission Score: \n Borderland score :  ${finalScore} `);
                location.reload();
            }, 1000); 
        }
        

      
    }
   
        grid.addEventListener('click', (event) => {

        const clickedCell = event.target;
        if (grid.contains(clickedCell)) {
            placeElementOnBiggerGrid(clickedCell);
            draw();
        }
    });
    const missions = 
{
  "basic": [
    {
      "title": "Edge of the forest",
      "description": "You get one point for each forest field adjacent to the edge of your map."
    },
    {
      "title": "Sleepy valley",
      "description": "For every row with three forest fields, you get four points."
    },
    {
      "title": "Watering potatoes",
      "description": "You get two points for each water field adjacent to your farm fields."
    },
    {
      "title": "Borderlands",
      "description": "For each full row or column, you get six points."
    }
  ]
}




function scoreBorderlands(gameGrid) {
    let score = 0;
    const gridSize = gameGrid.length;

    console.log('Game grid:', gameGrid);

    for (let row = 0; row < gridSize; row++) {
        if (gameGrid[row].every(cell => cell !== 0)) {
            console.log('Full row found at index:', row);
            score += 6;
        }
    }

    for (let col = 0; col < gridSize; col++) {
        if (gameGrid.every(row => row[col] !== 0)) {
            console.log('Full column found at index:', col);
            score += 6;
        }
    }

    console.log('Total score:', score);
    return score;
}


function updateGameGrid(row, col, value) {
    gameGrid[row][col] = value;
    console.log(`Updated gameGrid at [${row}, ${col}]:`, gameGrid);
}

function updateMissionScore(missionCategory, missionTitle, points) {
    if (!missionScores[missionCategory][missionTitle]) {
        missionScores[missionCategory][missionTitle] = 0;
    }
    missionScores[missionCategory][missionTitle] += points;
}


document.getElementById('rotate-button').addEventListener('click', () => {
    const currentElement = elements[currentElementIndex];
    currentElement.rotate();
    draw();
});

document.getElementById('mirror-button').addEventListener('click', () => {
    const currentElement = elements[currentElementIndex];
    currentElement.mirror();
    draw();
});

});
