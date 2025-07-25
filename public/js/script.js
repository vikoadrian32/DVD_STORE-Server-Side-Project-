let search = document.querySelector('#search');
let icon = document.querySelector('.searchBtn');
let iconClose = document.querySelector('.closeBtn');
document.addEventListener("DOMContentLoaded", function() {
    const detailElements = document.querySelectorAll('.detail');

    detailElements.forEach(function(detail) {
        const sinopsis = detail.querySelector('.sinopsis');
        const btnDetail = detail.querySelector('.btnDetail');

        btnDetail.addEventListener('click', function() {
            if (sinopsis.classList.contains('expanded')) {
                sinopsis.classList.remove('expanded');
                btnDetail.textContent = 'See More';
            } else {
                sinopsis.classList.add('expanded');
                btnDetail.textContent = 'Close';
            }
        });
    });
});

// Apabila Icon Search Di klik maka :
icon.addEventListener('click',function(){
    search.style.display = "inline"; /* Membuat display search yang tadinya berupa none menjadi inline */
    icon.style.display = "none"; /** Membuat Icon Search menjadi display none  */
    iconClose.style.display = "inline"; /** Lalu Menampilkan Icon X sebagai pengganti Icon Search */
    // console.log("Berhasil");
})

iconClose.addEventListener('click',function(){
    search.style.display = "none"; /** Membuat search Field menjadi none kembali */
    icon.style.display = "inline"; /** menampilkan icon search yang sebelumnya tidak ditampilkan */
    iconClose.style.display = "none"; /** membuat icon X menjadi none */
})



let buttonPlayIcon = document.getElementById('btn_play');
let buttonPauseIcon = document.getElementById('btn_pause');
let videoArea = document.querySelector('video');
let video = document.querySelector('.video_controls video');
let timeout ;

buttonPlayIcon.addEventListener('click',function(){
 video.play();
 buttonPauseIcon.style.display="block";
 buttonPlayIcon.style.display = "none";
 timeout = setTimeout(function() {
     buttonPauseIcon.style.display = "none";
 }, 3000); // 5 detik (5000 milidetik)
})

buttonPauseIcon.addEventListener('click',function(){
 video.pause();
 buttonPlayIcon.style.display = "block";
 buttonPauseIcon.style.display = "none";

 timeout = setTimeout(function(){
     buttonPlayIcon.style.display = "none";
 },3000);
})

videoArea.addEventListener('mouseover',function(){
    if(!video.paused){
        buttonPauseIcon.style.display = "block";
     }else{
     buttonPlayIcon.style.display = "block";
     }
     clearTimeout(timeout);
})

videoArea.addEventListener('mouseleave',function(){
 buttonPlayIcon.style.display = "none";
 buttonPauseIcon.style.display = "none";
 timeout = setTimeout(function() {
     buttonPauseIcon.style.display = "none";
 }, 5000); 
})

