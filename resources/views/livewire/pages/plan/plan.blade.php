<div wire:ignore>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <font style="vertical-align: inherit;">
                {{ $plan->title }}
            </font>
        </h2>
    </div>

    <div class="antialiased sans-serif bg-gray-300">
        <div class="fixed w-full z-50 flex inset-0 items-start justify-center pointer-events-none md:mt-5" x-data="{
			message: '',
			showFlashMessage(event) {
				this.message = event.detail.message;
				setTimeout(() => this.message = '', 3000)
			}
		}">
            <template x-on:flash.window="showFlashMessage(event)"></template>
            <template x-if="message">
                <div role="alert" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="-translate-y-5 opacity-0"
                        x-transition:enter-end="translate-y-0 opacity-100"
                        x-transition:leave="transition ease-in duration-100 transform"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 -translate-y-5"
                        class="w-full px-4 py-4 w-full md:max-w-sm bg-gray-900 md:rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 mr-3">
                            <svg class="h-6 w-6 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="text-gray-200 text-base" x-text="message"></div>
                    </div>
                </div>
            </template>
        </div>
        <!-- /Alert Box -->

        <div x-data="app" x-cloak class="flex flex-col min-h-screen border-t-8"
                :class="`border-${colorSelected.value}-700`">
            <div class="flex-1">

                <!-- Header -->
                <div class="bg-cover bg-center bg-no-repeat" :class="`bg-${colorSelected.value}-900`">
                    <div class="container mx-auto px-4 pt-4 md:pt-10 pb-40"></div>
                </div>
                <!-- /Header -->

                <div class="container mx-auto px-4 py-4 -mt-40">

                    <!-- Main Page -->
                    <div>

                        <!-- Kanban Board -->
                        <div class="py-4 md:py-8">
                            <div class="flex -mx-4 block overflow-x-auto pb-2">
                                <template x-for="board in boards" :key="board">
                                    <div class="w-1/2 md:w-1/4 px-4 flex-shrink-0">
                                        <div class="bg-gray-100 pb-4 rounded-lg shadow overflow-y-auto overflow-x-hidden border-t-8"
                                                style="min-height: 100px" :class="{
												'border-orange-600': board === boards[0],
												'border-yellow-600': board === boards[1],
												'border-blue-600': board === boards[2],
												'border-green-600': board === boards[3],
											}">
                                            <div class="flex justify-between items-center px-4 py-2 bg-gray-100 sticky top-0">
                                                <h2 x-text="board" class="uppercase font-medium text-gray-800"></h2>
                                                <a @click.prevent="showModal(board)" href="#"
                                                        class="inline-flex items-center text-sm font-medium"
                                                        :class="`text-${colorSelected.value}-500 hover:text-${colorSelected.value}-600`">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    Add Task </a>
                                            </div>

                                            <div class="px-4">
                                                <div @dragover="onDragOver(event)" @drop="onDrop(event, board)"
                                                        @dragenter="onDragEnter(event)" @dragleave="onDragLeave(event)"
                                                        class="pt-2 pb-20 rounded-lg">
                                                    <template x-for="(t, t.id) in tasks.filter(t => t.status === board)"
                                                            :key="t.id">

                                                        <div :id="t.id">
                                                            <div x-show="t.edit == false">
                                                                <div x-show="t.edit == false"
                                                                        class="bg-white rounded-lg shadow mb-3 p-2"
                                                                        draggable="true"
                                                                        @dragstart="onDragStart(event, t.id)"
                                                                        @dblclick="startTaskEditing(t)">
                                                                    <div x-text="t.title" class="text-gray-800"></div>

                                                                    <div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
                                                                        <div class="flex items-center">
                                                                            <svg class="w-4 h-4 text-gray-300 fill-current"
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 20 20"
                                                                                    fill="currentColor">
                                                                                <path fill-rule="evenodd"
                                                                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                                                        clip-rule="evenodd" />
                                                                            </svg>
                                                                            <span class="ml-1 leading-none"
                                                                                    x-text="formatDateDisplay(t.due_date)"></span>
                                                                        </div>
                                                                        <div class="relative flex items-center ml-4">
                                                                            <svg class="relative w-4 h-4 text-gray-300 fill-current"
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 20 20"
                                                                                    fill="currentColor">
                                                                                <path fill-rule="evenodd"
                                                                                        d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                                                                        clip-rule="evenodd" />
                                                                            </svg>
                                                                            <span class="ml-1 leading-none">0</span>
                                                                        </div>
                                                                        <div class="flex items-center ml-4">
                                                                            <svg class="w-4 h-4 text-gray-300 fill-current"
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 20 20"
                                                                                    fill="currentColor">
                                                                                <path fill-rule="evenodd"
                                                                                        d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                                                        clip-rule="evenodd" />
                                                                            </svg>
                                                                            <span  x-text="t.attachment_count" class="ml-1 leading-none">0</span>
                                                                        </div>
                                                                        <img class="w-6 h-6 ml-auto rounded-full"
                                                                                src='https://randomuser.me/api/portraits/women/44.jpg' />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div  x-data="{ filename: '' }"  x-show="t.edit == true"
                                                                    class="bg-white rounded-lg p-4 shadow mb-4">
                                                                <div class="mb-4">
                                                                    <label class="text-gray-800 block mb-1 font-bold text-sm">Task
                                                                        Name</label> <input :x-ref="t.id"
                                                                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                                                                            type="text" x-model="t.title">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label class="text-gray-800 block mb-1 font-bold text-sm">Description</label>
                                                                    <textarea
                                                                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                                                                            type="text" x-model="t.description"
                                                                            x-ref="taskDescription" autofocus>
                                                                        </textarea>
                                                                </div>

                                                                <div class="mb-4">
                                                                    <label class="text-gray-800 block mb-1 font-bold text-sm">Due
                                                                        Date</label> <input type="date"
                                                                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                                                                            value="" x-model="t.due_date"
                                                                            x-ref="taskDueDate" autofocus> </input>
                                                                </div>

                                                                <div class="mb-4">
                                                                    <label class="text-gray-800 block mb-1 font-bold text-sm">Created
                                                                        At</label>
                                                                    <div
                                                                            class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                                                                            x-text="formatDateDisplay(t.created_at)"
                                                                            x-model="t.created_at"></div>
                                                                </div>


                                                                <div class="mb-4">

                                                                    <div
                                                                            class="">
                                                                        <div class="w-full flex flex-col justify items-left">
                                                                            <label for="fileUrl" class="block text-sm font-medium leading-6 text-gray-900 cursor-pointer">
                                                                                <input type="file" wire:model="attachment" id="fileUrl" name="fileUrl" class="hidden" placeholder="File"
                                                                                        x-on:change="filename = $event.target.files.length > 0 ? $event.target.files[0].name : ''" />
                                                                                <span type="button" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-body shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"> Attach file </span>
                                                                            </label>
                                                                            <span class="ml-2.5 text-gray-600 italic text-sm" x-text="filename"></span>
                                                                            @error('attachment') <span class="error">{{ $message }}</span> @enderror
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="flex flex-row">
                                                                    <div class="text-left">
                                                                        <button type="button"
                                                                                class="bg-red hover:bg-gray-100 text-gray-700 font-semibold py-1 px-2 text-sm border border-gray-300 rounded-lg shadow-sm mr-2"
                                                                                @click="deleteTask(t) ">

                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    fill="none" viewBox="0 0 24 24"
                                                                                    stroke-width="1.5"
                                                                                    stroke="currentColor"
                                                                                    class="w-4 h-4 stroke-red-500">
                                                                                <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                            </svg>
                                                                        </button>
                                                                        <button type="button"
                                                                                class="bg-red hover:bg-gray-100 text-gray-700 font-semibold py-1 px-2 text-sm border border-gray-300 rounded-lg shadow-sm mr-2"
                                                                                wire:click="viewTaskActivities(t.id)">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    fill="none" viewBox="0 0 24 24"
                                                                                    stroke-width="1.5"
                                                                                    stroke="currentColor"
                                                                                    class="w-4 h-4 stroke-cyan-500">
                                                                                <path stroke-linecap="round"
                                                                                        stroke-linejoin="round"
                                                                                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                    <div class="text-right ">
                                                                        <button type="button"
                                                                                class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-1 px-2 text-sm border border-gray-300 rounded-lg shadow-sm mr-2"
                                                                                @click="t.edit = false">
                                                                            Cancel
                                                                        </button>

                                                                        <button type="button"
                                                                                class="text-white font-semibold py-1 px-2 text-sm border border-transparent rounded-lg shadow-sm  focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                                                                @click="saveEditTask(t)"
                                                                                :class="{
                                                                                'bg-orange-600': board === boards[0],
                                                                                'bg-yellow-600': board === boards[1],
                                                                                'bg-blue-600': board === boards[2],
                                                                                'bg-green-600': board === boards[3],
                                                                                 }"
                                                                        >
                                                                            Save update
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </template>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <!-- /Kanban Board -->
                    </div>
                    <!-- /Main Page -->

                </div>

            </div>

            {{-- Task Modal Component --}}
            @livewire('task.task-modal')

        </div>

    </div>
    <!-- Alert Box -->

    {{--    @push('footer-scripts')--}}
    <script defer>
        document.addEventListener('livewire:init', () => {

            Alpine.data('app', () => ({
                openModal: false,
                colorSelected: {
                    label: '#3182ce',
                    value: 'blue'
                },
                dateDisplay: 'toDateString',
                boards: @entangle('boards'),
                task: {
                    title: '',
                    boardName: '',
                    date: new Date()
                },
                editTask: {},
                tasks: @entangle('tasks'),
                formatDateDisplay(date) {
                    if (this.dateDisplay === 'toDateString') return new Date(date).toDateString();
                    if (this.dateDisplay === 'toLocaleDateString') return new Date(date).toLocaleDateString('en-GB');
                    return new Date().toLocaleDateString('en-GB');
                },
                showModal(board) {
                    this.task.boardName = board;
                    this.openModal = true;
                    // setTimeout(() => this.$refs.taskName.focus(), 200);
                },
                saveEditTask(task) {
                    if (task.title == '') return;
                    let taskIndex = this.tasks.findIndex(t => t.id === task.id);
                    this.tasks[taskIndex].title = task.title;
                    this.tasks[taskIndex].description = task.description;
                    this.tasks[taskIndex].due_date = task.due_date;
                    this.tasks[taskIndex].created_at = task.created_at;
                    this.tasks[taskIndex].edit = false;
                    this.$wire.dispatch('task-updated', {task: task.id, taskData: this.tasks[taskIndex]});
                    this.filename =''
                    this.dispatchCustomEvents('flash', 'Task detail updated');
                },

                deleteTask(task) {
                    if (task.title == '') return;
                    let taskIndex = this.tasks.findIndex(t => t.id === task.id);
                    this.tasks[taskIndex].edit = false;
                    this.$wire.dispatch('task-deleted', {task: task.id, taskData: this.tasks[taskIndex]});
                    this.dispatchCustomEvents('flash', 'Task removed successfully');
                },

                addTask() {
                    if (this.task.title == '') return;
                    const taskData = {
                        title: this.task.title,
                        status: this.task.boardName,
                        description: this.task.description,
                        due_date: this.task.due_date,
                    };
                    this.$wire.dispatch('task-created', {taskData: taskData});
                    this.dispatchCustomEvents('flash', 'New task added');
                    this.task.title = '';
                    this.task.boardName = '';
                    this.task.description = '';
                    this.task.due_date = '';
                    this.openModal = false;
                },

                startTaskEditing(task){
                    task.edit = true
                    this.$wire.dispatch('task-editing', {taskData: task.id});
                },

                onDragStart(event, uuid) {
                    event.dataTransfer.setData('text/plain', uuid);
                    event.target.classList.add('opacity-5');
                },
                onDragOver(event) {
                    event.preventDefault();
                    return false;
                },
                onDragEnter(event) {
                    event.target.classList.add('bg-gray-200');
                },
                onDragLeave(event) {
                    event.target.classList.remove('bg-gray-200');
                },
                onDrop(event, boardName) {
                    event.stopPropagation(); // Stops some browsers from redirecting.
                    event.preventDefault();
                    event.target.classList.remove('bg-gray-200');
                    const id = event.dataTransfer.getData('text');
                    const draggableElement = document.getElementById(id);
                    const dropzone = event.target;
                    dropzone.appendChild(draggableElement);
                    let existing = this.tasks;
                    let taskIndex = this.tasks.findIndex(t => t.id == id);
                    existing[taskIndex].status = boardName;

                    this.$dispatch('task-updated', {taskData: this.tasks[taskIndex], forceReload: true});
                    this.dispatchCustomEvents('flash', 'Task moved to ' + boardName);
                    event.preventDefault();  //todo :: fix quirks
                    event.dataTransfer.clearData();
                },

                dispatchCustomEvents(eventName, message) {
                    let customEvent = new CustomEvent(eventName, {
                        detail: {
                            message: message
                        }
                    });
                    window.dispatchEvent(customEvent);
                },
            }))
        })
    </script>
    {{--    @endpush--}}
</div>
