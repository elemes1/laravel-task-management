const taskUtility = {
    generateUUID() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            const r = Math.random() * 16 | 0, v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    },

    saveDataToLocalStorage(key, data) {
        const existingData = JSON.parse(localStorage.getItem(key)) || [];
        existingData.push(data);
        localStorage.setItem(key, JSON.stringify(existingData));
    },

    getDataFromLocalStorage(key) {
        return JSON.parse(localStorage.getItem(key)) || [];
    },

    updateDataInLocalStorage(key, updateCallback) {
        const data = JSON.parse(localStorage.getItem(key)) || [];
        const updatedData = data.map(item => updateCallback(item));
        localStorage.setItem(key, JSON.stringify(updatedData));
    },

    dispatchCustomEvents(eventName, message) {
        const event = new CustomEvent(eventName, { detail: { message: message } });
        window.dispatchEvent(event);
    },

    formatDateDisplay(date, format = 'toDateString') {
        if (format === 'toDateString') return new Date(date).toDateString();
        if (format === 'toLocaleDateString') return new Date(date).toLocaleDateString('en-GB');
        return new Date(date).toLocaleDateString('en-GB');
    }
};

export default taskUtility;
