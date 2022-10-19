<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6  py-8">
            <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
        
            <div class="flex flex-col gap-3">
                <div>
                    <x-label for="title" :value="__('Title')" />
                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                </div>
                <div>
                    <x-label for="description" :value="__('Description')"/>
                    <textarea class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"
                                    id="description" name="description" rows="8" placeholder="Post Content">{{ old('description') }}</textarea>
                </div>
                <div>
                    <x-label for="publication_date" :value="__('Publication Date')"/>
                    <x-input type="datetime-local" class="w-full" name="publication_date" id="publication_date" :value="old('publication_date')" required/>
                </div>
            </div>
            <div class="text-right">
                <x-button class="mt-1 text-base text-center">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>