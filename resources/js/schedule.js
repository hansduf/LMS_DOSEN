// File: schedule.js
// Fungsi untuk mengelola halaman jadwal

document.addEventListener('DOMContentLoaded', function() {
    // Toggle calendar dropdown
    const dateDropdown = document.getElementById('dateDropdown');
    const calendarDropdown = document.getElementById('calendarDropdown');
    
    dateDropdown.addEventListener('click', function() {
        calendarDropdown.classList.toggle('hidden');
        // Di sini Anda bisa menambahkan kode untuk membuat kalender
        renderCalendar();
    });
    
    // Toggle view (Weekly/Monthly)
    const weeklyBtn = document.getElementById('weeklyBtn');
    const monthlyBtn = document.getElementById('monthlyBtn');
    
    weeklyBtn.addEventListener('click', function() {
        weeklyBtn.classList.add('bg-[#5EBAB4]');
        weeklyBtn.classList.remove('bg-[#12131A]');
        monthlyBtn.classList.add('bg-[#12131A]');
        monthlyBtn.classList.remove('bg-[#5EBAB4]');
        // Logika untuk menampilkan view mingguan
        setWeeklyView();
    });
    
    monthlyBtn.addEventListener('click', function() {
        monthlyBtn.classList.add('bg-[#5EBAB4]');
        monthlyBtn.classList.remove('bg-[#12131A]');
        weeklyBtn.classList.add('bg-[#12131A]');
        weeklyBtn.classList.remove('bg-[#5EBAB4]');
        // Logika untuk menampilkan view bulanan
        setMonthlyView();
    });
    
    // Search functionality
    const searchInput = document.getElementById('scheduleSearch');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const sections = document.querySelectorAll('.schedule-container > div');
        
        sections.forEach(section => {
            const sectionTitle = section.querySelector('h3').textContent.toLowerCase();
            const cards = section.querySelectorAll('.schedule-card');
            let hasMatch = false;
            
            if (sectionTitle.includes(searchTerm)) {
                hasMatch = true;
            } else {
                cards.forEach(card => {
                    const cardTitle = card.querySelector('h4').textContent.toLowerCase();
                    const location = card.querySelector('.bg-[#2B2C32]').textContent.toLowerCase();
                    
                    if (cardTitle.includes(searchTerm) || location.includes(searchTerm)) {
                        hasMatch = true;
                    }
                });
            }
            
            section.style.display = hasMatch ? 'block' : 'none';
        });
    });
    
    // Create new schedule button
    const createScheduleBtn = document.getElementById('createScheduleBtn');
    
    createScheduleBtn.addEventListener('click', function() {
        // Logika untuk membuka form pembuatan jadwal baru
        showCreateScheduleForm();
    });
    
    // Fungsi untuk render kalender
    function renderCalendar() {
        // Contoh sederhana untuk kalender
        const calendar = document.createElement('div');
        calendar.innerHTML = `
            <div class="calendar-header flex justify-between mb-2">
                <button class="text-gray-400 hover:text-white"><i class="bi bi-chevron-left"></i></button>
                <span>December 2025</span>
                <button class="text-gray-400 hover:text-white"><i class="bi bi-chevron-right"></i></button>
            </div>
            <div class="grid grid-cols-7 gap-1 text-center">
                <div class="text-xs text-gray-400">Su</div>
                <div class="text-xs text-gray-400">Mo</div>
                <div class="text-xs text-gray-400">Tu</div>
                <div class="text-xs text-gray-400">We</div>
                <div class="text-xs text-gray-400">Th</div>
                <div class="text-xs text-gray-400">Fr</div>
                <div class="text-xs text-gray-400">Sa</div>
                
                <div class="text-xs py-1">1</div>
                <div class="text-xs py-1">2</div>
                <div class="text-xs py-1">3</div>
                <div class="text-xs py-1">4</div>
                <div class="text-xs py-1">5</div>
                <div class="text-xs py-1">6</div>
                <div class="text-xs py-1">7</div>
                
                <div class="text-xs py-1">8</div>
                <div class="text-xs py-1">9</div>
                <div class="text-xs py-1">10</div>
                <div class="text-xs py-1">11</div>
                <div class="text-xs py-1">12</div>
                <div class="text-xs py-1">13</div>
                <div class="text-xs py-1">14</div>
                
                <div class="text-xs py-1">15</div>
                <div class="text-xs py-1">16</div>
                <div class="text-xs py-1">17</div>
                <div class="text-xs py-1">18</div>
                <div class="text-xs py-1">19</div>
                <div class="text-xs py-1">20</div>
                <div class="text-xs py-1">21</div>
                
                <div class="text-xs py-1 bg-[#5EBAB4] rounded-full">22</div>
                <div class="text-xs py-1">23</div>
                <div class="text-xs py-1">24</div>
                <div class="text-xs py-1">25</div>
                <div class="text-xs py-1">26</div>
                <div class="text-xs py-1">27</div>
                <div class="text-xs py-1">28</div>
                
                <div class="text-xs py-1">29</div>
                <div class="text-xs py-1">30</div>
                <div class="text-xs py-1">31</div>
                <div class="text-xs py-1 text-gray-600">1</div>
                <div class="text-xs py-1 text-gray-600">2</div>
                <div class="text-xs py-1 text-gray-600">3</div>
                <div class="text-xs py-1 text-gray-600">4</div>
            </div>
        `;
        
        calendarDropdown.innerHTML = '';
        calendarDropdown.appendChild(calendar);
        
        // Tambahkan event listener untuk tanggal
        const dateCells = calendar.querySelectorAll('.grid-cols-7 > div:not(.text-gray-400)');
        dateCells.forEach(cell => {
            cell.addEventListener('click', function() {
                const day = this.textContent;
                document.getElementById('selectedDate').textContent = `${day} Dec, 2025`;
                calendarDropdown.classList.add('hidden');
                updateActiveDay(day);
            });
        });
    }
    
    // Fungsi untuk mengatur tampilan mingguan
    function setWeeklyView() {
        const dayItems = document.querySelectorAll('.day-item');
        dayItems.forEach((item, index) => {
            if (index < 7) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
        
        // Update scrollbar untuk tampilan mingguan
        updateScrollbarThumb(7);
    }
    
    // Fungsi untuk mengatur tampilan bulanan
    function setMonthlyView() {
        const dayItems = document.querySelectorAll('.day-item');
        dayItems.forEach(item => {
            item.style.display = 'flex';
        });
        
        // Update scrollbar untuk tampilan bulanan
        updateScrollbarThumb(dayItems.length);
    }
    
    // Fungsi untuk menampilkan form pembuatan jadwal baru
    function showCreateScheduleForm() {
        // Implementasi form pembuatan jadwal baru
        alert('Form pembuatan jadwal baru akan ditampilkan di sini');
    }
    
    // Fungsi untuk mengupdate hari yang aktif
    function updateActiveDay(day) {
        const dayItems = document.querySelectorAll('.day-item');
        dayItems.forEach(item => {
            const dayNumber = item.querySelector('div').textContent;
            if (dayNumber === day) {
                item.classList.add('active');
                item.querySelector('div').classList.add('bg-[#5EBAB4]', 'rounded-lg');
            } else {
                item.classList.remove('active');
                item.querySelector('div').classList.remove('bg-[#5EBAB4]', 'rounded-lg');
            }
        });
    }
    
    // Fungsi untuk mengupdate scrollbar thumb
    function updateScrollbarThumb(totalDays) {
        const scrollbarThumb = document.getElementById('scrollbar-thumb');
        const visibleDays = Math.min(7, totalDays);
        const thumbWidth = (visibleDays / totalDays) * 100;
        
        scrollbarThumb.style.width = `${thumbWidth}%`;
    }
    
    // Inisialisasi scrollbar untuk tampilan horizontal
    initializeHorizontalScrollbar();
    
    // Fungsi untuk menginisialisasi scrollbar horizontal
    function initializeHorizontalScrollbar() {
        const daysContainer = document.querySelector('.days-container');
        const scrollbarThumb = document.getElementById('scrollbar-thumb');
        const totalWidth = daysContainer.scrollWidth;
        const visibleWidth = daysContainer.clientWidth;
        
        // Hanya tampilkan scrollbar jika konten melebihi container
        if (totalWidth > visibleWidth) {
            const thumbWidth = (visibleWidth / totalWidth) * 100;
            scrollbarThumb.style.width = `${thumbWidth}%`;
            
            daysContainer.addEventListener('scroll', function() {
                const scrollPercentage = (this.scrollLeft / (totalWidth - visibleWidth)) * 100;
                const maxTranslate = 100 - parseFloat(scrollbarThumb.style.width);
                scrollbarThumb.style.transform = `translateX(${scrollPercentage * maxTranslate / 100}%)`;
            });
        }
        
        // Inisialisasi scrollbar untuk setiap baris jadwal
        initializeScheduleRowsScrollbar();
    }
    
    // Fungsi untuk menginisialisasi scrollbar pada baris jadwal
    function initializeScheduleRowsScrollbar() {
        const scheduleRows = document.querySelectorAll('.schedule-row');
        
        scheduleRows.forEach(row => {
            // Sinkronisasi scroll antar baris
            row.addEventListener('scroll', function() {
                const scrollLeft = this.scrollLeft;
                
                scheduleRows.forEach(otherRow => {
                    if (otherRow !== this) {
                        otherRow.scrollLeft = scrollLeft;
                    }
                });
            });
        });
    }
    
    // Event listener untuk tombol tanggal
    const dayButtons = document.querySelectorAll('.day-item');
    dayButtons.forEach(button => {
        button.addEventListener('click', function() {
            const day = this.querySelector('div').textContent;
            document.getElementById('selectedDate').textContent = `${day} Dec, 2025`;
            updateActiveDay(day);
            
            // Tampilkan jadwal untuk tanggal yang dipilih
            // Implementasi logika untuk menampilkan jadwal berdasarkan tanggal
        });
    });
});