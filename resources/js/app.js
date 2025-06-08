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
    
    adjustSidebar();
    window.addEventListener('resize', adjustSidebar);
    
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