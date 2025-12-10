import ProfilPhoto from './src/ProfilPhoto.js';
import AutoScrollDiscussion from './src/AutoScrollDiscussion.js';

document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.user-profile')) {
        new ProfilPhoto();
    }

    if (document.querySelector('section.discussion .messages-container .messages')){
        new AutoScrollDiscussion();
    }
});
