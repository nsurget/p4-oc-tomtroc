import ProfilPhoto from './src/ProfilPhoto.js';
import AutoScrollDiscussion from './src/AutoScrollDiscussion.js';

document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.user-profil') || document.querySelector('.book-form')) {
        new ProfilPhoto();
    }

    if (document.querySelector('section.discussion .messages-container .messages')){
        new AutoScrollDiscussion();
    }
});
