<x-guest-layout>
    <div class="container w-full md:max-w-5xl mx-auto py-8">
        <div class="w-full px-4 text-xl text-gray-800">
            <div class="font-sans">
                <h1 class="font-bold break-normal text-gray-900 text-capitalize pt-6 pb-2 text-2xl sm:text-4xl">{{ $post->title }}</h1>
                <div class="flex justify-between">
                    <p class="text-sm md:text-base font-normal text-gray-600">Published {{ $post->publication_date }}</p>
                    <p class="text-sm font-bold md:text-xl leading-none mb-2">By {{ $post->user->name }}</p>
                </div>
            </div>

            <p class="py-4">{{ $post->description }}</p>
        </div>
    </div>
</x-guest-layout>