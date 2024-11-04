document.addEventListener('DOMContentLoaded', () => {
    const boardElement = document.getElementById("board");
    const grid = make_grid();
    boardElement.appendChild(grid); 
    fillBoxesWithImages(); 
    placeImageInCenter("Assets/Stargate.png"); 
    setMoveableArea()
});
document.body.style.backgroundImage = 'url("bkg.png")';
document.body.style.backgroundSize = 'cover';
document.body.style.backgroundRepeat = 'no-repeat'; 
document.getElementById('myDiv').addEventListener('dblclick', function() {
    alert('You double-clicked me!');
});



function make_grid(){
    var container = document.createElement('div');
    container.id = "main" ;
    container.className = "container";

    for(var i=0;i<5;i++){
        var row = document.createElement('div');
        row.id = "row"+i ;
        row.className = "row";
        for(var j=0;j<5;j++){
            var box = document.createElement('div');
            box.id="box"+j
            box.className = "box";
            box.addEventListener("click",on_click )
            row.appendChild(box);
        }
        container.appendChild(row);
    }
    return container;
}
function on_click(e){
    const boxes = document.querySelectorAll('.box');
    if(e.srcElement.classList.contains("moveable")){
        e.srcElement.className
        const soldier = document.getElementsByClassName("soldier");
        const parent = soldier[0].parentElement 
        move(parent,e.srcElement)
        resetMoveableArea()
        resetMoveableArea()
        resetMoveableArea()
        setMoveableArea()
    }
    
}
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]]; // Swap elements
    }
}
function placeImageInCenter(imageSrc) {
    const boxes = document.querySelectorAll('.box');
    const img = document.createElement('img');
    img.src = imageSrc;
    img.className = 'back-face';
    boxes[12].appendChild(img); // Appends the specific image to the center box
    const img2 = document.createElement('img');
    img2.src = 'Assets/Player.png';
    img2.className= 'front-face soldier'
    boxes[12].appendChild(img2)
}
function revealOasis(el){
    el.removeChild(el.lastChild)
}
function setMoveableArea(){
    const boxes = document.querySelectorAll('.box');
    const soldier = document.getElementsByClassName("soldier");
    const parent = soldier[0].parentElement 
    const movaeble = [];
    let index = parseInt(parent.id.slice(-1));
    if(parent.nextSibling !=null){
        movaeble.push(parent.nextSibling);
    }
    
    if(parent.previousSibling !=null){
        movaeble.push(parent.previousSibling);
    }
    if(parent.parentElement.nextSibling !=null){
        movaeble.push(parent.parentElement.nextSibling.childNodes[index]);
    }
    if(parent.parentElement.previousSibling !=null){
        movaeble.push(parent.parentElement.previousSibling.childNodes[index]);
    }
    
    
    
    movaeble.forEach((el,index)=>{
        if(!el.className.includes(" movable")){
            el.className=el.className+" moveable"
        }
        
    }
    )
}
function resetMoveableArea(){
    const moveables = document.getElementsByClassName("moveable");
    // for (i of moveables) {
    //     i.classList.remove("moveable")
    // }
    for (let i = 0; i < moveables.length; i++) {
        moveables[i].classList.remove("moveable")
    };
}
function move(el,moveTo) {
    var getClassOf = Function.prototype.call.bind(Object.prototype.toString)
    console.log(getClassOf(moveTo))
    if (moveTo.childNodes.length>=2){
        revealOasis(moveTo)
    }
    moveTo.appendChild(el.lastChild);
  }
function fillBoxesWithImages() {
    const images = ["Assets/Oasis.png","Assets/Oasis.png","Assets/Oasis.png","Assets/Drought.png"];
    shuffleArray(images);
    const boxes = document.querySelectorAll('.box');
    let indices = Array.from(Array(boxes.length).keys()).filter(index => index != 12);    
    shuffleArray(indices);
    const selectedIndices = indices.slice(0, images.length);
    selectedIndices.forEach((index, imageIndex) => {
        const img = document.createElement('img');
        const img_2 = document.createElement('img')
        img_2.src = "Assets/Oasis_marker.png";
        img.src = images[imageIndex];
        img.className = 'back-face';
        img_2.className = 'front-face'
        if (img.src =="player.png"){
        }
        else{
            img.onload = () => {
                boxes[index].appendChild(img); 
                boxes[index].appendChild(img_2);
            };
        }
    });
    

}