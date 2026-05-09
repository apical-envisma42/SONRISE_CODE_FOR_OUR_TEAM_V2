function searchUsers() {
    const searchInput = document.getElementById('userSearch');
    const tableBody = document.getElementById('userTableBody');
    
    if (!searchInput || !tableBody) return;

    const input = searchInput.value.toLowerCase().trim();
    const rows = tableBody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        
        if (cells && cells.length >= 7) {
            

            const id       = cells[0].textContent ? cells[0].textContent.toLowerCase() : "";
            const provider = cells[1].textContent ? cells[1].textContent.toLowerCase() : "";
            const name     = cells[2].textContent ? cells[2].textContent.toLowerCase() : "";
            const email    = cells[3].textContent ? cells[3].textContent.toLowerCase() : "";
            const date     = cells[4].textContent ? cells[4].textContent.toLowerCase() : "";
            const status   = cells[5].textContent ? cells[5].textContent.toLowerCase() : "";
            const level    = cells[6].textContent ? cells[6].textContent.toLowerCase() : "";
            
            const matches = id.includes(input) ||
                            name.includes(input) || 
                            email.includes(input) || 
                            provider.includes(input) || 
                            date.includes(input) || 
                            status.includes(input) || 
                            level.includes(input);

            rows[i].style.display = matches ? "" : "none";
        }
    }
}