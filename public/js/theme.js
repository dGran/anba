// theme selector
var themeToggleIcon = document.getElementById('theme-toggle-icon');
var themeToggleBtn = document.getElementById('theme-toggle');

getTheme();

themeToggleBtn.addEventListener('click', function() {
    if (localStorage.getItem('color-theme') === 'light') {
        setTheme('dark');
        localStorage.setItem('color-theme', 'dark');
    } else if (localStorage.getItem('color-theme') === 'dark') {
        setTheme('device');
        localStorage.setItem('color-theme', 'device');
    } else if (localStorage.getItem('color-theme') === 'device') {
        setTheme('light');
        localStorage.setItem('color-theme', 'light');
    }
});

function getTheme() {
    if ('color-theme' in localStorage) {
        switch (localStorage.getItem('color-theme')) {
            case 'dark':
                setTheme('dark');
                break;
            case 'light':
                setTheme('light');
                break;
            case 'device':
                setTheme('device');
                break;
        }
    } else {
        localStorage.setItem('color-theme', 'device');
        setTheme('device');
    }
}

function setTheme(mode) {
    switch (mode) {
        case 'dark':
            themeToggleIcon.classList = 'fa-solid';
            themeToggleIcon.classList.add('fa-moon');
            if (!document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.add('dark');
            }
            break;
        case 'light':
            themeToggleIcon.classList = 'fa-solid';
            themeToggleIcon.classList.add('fa-sun');
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
            }
            break;
        case 'device':
            themeToggleIcon.classList = 'fa-solid';
            themeToggleIcon.classList.add('fa-circle-half-stroke');
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                if (!document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.add('dark');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                }
            }
            break;
    }
}
// END: theme selector