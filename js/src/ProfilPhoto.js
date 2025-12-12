export default class ProfilPhoto {
    constructor() {
        this.init();
    }

    init() {
        let editPictureButton = document.querySelector('.edit-picture-button');
        let editPictureForm = document.querySelector('.edit-picture-form');

        editPictureButton.addEventListener('click', () => {
            editPictureForm.classList.toggle('hidden');
        });

        let profilPicture = document.querySelector('#profil-picture');
        let profilUrl = document.querySelector('#profil-url');

        let uploadPicture = document.querySelector('.upload-picture');
        let urlPicture = document.querySelector('.url-picture');

        
        

        profilPicture.addEventListener('change', () => {
            if (profilPicture.value === '') {
                urlPicture.style.display = 'block';
            } else {
                urlPicture.style.display = 'none';
            }
        });

        profilUrl.addEventListener('input', () => {
            if (profilUrl.value === '') {
                uploadPicture.style.display = 'block';
            } else {
                uploadPicture.style.display = 'none';
            }
        });
    }
}
    