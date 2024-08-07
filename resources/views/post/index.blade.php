<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      投稿一覧
    </h2>
  </x-slot>

  <div class="max-w-7xl mx-auto px-6">
    @if(session('message'))
    <div class="text-red-600 font-bold">
      {{session('message')}}
    </div>
    @endif
    @foreach($posts as $post)
    <div class="mt-4 p-8 bg-white w-full rounded-2xl">
      <h1 class="p-4 text-lg font-semibold">
        <a href="{{ route('post.show', $post) }}" class="text-blue-600">
          {{$post->title}}
        </a>
      </h1>
      <div class="text-right mb-1">
        <a href="{{ route('post.edit', $post) }}">
          <x-primary-button>編集</x-primary-button>
        </a>
      </div>
      <hr class="w-full">
      <p class="mt-4 p-4">{{$post->body}}</p>
      <div class="p-4 text-sm font-semibold">
        <p>{{(new DateTimeImmutable($post->created_at))->format('Y-m-d')}} / {{$post->user->name??'匿名'}}</p>
      </div>
    </div>
    @endforeach

  </div>
</x-app-layout>
