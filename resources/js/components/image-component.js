import Alpine from 'alpinejs';

const imageComponent = {
    imageRendering: async function() {
        const toRender = document.querySelectorAll('[data-bg]');

        toRender.forEach(element => {
            element.setAttribute('style', 'background-image: url(' + element.dataset.bg + ');');
        });
    },
    deleteImage: async function(url, updateMessage) {
        let message = '';

        if(confirm('Êtes-vous sûr de vouloir supprimer cette image ?'))
        {
            const response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                }
            });

            if(response.ok)
            {
                const result = await response.json();
                message = result.message;
                updateMessage(message);
                setTimeout(() => location.reload(), 3000);
            }
        }
    },
    carouselRoundWidth: async function() {
        const carousel = document.querySelector('.carousel');

        if(!carousel)
            return;

        const parent = carousel.parentElement;
        const parentComputedStyle = window.getComputedStyle(parent);

        const parentWidth = parseFloat(parentComputedStyle.width);

        const paddingLeft = parseFloat(parentComputedStyle.paddingLeft);
        const paddingRight = parseFloat(parentComputedStyle.paddingRight);

        const widthWithoutPadding = parentWidth - paddingLeft - paddingRight;

        carousel.style.width = Math.round(widthWithoutPadding) + 'px';
    },
    carouselSlide: async function(button) {
        const carousel = document.querySelector('.carousel-images');
        const width = carousel.getBoundingClientRect().width;
        const maxScrollLeft = carousel.scrollWidth - width;

        if(button.dataset.slide === 'previous')
        {
            if(carousel.scrollLeft <= 0)
                carousel.scrollLeft = maxScrollLeft;
            else
                carousel.scrollLeft -= width;
        }
        else if(button.dataset.slide === 'next')
        {
            if(carousel.scrollLeft >= maxScrollLeft)
                carousel.scrollLeft = 0;
            else
                carousel.scrollLeft += width;
        }
    },
    galleryOpen: async function() {
        const modal = document.querySelector('.modal[data-modal=gallery]');
        modal.classList.add('is-active');
    },
    galleryClose: async function() {
        const modal = document.querySelector('.modal[data-modal=gallery]');
        modal.classList.remove('is-active');
    }
};

// Enregistrement du scope Alpine dans le même fichier
Alpine.data('imageHandler', () => ({
    message: '',
    deleteImage(url) {
        imageComponent.deleteImage(url, (message) => {
            this.message = message;
        });
    },
    carouselSlide(event) {
        imageComponent.carouselSlide(event.currentTarget);
    },
    galleryOpen() {
        imageComponent.galleryOpen();
    },
    galleryClose() {
        imageComponent.galleryClose();
    }
}));

export default imageComponent;

imageComponent.imageRendering();
imageComponent.carouselRoundWidth();

window.addEventListener('resize', () => {
    imageComponent.carouselRoundWidth();
});