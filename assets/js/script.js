// Navigation scroll effect
window.addEventListener('scroll', function() {
  const header = document.querySelector('.header');
  if (window.scrollY > 50) {
      header.style.background = '#fff';
      header.style.boxShadow = '0 2px 15px rgba(0,0,0,0.1)';
  } else {
      header.style.background = 'transparent';
      header.style.boxShadow = 'none';
  }
});

// Form validation
document.addEventListener('DOMContentLoaded', function() {
  const forms = document.querySelectorAll('form');
  
  forms.forEach(form => {
      form.addEventListener('submit', function(e) {
          e.preventDefault();
          
          const requiredFields = form.querySelectorAll('[required]');
          let isValid = true;
          
          requiredFields.forEach(field => {
              if (!field.value.trim()) {
                  isValid = false;
                  field.classList.add('error');
                  
                  // Add error message
                  const errorMessage = document.createElement('span');
                  errorMessage.classList.add('error-message');
                  errorMessage.textContent = 'This field is required';
                  
                  if (!field.nextElementSibling?.classList.contains('error-message')) {
                      field.parentNode.insertBefore(errorMessage, field.nextSibling);
                  }
              } else {
                  field.classList.remove('error');
                  const errorMessage = field.nextElementSibling;
                  if (errorMessage?.classList.contains('error-message')) {
                      errorMessage.remove();
                  }
              }
          });
          
          if (isValid) {
              // Submit form
              form.submit();
          }
      });
  });
});

// News card hover effect
const newsCards = document.querySelectorAll('.news-card');
newsCards.forEach(card => {
  card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-10px)';
  });
  
  card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
  });
});

// Modal functionality
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  modal.style.display = 'none';
  document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
window.addEventListener('click', function(e) {
  const modals = document.querySelectorAll('.modal');
  modals.forEach(modal => {
      if (e.target === modal) {
          modal.style.display = 'none';
          document.body.style.overflow = 'auto';
      }
  });
});

// Dynamic loading for news feed
let page = 1;
const loadMoreBtn = document.querySelector('.load-more');

if (loadMoreBtn) {
  loadMoreBtn.addEventListener('click', function() {
      page++;
      fetch(`/api/news?page=${page}`)
          .then(response => response.json())
          .then(data => {
              const newsGrid = document.querySelector('.news-grid');
              data.forEach(news => {
                  const newsCard = createNewsCard(news);
                  newsGrid.appendChild(newsCard);
              });
              
              if (data.length < 6) { // Assuming 6 items per page
                  loadMoreBtn.style.display = 'none';
              }
          });
  });
}

function createNewsCard(news) {
  const card = document.createElement('div');
  card.classList.add('news-card');
  card.innerHTML = `
      <img src="${news.image}" alt="${news.title}" class="news-image">
      <div class="news-content">
          <div class="news-category">${news.category}</div>
          <h3 class="news-title">${news.title}</h3>
          <p class="news-preview">${news.preview}</p>
          <a href="/news/${news.id}" class="btn btn-primary">Read More</a>
      </div>
  `;
  return card;
}