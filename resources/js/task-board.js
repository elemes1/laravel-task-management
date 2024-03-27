import taskUtility from './task-utility.js';

export default  function taskBoard() {
    return {
        boards: ['Todo', 'In Progress', 'Review', 'Done'],
        tasks: [],

        init() {
            this.getTasks();
        },

        getTasks() {
            this.tasks = taskUtility.getDataFromLocalStorage('TG-tasks').map(t => ({
                id: t.id,
                uuid: t.uuid,
                name: t.name,
                status: t.status,
                boardName: t.boardName,
                date: t.date,
                edit: false
            }));
        },

        onDragStart(event, uuid) {
            event.dataTransfer.setData('text/plain', uuid);
            event.target.classList.add('opacity-5');
        },

        onDragOver(event) {
            event.preventDefault();
        },

        onDragEnter(event) {
            event.target.classList.add('bg-gray-200');
        },

        onDragLeave(event) {
            event.target.classList.remove('bg-gray-200');
        },

        onDrop(event, boardName) {
            event.stopPropagation();
            event.preventDefault();
            event.target.classList.remove('bg-gray-200');

            const id = event.dataTransfer.getData('text');
            const draggableElement = document.getElementById(id);
            const dropzone = event.target;
            dropzone.appendChild(draggableElement);

            taskUtility.updateDataInLocalStorage('TG-tasks', (tasks) => {
                return tasks.map(task => {
                    if (task.uuid === id) {
                        return { ...task, boardName: boardName, date: new Date() };
                    }
                    return task;
                });
            });

            taskUtility.dispatchCustomEvents('flash', 'Task moved to ' + boardName);
        }
    };
}
