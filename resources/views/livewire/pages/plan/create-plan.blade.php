<div>
    <form wire:submit="save">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

             <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="title" id="title"   wire:model="title" autocomplete="title" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="...">
                            </div>
                            <div>
                                @error('title') <span class="text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Brief Description</label>
                    <div class="mt-2">
                        <textarea id="description" name="description" rows="3"  wire:model="description" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences description the task.</p>
                    </div>
                        <div>
                            @error('description') <span class=" text-red-600">{{ $message }}</span> @enderror
                        </div>

                </div>
            </div>
                <div class="py-10 mt-6 flex items-center justify-end gap-x-6">
                    <a href="{{route('dashboard')}}" wire:navigate.hover type="button" class="text-sm font-semibold leading-6 text-gray-900" @click="returnBack">Cancel</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 " type="submi">Save</button>
                </div>
            </div>
        </div>


    </form>


</div>
