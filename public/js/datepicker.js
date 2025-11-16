document.querySelectorAll('.datepicker-wrapper').forEach(wrapper => {

    const dateInput = wrapper.querySelector('.datepicker-input');
    const calendarIcon = wrapper.querySelector('.datepicker-icon');
    const calendarPopup = wrapper.querySelector('.datepicker');
    const selectedDateInput = wrapper.querySelector('.datepicker-hidden');

    const monthYearElement = wrapper.querySelector('.datepicker-monthYear');
    const dateElement = wrapper.querySelector('.datepicker-dates');
    const prevBtn = wrapper.querySelector('.datepicker-prevBtn');
    const nextBtn = wrapper.querySelector('.datepicker-nextBtn');
    const daysRow = wrapper.querySelector('.datepicker-days');
    const monthGrid = wrapper.querySelector('.datepicker-month');
    const yearGrid = wrapper.querySelector('.datepicker-year');

    let currentDate = selectedDateInput && selectedDateInput.value
        ? new Date(selectedDateInput.value + 'T00:00:00')
        : new Date();

    let mode = 'date';

    const toggleCalendar = () => {
        calendarPopup.classList.toggle('hidden');
        if (!calendarPopup.classList.contains('hidden')) updateCalendar();
    };

    // Update Calendar
    const updateCalendar = () => {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        monthGrid.classList.add("hidden");
        yearGrid.classList.add("hidden");
        dateElement.classList.remove("hidden");
        daysRow.classList.remove("hidden");

        const firstDayIndex = new Date(year, month, 1).getDay();
        const totalDays = new Date(year, month + 1, 0).getDate();
        const prevMonthDays = new Date(year, month, 0).getDate();

        const monthYearString = currentDate.toLocaleString('id-ID', {
            month: 'long',
            year: 'numeric'
        });
        monthYearElement.textContent = monthYearString;

        let datesHTML = '';
        const start = (firstDayIndex === 0 ? 6 : firstDayIndex - 1);

        // Previous month filler
        for (let i = start; i > 0; i++) {
            datesHTML += `<div class="opacity-30">${prevMonthDays - i + 1}</div>`;
        }

        // Current month
        for (let i = 1; i <= totalDays; i++) {
            const formatted = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            const selected = selectedDateInput.value === formatted
                ? 'bg-blue-500 text-white rounded'
                : '';
            datesHTML += `<div class="cursor-pointer p-1 rounded ${selected}" data-date="${formatted}">${i}</div>`;
        }

        // Next month filler
        const lastDayIndex = new Date(year, month + 1, 0).getDay();
        const end = 7 - (lastDayIndex === 0 ? 7 : lastDayIndex);
        for (let i = 1; i <= end; i++) {
            datesHTML += `<div class="opacity-30">${i}</div>`;
        }

        dateElement.innerHTML = datesHTML;

        // Click date
        dateElement.querySelectorAll('[data-date]').forEach(div => {
            div.addEventListener('click', () => {
                const selected = div.dataset.date;

                dateInput.value = new Date(selected).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });

                selectedDateInput.value = selected;
                calendarPopup.classList.add('hidden');
                updateCalendar();
            });
        });
    };

    // Show Month Picker
    function showMonthPicker() {
        mode = "month";

        dateElement.classList.add("hidden");
        daysRow.classList.add("hidden");
        monthGrid.classList.remove("hidden");

        const months = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        monthGrid.innerHTML = "";

        months.forEach((m, i) => {
            const div = document.createElement("div");
            div.textContent = m;
            div.classList.add("p-1", "cursor-pointer", "rounded");

            if (i === currentDate.getMonth()) div.classList.add("bg-blue-500", "text-white");

            div.onclick = () => {
                currentDate.setMonth(i);
                mode = "date";
                updateCalendar();
            };

            monthGrid.appendChild(div);
        });

        monthYearElement.textContent = currentDate.getFullYear();
    }

    // Show Year Picker
    function showYearPicker() {
        mode = "year";

        monthGrid.classList.add("hidden");
        dateElement.classList.add("hidden");
        daysRow.classList.add("hidden");
        yearGrid.classList.remove("hidden");

        yearGrid.innerHTML = "";

        for (let y = 2000; y <= 2050; y++) {
            const div = document.createElement("div");
            div.textContent = y;
            div.classList.add("p-1", "cursor-pointer", "rounded");

            if (y === currentDate.getFullYear()) div.classList.add("bg-blue-500", "text-white");

            div.onclick = () => {
                currentDate.setFullYear(y);
                showMonthPicker();
            };

            yearGrid.appendChild(div);
        }

        monthYearElement.textContent = currentDate.getFullYear();
    }

    // Event Listeners
    monthYearElement.onclick = () => {
        if (mode === "date") showMonthPicker();
        else if (mode === "month") showYearPicker();
    };

    prevBtn.onclick = () => {
        if (mode === 'date') currentDate.setMonth(currentDate.getMonth() - 1);
        else if (mode === 'month') currentDate.setFullYear(currentDate.getFullYear() - 1);
        updateCalendar();
    };

    nextBtn.onclick = () => {
        if (mode === 'date') currentDate.setMonth(currentDate.getMonth() + 1);
        else if (mode === 'month') currentDate.setFullYear(currentDate.getFullYear() + 1);
        updateCalendar();
    };

    calendarIcon.onclick = toggleCalendar;
    dateInput.onclick = toggleCalendar;

    // Close on click outside
    document.addEventListener('click', e => {
        if (!wrapper.contains(e.target)) calendarPopup.classList.add('hidden');
    });

    // Init
    updateCalendar();
});