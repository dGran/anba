// theme selector
const darkMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
try {
    // Chrome & Firefox
    darkMediaQuery.addEventListener('change', (e) => {
        getThemeP();
    });
} catch (e1) {
    try {
        // Safari
        darkMediaQuery.addListener((e) => {
            getThemeP();
        });
    } catch (e2) {
        console.error(e2);
    }
}

getThemeP();

function getThemeP() {
    if ('color-theme' in localStorage) {
        switch (localStorage.getItem('color-theme')) {
            case 'dark':
                setThemeP('dark');
                break;
            case 'light':
                setThemeP('light');
                break;
            case 'device':
                setThemeP('device');
                break;
        }
    } else {
        localStorage.setItem('color-theme', 'device');
        setThemeP('device');
    }
}

function setThemeP(mode) {
    switch (mode) {
        case 'dark':
            if (!document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.add('dark');
            }
            break;
        case 'light':
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
            }
            break;
        case 'device':
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