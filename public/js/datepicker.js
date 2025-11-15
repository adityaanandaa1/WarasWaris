// datepicker.js

// 1. Deklarasi Semua Variabel (Semua ID harus ada di HTML di Langkah 1!)
const dateInput = document.getElementById('dateInput');
const calendarIcon = document.getElementById('calendarIcon');
const calendarPopup = document.getElementById('calendarPopup');
const selectedDateInput = document.getElementById('selectedDateInput');

const monthYearElement = document.getElementById('monthYear');
const dateElement = document.getElementById('dates');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const daysRow = document.querySelector('.days'); // Mengambil class days pertama
const monthGrid = document.getElementById('month');
const yearGrid = document.getElementById('year');

let currentDate = new Date();
let mode = 'date';

// Fungsi untuk membuka/menutup popup kalender
const toggleCalendar = () => {
    calendarPopup.classList.toggle('hidden');
    
    // Perbarui kalender saat dibuka
    if (!calendarPopup.classList.contains('hidden')) {
        updateCalendar();
    }
};

// DATEPICKER: Fungsi utama untuk mengisi tanggal
const updateCalendar = () => {
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();

    monthYearElement.classList.remove("no-pointer");
    prevBtn.classList.remove("hidden-icon");
    nextBtn.classList.remove("hidden-icon");

    const firstDayIndex = new Date(currentYear, currentMonth, 1).getDay();
    const totalDays = new Date(currentYear, currentMonth + 1, 0).getDate();

    const monthYearString = currentDate.toLocaleString('id-ID', { 
        month: 'long', 
        year: 'numeric' 
    });
    monthYearElement.textContent = monthYearString;

    let datesHTML = '';

    const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();
    const start = (firstDayIndex === 0 ? 6 : firstDayIndex - 1);

    // Hari dari bulan sebelumnya
    for (let i = start; i > 0; i--) {
        datesHTML += `<div class="date inactive">${prevMonthDays - i + 1}</div>`;
    }

    // Hari bulan saat ini
    for (let i = 1; i <= totalDays; i++) {
        const date = new Date(currentYear, currentMonth, i);
        // Tentukan apakah hari ini adalah hari yang dipilih sebelumnya
        const isSelected = selectedDateInput.value === `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
        const activeClass = isSelected ? 'selected' : (date.toDateString() === new Date().toDateString() ? 'active' : '');

        const formattedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
        
        datesHTML += `<div class="date ${activeClass}" data-date="${formattedDate}">${i}</div>`;
    }
    
    // Hari dari bulan berikutnya
    const lastDayIndex = new Date(currentYear, currentMonth + 1, 0).getDay();
    const end = 7 - (lastDayIndex === 0 ? 7 : lastDayIndex);
    for (let i = 1; i <= end; i++) {
        datesHTML += `<div class="date inactive">${i}</div>`;
    }

    dateElement.innerHTML = datesHTML;

    // Tambahkan Event Listener ke semua tanggal
    dateElement.querySelectorAll('.date:not(.inactive)').forEach(dateDiv => {
        dateDiv.addEventListener('click', () => {
            const selectedDate = dateDiv.getAttribute('data-date');
            
            // 1. Update Input Field yang terlihat (misalnya: 15 November 2025)
            dateInput.value = new Date(selectedDate + 'T00:00:00').toLocaleDateString('id-ID', {
                 day: '2-digit', month: 'long', year: 'numeric'
            });
            
            // 2. Update Input tersembunyi (untuk Laravel: YYYY-MM-DD)
            selectedDateInput.value = selectedDate;
            
            // 3. Tutup Popup
            calendarPopup.classList.add('hidden');
            
            // 4. Update style active
            dateElement.querySelector('.selected')?.classList.remove('selected');
            dateDiv.classList.add('selected');
        });
    });
};


// MONTH PICKER: Logika memilih bulan (sama seperti sebelumnya)
function showMonthPicker() {
    mode = 'month';
    // ... (Logika Month Picker) ...
    monthYearElement.classList.remove("no-pointer");
    prevBtn.classList.remove("hidden-icon");
    nextBtn.classList.remove("hidden-icon");
    monthYearElement.textContent = currentDate.getFullYear();
    dateElement.classList.add('hidden');
    daysRow.classList.add('hidden');
    monthGrid.classList.remove('hidden');

    const monthLabels = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
    monthGrid.innerHTML = "";

    monthLabels.forEach((m, index) => {
        const div = document.createElement("div");
        div.textContent = m;
        if (index === currentDate.getMonth()) {
            div.classList.add("month-active");
        }
        div.onclick = () => {
            currentDate.setMonth(index);
            monthGrid.classList.add("hidden");
            dateElement.classList.remove("hidden");
            daysRow.classList.remove("hidden");
            mode = 'date';
            updateCalendar();
        };
        monthGrid.appendChild(div);
    });
}


// YEAR PICKER: Logika memilih tahun (sama seperti sebelumnya)
function showYearPicker() {
    mode = 'year';
    // ... (Logika Year Picker) ...
    monthYearElement.classList.add("no-pointer");
    prevBtn.classList.add("hidden-icon");
    nextBtn.classList.add("hidden-icon");
    const currentYear = currentDate.getFullYear();
    monthYearElement.textContent = currentYear;
    monthGrid.classList.add("hidden");
    dateElement.classList.add("hidden");
    daysRow.classList.add("hidden");
    yearGrid.classList.remove("hidden");
    yearGrid.innerHTML = "";

    const startYear = 2000;
    const endYear = 2050;

    for (let y = startYear; y <= endYear; y++) {
        const div = document.createElement("div");
        div.textContent = y;
        if (y === currentYear) {
            div.classList.add("year-active");
        }
        div.onclick = () => {
            currentDate.setFullYear(y);
            yearGrid.classList.add("hidden");
            showMonthPicker();
        };
        yearGrid.appendChild(div);
    }
    const active = yearGrid.querySelector('.year-active');
    if (active) {
        active.scrollIntoView({ block: 'center' });
    }
}


// 3. Event Listeners (Menghubungkan tombol dan klik)
monthYearElement.onclick = () => {
    if (mode === "date") showMonthPicker();
    else if (mode === "month") showYearPicker();
};

prevBtn.onclick = () => {
    if (mode === 'year') return;
    if (mode === 'month') {
        currentDate.setFullYear(currentDate.getFullYear() - 1);
        showMonthPicker();
    } else {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateCalendar();
    }
};

nextBtn.onclick = () => {
    if (mode === 'year') return;
    if (mode === 'month') {
        currentDate.setFullYear(currentDate.getFullYear() + 1);
        showMonthPicker();
    } else {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateCalendar();
    }
};

// Hubungkan ke ikon kalender dan input
calendarIcon.onclick = toggleCalendar;
dateInput.onclick = toggleCalendar; 

// Tambahan: Sembunyikan kalender jika user klik di luar area
document.addEventListener('click', (event) => {
    const isClickInside = calendarPopup.contains(event.target) || dateInput.contains(event.target) || calendarIcon.contains(event.target);
    
    if (!isClickInside && !calendarPopup.classList.contains('hidden')) {
        calendarPopup.classList.add('hidden');
    }
});

// Panggil pertama kali saat skrip dimuat
updateCalendar();