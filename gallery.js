document.addEventListener('DOMContentLoaded', () => {
    // Create lightbox elements
    const lightbox = document.createElement('div');
    lightbox.className = 'lightbox';
    
    const lightboxImg = document.createElement('img');
    lightboxImg.alt = 'Travel Angola Gallery Image';
    lightbox.appendChild(lightboxImg);
    
    const closeButton = document.createElement('button');
    closeButton.className = 'lightbox-close';
    closeButton.innerHTML = '×';
    closeButton.setAttribute('aria-label', 'Close gallery image');
    lightbox.appendChild(closeButton);
    
    // Add image counter
    const imageCounter = document.createElement('div');
    imageCounter.className = 'image-counter';
    imageCounter.style.cssText = `
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        background: rgba(0, 0, 0, 0.7);
        padding: 10px 20px;
        border-radius: 20px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
    `;
    lightbox.appendChild(imageCounter);
    
    document.body.appendChild(lightbox);

    // Get all gallery items
    const galleryItems = document.querySelectorAll('.gallery-item');
    let currentImageIndex = 0;

    // Add click events to gallery items
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            const imgSrc = item.querySelector('img').src;
            const imgAlt = item.querySelector('img').alt;
            lightboxImg.src = imgSrc;
            lightboxImg.alt = imgAlt;
            currentImageIndex = index;
            updateImageCounter();
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        });
    });

    // Update image counter
    function updateImageCounter() {
        imageCounter.textContent = `${currentImageIndex + 1} / ${galleryItems.length}`;
    }

    // Navigation functions
    function showNextImage() {
        currentImageIndex = (currentImageIndex + 1) % galleryItems.length;
        const imgSrc = galleryItems[currentImageIndex].querySelector('img').src;
        const imgAlt = galleryItems[currentImageIndex].querySelector('img').alt;
        lightboxImg.src = imgSrc;
        lightboxImg.alt = imgAlt;
        updateImageCounter();
    }

    function showPreviousImage() {
        currentImageIndex = (currentImageIndex - 1 + galleryItems.length) % galleryItems.length;
        const imgSrc = galleryItems[currentImageIndex].querySelector('img').src;
        const imgAlt = galleryItems[currentImageIndex].querySelector('img').alt;
        lightboxImg.src = imgSrc;
        lightboxImg.alt = imgAlt;
        updateImageCounter();
    }

    // Close lightbox function
    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = 'auto'; // Restore scrolling
    }

    // Close lightbox when clicking close button
    closeButton.addEventListener('click', closeLightbox);

    // Close lightbox when clicking outside the image
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (lightbox.classList.contains('active')) {
            switch(e.key) {
                case 'Escape':
                    closeLightbox();
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    showNextImage();
                    break;
                case 'ArrowLeft':
                    e.preventDefault();
                    showPreviousImage();
                    break;
            }
        }
    });

    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    lightbox.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });

    lightbox.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe left - next image
                showNextImage();
            } else {
                // Swipe right - previous image
                showPreviousImage();
            }
        }
    }

    // Add navigation arrows for desktop
    const prevArrow = document.createElement('button');
    prevArrow.innerHTML = '‹';
    prevArrow.className = 'nav-arrow nav-arrow-prev';
    prevArrow.style.cssText = `
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        font-size: 2rem;
        padding: 15px 20px;
        cursor: pointer;
        border-radius: 50%;
        transition: background 0.3s ease;
    `;
    prevArrow.addEventListener('click', (e) => {
        e.stopPropagation();
        showPreviousImage();
    });
    prevArrow.addEventListener('mouseenter', () => {
        prevArrow.style.background = 'rgba(212, 175, 55, 0.8)';
    });
    prevArrow.addEventListener('mouseleave', () => {
        prevArrow.style.background = 'rgba(0, 0, 0, 0.7)';
    });

    const nextArrow = document.createElement('button');
    nextArrow.innerHTML = '›';
    nextArrow.className = 'nav-arrow nav-arrow-next';
    nextArrow.style.cssText = `
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        font-size: 2rem;
        padding: 15px 20px;
        cursor: pointer;
        border-radius: 50%;
        transition: background 0.3s ease;
    `;
    nextArrow.addEventListener('click', (e) => {
        e.stopPropagation();
        showNextImage();
    });
    nextArrow.addEventListener('mouseenter', () => {
        nextArrow.style.background = 'rgba(212, 175, 55, 0.8)';
    });
    nextArrow.addEventListener('mouseleave', () => {
        nextArrow.style.background = 'rgba(0, 0, 0, 0.7)';
    });

    lightbox.appendChild(prevArrow);
    lightbox.appendChild(nextArrow);

    // Hide arrows on mobile
    function handleResize() {
        if (window.innerWidth <= 768) {
            prevArrow.style.display = 'none';
            nextArrow.style.display = 'none';
        } else {
            prevArrow.style.display = 'block';
            nextArrow.style.display = 'block';
        }
    }

    window.addEventListener('resize', handleResize);
    handleResize(); // Initial call
});