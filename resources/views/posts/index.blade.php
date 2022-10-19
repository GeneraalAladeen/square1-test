<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('posts.index') }}" method="get">
                    <div class="block">
                        <div class="px-4 py-2">
                            <div class="flex justify-between  items-center">
                                <div class="flex gap-3">
                                    <div class="">
                                        <label for="sort" >Sort By</label>
                                        <select id="sort" name="sort_by"
                                                class="mt-1 block py-2 px-6 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="" selected ></option>
                                            @foreach($sort_fields as $key => $value)
                                                <option value="{{$key}}" @if( request()->query('sort_by') === $key ) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                    
                                    <div class="">
                                        <label for="direction" >Sort Direction</label>
                                        <select id="direction" name="sort_direction"
                                                class="mt-1 block w-full py-2 px-6 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="" selected></option>
                                            <option value="asc" @if( request()->query('sort_direction') === 'asc' ) selected @endif>Ascending</option>
                                            <option value="desc" @if( request()->query('sort_direction') === 'desc' ) selected @endif>Descending</option>
                                        </select>
                                    </div>
                                </div>
                
                                <x-button class="mt-1 text-base text-center">
                                    {{ __('Sort') }}
                                </x-button>
                               
                               
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class=" my-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-end py-4">
                <a href={{ route('posts.create')}}>
                    <x-button class="text-base"> {{ __('Create Post') }}</x-button>
                </a>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class=" shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="py-10 text-2xl text-gray-700 uppercase bg-gray-50">
                        <tr class="py-4">
                            <th scope="row" class="py-4 px-6">
                                Title
                            </th>
                            <th scope="col" class="px-6">
                                Publication Date
                            </th>
                            <th scope="row" class="px-6">
                                <span class="sr-only">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)                            
                            <tr class="bg-white border-b ">
                                <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ $post->title}}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $post->publication_date}}
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <a href="{{route('posts.show',  $post->slug)}}" class="font-medium text-blue-600  hover:underline">View</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
 
            <div class="flex justify-end gap-2 py-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>