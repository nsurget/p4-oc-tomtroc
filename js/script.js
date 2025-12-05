import ProfilPhoto from './src/ProfilPhoto.js';

document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.user-profile')) {
        new ProfilPhoto();
    }
});
