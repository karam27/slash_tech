<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">جميع الأعمال</h2>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <a href="{{ route('admin.portfolio.create') }}"
            class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">
            إضافة عمل جديد
        </a>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($portfolios as $item)
                <div class="bg-white border rounded p-4 shadow">
                    @if ($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-48 object-cover mb-3">
                    @endif

                    <h3 class="font-bold text-lg">{{ $item->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $item->description }}</p>
                    <span class="text-xs text-blue-500">{{ $item->category->name }}</span>

                    <div class="flex justify-between items-center mt-3">


                        <a href="{{ route('admin.portfolio.edit', ['portfolio' => $item->id]) }}"
                            class="text-blue-600">تعديل</a>

                        <form action="{{ route('admin.portfolio.destroy', ['portfolio' => $item->id]) }}" method="POST"
                            class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">حذف</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
