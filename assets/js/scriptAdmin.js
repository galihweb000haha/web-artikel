
var article = document.getElementById('article');
var documentation = document.getElementById('documentation');
var message = document.getElementById('message');
var schedule = document.getElementById('schedule');
var info = document.getElementById('info');

var content = document.getElementById('content');



const tagHari = document.getElementById("hari");
const hari = tagHari.value;

const time = document.getElementById('time');
function tampilWaktu(){
var waktu = new Date();
var jam = waktu.getHours() + "";
var menit = waktu.getMinutes() + "";
var detik = waktu.getSeconds() + "";
time.innerHTML = hari +" "+ jam + ":" + menit + ":" + detik
}
document.body.addEventListener("load", tampilWaktu());
setInterval('tampilWaktu()', 1000);

// var hapus = document.querySelector('.hapusartikel');
// hapus.addEventListener('click', function(e){
// e.preventDefault();
// console.log('ok');
// Swal('asd','asd','success');
// });

$(document).delegate('#isiArtikel', 'keydown', function(e){
    var keyCode = e.keyCode || e.wich;
    if(keyCode == 9){
        e.preventDefault();
        var start = this.selectionStart;
        var end = this.selectionEnd;
        
        $(this).val($(this).val().substring(0, start)
        + "\t"
        + $(this).val().substring(end));
        
        this.selectionStart = 
         this.selectionEnd = start + 1;

    }
});




    var warna = document.getElementById('warna');
    var rgb = warna.value;
    document.body.style.backgroundColor = "rgb("+ rgb +")";


// document.body.addEventListener('mousemove', function(event){
// const xPos = Math.round((event.clientX / window.innerWidth) * 255);

// const yPos = Math.round((event.clientY / window.innerHeight) * 255);
// document.body.style.backgroundColor = 
// 'rgb('+xPos+','+ yPos +',100)';
// });

