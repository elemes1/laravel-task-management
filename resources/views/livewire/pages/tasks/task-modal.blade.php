<!-- Modal -->
<div class="fixed inset-0 flex h-screen w-full items-end md:items-center justify-center z-10" x-show.transition.opacity="openModal">
    <div class="absolute inset-0 bg-black opacity-50"></div>

    <div class="md:p-4 md:max-w-lg mx-auto w-full flex-1 relative overflow-hidden">
        <div class="md:shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer" x-on:click="openModal = !openModal">
            <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
            </svg>
        </div>

        <div class="w-full rounded-t-lg md:rounded-lg bg-white p-8">
            <h2 class="font-bold text-2xl mb-6 text-gray-800">Task Details for <span class="leading-normal border-b-2" :class="`text-${colorSelected.value}-600 border-${colorSelected.value}-200`" x-text="task.boardName"></span></h2>

            <div class="mb-4">
                <label class="text-gray-800 block mb-1 font-bold text-sm">Task Name</label>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="task.title" x-ref="taskName" autofocus>
            </div>

            <div class="mb-4">
                <label class="text-gray-800 block mb-1 font-bold text-sm">Description</label>
                <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="task.description" x-ref="taskDescription" autofocus >
                            </textarea>
            </div>

            <div class="mb-4">
                <label class="text-gray-800 block mb-1 font-bold text-sm">Due Date</label>
                <input type="date" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"  x-model="task.due_date" x-ref="taskDueDate" autofocus >
                </input>
            </div>

            <div class="mt-8 text-right">
                <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click="openModal = !openModal">
                    Cancel
                </button>
                <button type="button" class="text-white font-semibold py-2 px-4 border border-transparent rounded-lg shadow-sm bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" @click="addTask()" >
                    Save Task
                </button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
