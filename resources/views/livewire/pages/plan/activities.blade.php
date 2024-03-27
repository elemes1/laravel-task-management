

<div class="py-12 flex flex-row justify-center">
    <div class="w-8/12  sm:px-6 lg:px-8">
        <div>
            Events
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                {{ $this->table }}
            </div>

        </div>
    </div>
    <div class="w-4/12  sm:px-6 lg:px-8">
        <div>Files</div>

            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr class="divide-x divide-gray-200">
                                    <th scope="col" class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Type</th>
                                    <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900"> Created at</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($attachments as $attachment)
                                <tr class="divide-x divide-gray-200">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-0">   {{ $attachment->file_name }} </td>
                                    <td class="whitespace-nowrap p-4 text-sm text-gray-500"> {{ $attachment->mime_type }}</td>
                                    <td class="whitespace-nowrap p-4 text-sm text-gray-500"> {{ $attachment->created_at->diffForHumans()  }} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </div>
</div>
