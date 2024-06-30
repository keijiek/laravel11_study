<x-app-layout>

  <section class="mx-auto">
    <h2>Users List</h2>
    <ul class="list-disc ms-6">
      @foreach($users as $u)
      <li>{{$u->name}}</li>
      @endforeach
    </ul>

  </section>
</x-app-layout>
