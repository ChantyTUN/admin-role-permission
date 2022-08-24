<x-admin-layout>
    <div class="py-12 w-full">
    <div class="flex flex-col mt-12 w-full">
        
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
          
            <table class="min-w-full w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Name
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Email
                            </th>
                
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                           
                                <span class="sr-only">Edit</span>
                            </th>
        
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flew">
                                    <a href="{{ route('admin.users.show', $user->id) }}" class="px-4 py-2 bg-blue-500 hover:to-blue-700 rounded-md" style="background-color: #8fd9ab;">Roles</a>
                                    <form action="{{ route('admin.users.destroy',$user->id) }}" method="post" class="px-4 py-2 bg-red-500 hover:to-red-700 rounded-md" style="background-color: #ff8c8c; width: 80px;"
                                        onsubmit="return confirm('Are you sure to deleted this?');"
                                    >
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit">Delete</button>   
                                    </form>
                                </div>
                              
                            </td>
                           
                        </tr>
                        @endforeach
                       
                       
                    </tbody>
                </table>
            </div>
        </div>
</div>
    </div>
</x-adm-layout>
