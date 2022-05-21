
var move = 10,

// moveLeft = 1: move right, moveLeft = -1 : move left,
// moveTop = 1: move bottom, moveTop = -1 : move top,
moveLeft = 1,
moveTop = 1,
movingBox = document.getElementById('anim_box');

setInterval(
    function () {

        let movingBoxLeft = movingBox.offsetLeft,
        movingBoxBottom = movingBoxLeft + movingBox.offsetWidth;

        let boxTopPos = movingBox.offsetTop,
        boxBottomPos = boxTopPos + movingBox.offsetHeight;

        if (movingBoxBottom > document.body.offsetWidth) {
            moveLeft = -1; //change move L/R
        }

        if (movingBoxLeft < 0) {
            moveLeft = 1; //change move L/R
        }

        if (boxBottomPos > document.body.offsetHeight) {
            moveTop = -1; //change move T/B
        }
        if (boxTopPos < 0) {
            moveTop = 1; //change move T/B
        }

        // update movement
        movingBox.style.top = (boxTopPos + move * moveTop) + 'px';
        movingBox.style.left = (movingBoxLeft + move * moveLeft) + 'px';
    }

    ,1000);   //run every secound
