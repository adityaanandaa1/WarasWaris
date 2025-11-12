const datePicker = flatpickr("#myDate", {
    dateFormat: "d F Y",
    defaultDate: "today",
    locale: {
        firstDayOfWeek: 1,
        weekdays: {
            shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
            longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        },
        months: {
            shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        },
    }
});

const pickerContainer = document.querySelector(".date-picker");
const input = document.querySelector("#myDate");

pickerContainer.addEventListener("click", (e) => {
    if (e.target === input) return;  

    if (datePicker.isOpen) {
        datePicker.close();
    } else {
        datePicker.open();
        input.focus();
    }
});