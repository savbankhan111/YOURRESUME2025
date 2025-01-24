
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('mini-sidebar');
        
        var isMiniSidebar = sidebar.classList.contains('mini-sidebar');
        var togglerIcon = document.querySelector('.sidebartoggler i');
        if (isMiniSidebar) {
            togglerIcon.classList.remove('mdi-menu');
            togglerIcon.classList.add('mdi-menu-open');
        } else {
            togglerIcon.classList.remove('mdi-menu-open');
            togglerIcon.classList.add('mdi-menu');
        }
    }
