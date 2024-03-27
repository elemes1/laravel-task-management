import taskUtility from './task-utility.js';

function taskModal() {
    return {
        show: false,
        taskName: '',
        taskDescription: '',
        boardName: '',

        init() {
            // Any initialization logic can go here
        },

        openModal(board = '') {
            this.boardName = board;
            this.show = true;
            this.taskName = '';
            this.taskDescription = '';
            this.focusInput();
        },

        focusInput() {
            setTimeout(() => {
                this.$refs.taskNameInput.focus();
            }, 300);
        },

        addTask() {
            if (!this.taskName) {
                return; // Task name is required
            }

            const taskData = {
                uuid: taskUtility.generateUUID(),
                name: this.taskName,
                description: this.taskDescription,
                boardName: this.boardName,
                date: new Date(),
                status: 'pending', // or any default status
            };

            taskUtility.saveDataToLocalStorage(taskData);
            this.show = false;
            taskUtility.dispatchCustomEvents('taskAdded', 'New task added');
        },

    };
}
