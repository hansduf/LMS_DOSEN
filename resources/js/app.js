import './bootstrap';
import './dashboard';
import './schedule';




document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const layoutToggle = document.querySelector('.layout-toggle');
    const sidebar = document.querySelector('aside');
    const navbar = document.querySelector('nav');
    
    // Fungsi untuk menyesuaikan sidebar berdasarkan ukuran layar
    function adjustSidebar() {
        if (window.innerWidth >= 640) {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('w-[70px]');
            sidebar.classList.remove('w-[200px]');
            
            const menuTexts = document.querySelectorAll('aside span');
            menuTexts.forEach(text => {
                text.style.opacity = '0';
                text.classList.add('hidden');
            });
        } else {
            sidebar.classList.add('w-[70px]');
            sidebar.classList.remove('w-[200px]');
            sidebar.classList.add('-translate-x-full');
            
            const menuTexts = document.querySelectorAll('aside span');
            menuTexts.forEach(text => {
                text.style.opacity = '0';
                text.classList.add('hidden');
            });
        }
    }
    
    // Fungsi untuk menandai halaman aktif
    function setActivePage() {
        const currentPath = window.location.pathname;
        const menuItems = document.querySelectorAll('aside a');
        
        menuItems.forEach(item => {
            // Reset semua item ke state default
            item.classList.remove('bg-[#2B2C32]');
            item.classList.remove('scale-110');
            item.classList.remove('active');
            
            const icon = item.querySelector('i');
            if (icon) {
                icon.classList.remove('text-[#5EBAB4]');
                icon.style.textShadow = 'none';
            }

            // Dapatkan href dari item
            const href = item.getAttribute('href');
            
            // Periksa apakah current path cocok dengan href
            if (href) {
                // Ekstrak nama route dari href
                const routeName = href.split('/').pop();
                const currentRoute = currentPath.split('/').pop();
                
                // Jika route name cocok atau path sama persis
                if (routeName === currentRoute || href === currentPath) {
                    // Tambahkan class active
                    item.classList.add('bg-[#2B2C32]');
                    item.classList.add('scale-110');
                    item.classList.add('active');
                    
                    // Tambahkan efek glow pada icon
                    if (icon) {
                        icon.classList.add('text-[#5EBAB4]');
                        icon.style.textShadow = '0 0 10px rgba(94, 186, 180, 0.5)';
                    }
                }
            }
        });
    }
    
    // Fungsi untuk menambahkan efek hover
    function addHoverEffects() {
        const menuItems = document.querySelectorAll('aside a');
        
        menuItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active')) {
                    this.style.transform = 'scale(1.1)';
                    this.style.transition = 'all 0.3s ease';
                    
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.style.color = '#5EBAB4';
                        icon.style.transition = 'all 0.3s ease';
                    }
                }
            });
            
            item.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.style.transform = 'scale(1)';
                    
                    const icon = this.querySelector('i');
                    if (icon) {
                        icon.style.color = '#EBEBEB';
                    }
                }
            });
        });
    }
    
    adjustSidebar();
    setActivePage();
    addHoverEffects();
    window.addEventListener('resize', adjustSidebar);
    
    // Tambahkan event listener untuk perubahan URL
    window.addEventListener('popstate', setActivePage);
    
    // Tambahkan event listener untuk setiap link di sidebar
    document.querySelectorAll('aside a').forEach(link => {
        link.addEventListener('click', () => {
            setTimeout(setActivePage, 100); // Tunggu sebentar untuk memastikan URL sudah berubah
        });
    });
    
    // Hamburger button toggle
    sidebarToggle.addEventListener('click', () => {
        if (window.innerWidth >= 640) {
            sidebar.classList.toggle('-translate-x-full');
        } else {
            sidebar.classList.toggle('-translate-x-full');
        }
    });

    // Layout sidebar button toggle
    layoutToggle.addEventListener('click', () => {
        if (window.innerWidth >= 640) {
            const isCollapsed = sidebar.classList.contains('w-[70px]');
            
            // Update sidebar width
            sidebar.classList.toggle('w-[70px]');
            sidebar.classList.toggle('w-[200px]');
            
            // Update text visibility
            const menuTexts = document.querySelectorAll('aside span');
            menuTexts.forEach(text => {
                if (isCollapsed) {
                    text.classList.remove('hidden');
                    setTimeout(() => {
                        text.style.opacity = '1';
                    }, 50);
                } else {
                    text.style.opacity = '0';
                    setTimeout(() => {
                        text.classList.add('hidden');
                    }, 300);
                }
            });

            // Update navbar position
            navbar.style.transition = 'left 300ms ease-in-out';
            if (isCollapsed) {
                navbar.classList.remove('sm:left-[100px]');
                navbar.classList.add('sm:left-[210px]');
            } else {
                navbar.classList.remove('sm:left-[210px]');
                navbar.classList.add('sm:left-[100px]');
            }
            
            // Update main content position
            const mainContent = document.querySelector('main');
            mainContent.style.transition = 'margin-left 300ms ease-in-out';
            if (isCollapsed) {
                mainContent.classList.remove('sm:ml-[90px]');
                mainContent.classList.add('sm:ml-[200px]');
            } else {
                mainContent.classList.remove('sm:ml-[200px]');
                mainContent.classList.add('sm:ml-[90px]');
            }
        }
    });
});