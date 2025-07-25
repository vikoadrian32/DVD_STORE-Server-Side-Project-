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

let search = document.querySelector('#search');
let icon = document.querySelector('.searchBtn');
let iconClose = document.querySelector('.closeBtn');

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


let currentQuantity = 1; // inisial jumlah tiket yang dibeli 
let maxStock = parseInt(document.getElementById('stockCount').textContent) || 0; // mengambil banyak stok
let pricePerTicket = parseInt(document.getElementById('pricePerTicket').getAttribute('data-price')) || 0; // mengambil harga tiket 

function updateStockDisplay() {
    const stockElement = document.getElementById('stockCount');
    const stockCount = maxStock;
    
    if (stockCount <= 0) {
        stockElement.className = 'stock-count out';
    } else if (stockCount <= 5) {
        stockElement.className = 'stock-count low';
    } else {
        stockElement.className = 'stock-count';
    }
}

function formatRupiah(amount) {
    return 'Rp ' + amount.toLocaleString('id-ID');
}

function updateTotal() {
    const totalAmount = currentQuantity * pricePerTicket;
    document.getElementById('totalAmount').textContent = formatRupiah(totalAmount);
    document.getElementById('hiddenTotal').value = totalAmount;
}

function updateButtons() {
    const decreaseBtn = document.getElementById('decreaseBtn');
    const increaseBtn = document.getElementById('increaseBtn');
    const orderBtn = document.getElementById('orderBtn');

    decreaseBtn.disabled = currentQuantity <= 1;
    increaseBtn.disabled = currentQuantity >= maxStock || maxStock <= 0;
    orderBtn.disabled = maxStock <= 0;
}

function changeQuantity(change) {
    const newQuantity = currentQuantity + change;
    
    if (newQuantity >= 1 && newQuantity <= maxStock) {
        currentQuantity = newQuantity;
        document.getElementById('quantityDisplay').textContent = currentQuantity;
        document.getElementById('hiddenQuantity').value = currentQuantity;
        updateTotal();
        updateButtons();
    }
}

// Form submission handling
document.getElementById('orderForm').addEventListener('submit', function(e) {
    const selectedDate = document.getElementById('ticket_date').value;
    
    if (!selectedDate) {
        e.preventDefault();
        alert('Please select a date for your tickets!');
        return false;
    }

    if (maxStock <= 0) {
        e.preventDefault();
        alert('Sorry, tickets are sold out!');
        return false;
    }

    if (currentQuantity > maxStock) {
        e.preventDefault();
        alert(`Sorry, only ${maxStock} tickets available!`);
        return false;
    }

    // Update hidden form fields
    document.getElementById('hiddenDate').value = selectedDate;
    
    // Show confirmation
    const totalPrice = currentQuantity * pricePerTicket;
    const filmTitle = '{{$films->title}}';
    
    const confirmation = confirm(
        `Order Summary:\n` +
        `Movie: ${filmTitle}\n` +
        `Date: ${selectedDate}\n` +
        `Quantity: ${currentQuantity} ticket(s)\n` +
        `Total: ${formatRupiah(totalPrice)}\n\n` +
        `Proceed to checkout?`
    );

    if (!confirmation) {
        e.preventDefault();
        return false;
    }
});


// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateStockDisplay();
    updateTotal();
    updateButtons();
});

function showOrderModal(movieData = null) {
    const modal = document.getElementById('orderModal');
    const quantity = parseInt(document.getElementById('quantityDisplay').innerText);
    const price = parseInt(document.getElementById('pricePerTicket').dataset.price);
    const dateInput = document.getElementById('ticket_date');
    const date = dateInput.value;

    // 🔒 Validasi: Pastikan tanggal dipilih
    if (!date) {
        alert("Please select a date before ordering.");
        dateInput.focus(); // arahkan fokus ke input tanggal
        return;
    }

    const total = quantity * price;

    // Isi konten modal
    document.getElementById('movieDate').textContent = date;
    document.getElementById('ticketQuantity').textContent = `${quantity} ticket${quantity > 1 ? 's' : ''}`;
    document.getElementById('totalPrice').textContent = `Rp ${total.toLocaleString('id-ID')}`;

    // Isi hidden input form
    document.getElementById('hiddenQuantity').value = quantity;
    document.getElementById('hiddenDate').value = date;
    document.getElementById('hiddenTotal').value = total;

    // Tampilkan modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}



  function closeModal() {
            const modal = document.getElementById('orderModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
    
    }

    function confirmOrder() {
        closeModal();
        
        // Simulate API call
        setTimeout(() => {
            showSuccessModal();
        }, 500);
    }
    function showSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.classList.add('active');
    }

    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    function showErrorModal(message = 'Something went wrong. Please try again.') {
        const modal = document.getElementById('errorModal');
        document.getElementById('errorMessage').textContent = message;
        modal.classList.add('active');
    }

    function closeErrorModal() {
        const modal = document.getElementById('errorModal');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    function retryOrder() {
        closeErrorModal();
        showOrderModal();
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-overlay')) {
            if (e.target.id === 'orderModal') closeModal();
            if (e.target.id === 'successModal') closeSuccessModal();
            if (e.target.id === 'errorModal') closeErrorModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
            closeSuccessModal();
            closeErrorModal();
        }
    });

   

    function confirmOrder() {
        document.getElementById('orderForm').submit();
        closeModal();
            
        // Simulate API call
        setTimeout(() => {
            showSuccessModal();
        }, 500);
    }

    function showSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.classList.add('active');
    }

    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }