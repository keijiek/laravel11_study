<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      フォーム
    </h2>
  </x-slot>

  <div class="max-w-7xl mx-auto px-6">
    @if(session('message'))
    <div class="text-red-600 font-bold">
      {{ session('message') }}
    </div>
    @endif
    <?php
    /**
     * ↓ action = route('post.store') は、
     * routes/web.php の Route::psot('post', [PostController::class, 'store']) に導かれ、
     * Controllers\PostController class の store メソッドに辿り着く
     */
    ?>
    <form method="post" action="{{ route('post.update', $post) }}">
      @csrf
      @method('patch')
      <div class="mt-8">
        <div class="w-full flex flex-col">
          <label for="title" class="font-semibold mt-4 ">件名</label>
          <x-input-error :messages="$errors->get('title')" class="mt-2" />
          <input type="text" name="title" id="title" class="w-auto py-2 border border-gray300 rounded-md" value="{{ old('title', $post->title) }}">
        </div>
      </div>
      <div class="w-full flex flex-col">
        <label for="body" class="font-semibold mt-4">本文</label>
        <x-input-error :messages="$errors->get('body')" class="mt-2" />
        <textarea name="body" id="body" class="w-auto py-2 border border-gray-300 rounded-md" cols="30" rows="5">{{old('body', $post->body)}}</textarea>
      </div>
      <x-primary-button class="mt-4">送信する</x-primary-button>
    </form>

  </div>
</x-app-layout>
