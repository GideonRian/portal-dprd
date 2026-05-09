import './bootstrap';

// Logika Filter Pencarian Profil Anggota
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector('.search-input');
    
    if(searchInput) {
        searchInput.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.member-card');
            
            cards.forEach(card => {
                const name = card.querySelector('h3').innerText.toLowerCase();
                const title = card.querySelector('.text-primary-blue').innerText.toLowerCase();
                
                if(name.includes(val) || title.includes(val)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});