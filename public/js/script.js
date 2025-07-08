let search = document.querySelector('#search');
let icon = document.querySelector('.searchBtn');
let iconClose = document.querySelector('.closeBtn');

document.addEventListener("DOMContentLoaded", function() {  /**<= baris ini untuk mengeksekusi
fungsi ketika dokumen html sudah dimuat sepenuhnya */
  const detailElements = document.querySelectorAll('.detail'); /**<= baris ini mengambil semua element
  yang memiliki class "detail" */

  detailElements.forEach(function(detail) { /** <= Melakukan iterasi pada setiap element detail sebelumnya */
      const sinopsis = detail.querySelector('.sinopsis'); /** <= mengambil element dengan class "sinopsis" */
      const btnDetail = detail.querySelector('.btnDetail'); /** <= mengambil element dengan class "btnDetail" */

      btnDetail.addEventListener('click', function() { /** <= Memberikan EventListener Ketika Button 
      dengan class "btnDetail" di click */

          if (sinopsis.style.maxHeight) { /** <= jika maxHeight sudah diatur maka  */
              sinopsis.style.maxHeight = null; /** Mengubah maxHeight  menjadi null dengan begitu text akan terlihat
              sepenuhnya */
              btnDetail.textContent = 'See More'; /** Mengubah Text Button menjadi Close */
          } else {  /** <= Jika maxHeight belum diatur maka  */
            btnDetail.textContent = 'Close'; /** Mengubah text button menjadi See More */
              sinopsis.style.maxHeight = sinopsis.scrollHeight + "px"; /** scrollHeight untuk memberikin 
              tinggi sebenarnya dari element yang mungkin overflow */
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