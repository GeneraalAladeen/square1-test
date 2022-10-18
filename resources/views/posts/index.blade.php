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
                            <div class="flex justify-between  items-center gap-6">
                                <div class="col-span-5 sm:col-span-3 lg:col-start-8 lg:col-span-2">
                                    <label for="sort" >Sort By</label>
                                    <select id="sort" name="sort_by"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="" selected ></option>
                                        @foreach($sort_params as $key => $param)
                                            <option value="{{$key}}" @if( request()->query('sort_by') === $key ) selected @endif>{{ $param }}</option>
                                        @endforeach
                                    </select>
                                </div>
                
                                <div class="col-span-5 sm:col-span-3 lg:col-span-2">
                                    <label for="direction" >Sort Direction</label>
                                    <select id="direction" name="direction"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="" selected></option>
                                        @foreach($directions as $key => $direction)
                                            <option value="{{$key}}" @if( request()->query('direction') === $key ) selected @endif>{{ $direction }}</option>
                                        @endforeach
                                    </select>
                                </div>
                
                                <div class="col-span-2 sm:col-span-3 lg:col-span-1">
                                    <x-button class="mt-1 text-base text-center">
                                        {{ __('Sort') }}
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-8 my-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
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
 
            <div class="max-w-md mx-auto px-8 py-4">
                {{ $posts->links() }}
            </div>
        </div>

        @if( session('success') )
            <!--Toast-->
            <div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm">
                <input type="checkbox" class="hidden" id="footertoast">
                <label class="close cursor-pointer flex items-start justify-between w-full p-2 bg-green-500 h-24 rounded shadow-lg text-white" title="close" for="footertoast">
                    {{ session('success') }}
                    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </label>
            </div>
        @endif


    </div>
</x-app-layout>