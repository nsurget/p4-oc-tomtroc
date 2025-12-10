export default class AutoScrollDiscussion {
    constructor() {
        this.init();
    }

    init() {
        const messagesContainer = document.querySelector('section.discussion .messages-container');

        messagesContainer.scrollTop = messagesContainer.scrollHeight + 100;
        console.log(messagesContainer.scrollHeight);
        
    }
}
    