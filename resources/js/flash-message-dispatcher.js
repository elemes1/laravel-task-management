const flashMessageDispatcher = {
    dispatchFlashMessage(message, type = 'success') {
        window.dispatchEvent(new CustomEvent('flash', {
            detail: { message, type }
        }));
    }
};

export default flashMessageDispatcher;
