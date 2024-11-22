'use strict';

console.clear();
{
document.addEventListener('DOMContentLoaded', function() {
    const headers = document.querySelectorAll('#admin-table th.sortable');
    let currentSortColumn = null;
    let currentSortDirection = 'asc';

    function resetSortingArrows() {
        headers.forEach(header => {
            const arrows = header.querySelectorAll('.sort-arrow i');
            arrows.forEach(arrow => {
                arrow.classList.remove('fa-sort-asc', 'fa-sort-desc'); 
                arrow.classList.add('fa-sort');
            });
        });
    }

    function addSortArrow(column, direction) {
        const arrow = column.querySelector('.sort-arrow i');
        if (direction === 'asc') {
            arrow.classList.remove('fa-sort', 'fa-sort-desc');
            arrow.classList.add('fa-sort-asc');
        } else {
            arrow.classList.remove('fa-sort', 'fa-sort-asc');
            arrow.classList.add('fa-sort-desc');
        }
    }

    function splitAmount(amount) {
        const match = amount.match(/^(\d+(\.\d+)?)\s*(\D.*)?$/);  
        if (match) {
            const numericPart = parseFloat(match[1]); 
            const textPart = match[3] ? match[3].trim() : '';    
            return { numericPart, textPart };
        }
        return { numericPart: NaN, textPart: amount.trim() };
    }

    function sortTableByColumn(columnIndex) {
        const table = document.getElementById('admin-table');
        const rows = Array.from(table.querySelectorAll('tbody tr'));

        rows.sort((rowA, rowB) => {
            const cellA = rowA.cells[columnIndex]?.textContent.trim();
            const cellB = rowB.cells[columnIndex]?.textContent.trim();

            if (cellA === undefined || cellB === undefined) {
                return 0; 
            }

            if (columnIndex === 3) { 
                const { numericPart: numA, textPart: textA } = splitAmount(cellA);
                const { numericPart: numB, textPart: textB } = splitAmount(cellB);

                if (numA !== numB) {
                    return currentSortDirection === 'asc' ? numB - numA : numA - numB;
                }

                return currentSortDirection === 'asc'
                    ? textB.localeCompare(textA) 
                    : textA.localeCompare(textB);  
            }

            const isNumericColumn = columnIndex === 0 || columnIndex === 2;

           if (isNumericColumn) {
                return currentSortDirection === 'asc'
                    ? parseFloat(cellA) - parseFloat(cellB)
                    : parseFloat(cellB) - parseFloat(cellA);
            } else {
                return currentSortDirection === 'asc'
                    ? cellA.localeCompare(cellB)
                    : cellB.localeCompare(cellA);
            }
        });

        rows.forEach(row => table.querySelector('tbody').appendChild(row)); 

        addSortArrow(headers[columnIndex], currentSortDirection); 
    }

    headers.forEach((header, index) => {
        header.addEventListener('click', function () {
            resetSortingArrows();
            if (currentSortColumn === index) {
                currentSortDirection = currentSortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                currentSortColumn = index;
                currentSortDirection = 'asc'; 
            }
            sortTableByColumn(index);
        });
    });
});

}