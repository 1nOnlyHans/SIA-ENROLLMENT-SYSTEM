const enclose = document.getElementById('enclose');
const images = [
    '../assets/bg.jpg',
    '../assets/bg2.jpg',
    '../assets/bg3.jpg'
]
let i = 0;

function changeBackground(){
    enclose.style.backgroundImage = `url('${images[i]}')`;
    i = (i+ 1) % images.length;
}
changeBackground();
setInterval(changeBackground, 5000);