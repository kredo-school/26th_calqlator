'use strict';
{
    const dts = document.querySelectorAll('dt'); //dtを全て取得

    dts.forEach(dt => {
        dt.addEventListener('click', () => {
            dt.parentNode.classList.toggle('appear');
        });
    });
}